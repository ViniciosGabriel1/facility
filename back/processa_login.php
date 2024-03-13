<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $senha = isset($_POST["password"]) ? $_POST["password"] : null;
    $usertype = isset($_POST["usertype"]) ? $_POST["usertype"] : null;

    // Verificar se as variáveis são nulas
    if ($email === null || $senha === null || $usertype === null) {
        echo "Parâmetros inválidos.";
        header("refresh: 3;url=../login.php");
        exit();
    }

    // Verificar o tipo de usuário
    if ($usertype === "dentista") {
        $table = "medicos";
    } elseif ($usertype === "paciente") {
        $table = "pacientes";
    } else {
        echo "Tipo de usuário inválido.";
        exit();
    }

    // Consulta SQL para buscar o usuário
    $sql = "SELECT id, senha FROM $table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->get_result();

    // Verificar se o usuário foi encontrado
    if ($result->num_rows > 0) {
        // Obter os dados do usuário
        $row = $result->fetch_assoc();
        $id_usuario = $row["id"];
        $senha_hash = $row["senha"];

        // Verificar se a senha fornecida é válida
        if (password_verify($senha, $senha_hash)) {
            // Iniciar a sessão
            session_start();

            // Armazenar informações do usuário na sessão
            $_SESSION["id_usuario"] = $id_usuario;

            // Redirecionar para a página apropriada
            if ($usertype === "dentista") {
                header("Location: ../dentista/pagina_dentista.php?login=success");
                exit();
            } elseif ($usertype === "paciente") {
                header("Location: ../paciente/pagina_paciente.php?login=success");
                exit();
            } else {
                // Exibir mensagem de erro se o tipo de usuário for inválido
                echo "Tipo de usuário inválido.";
                exit();
            }
        } else {
            // Exibir mensagem de erro se a senha estiver incorreta
            echo "Usuário ou senha incorretos.";
            exit();
        }
    } else {
        // Exibir mensagem de erro se o usuário não for encontrado
        echo "Usuário ou senha incorretos.";
        exit();
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
    exit();
}
?>
