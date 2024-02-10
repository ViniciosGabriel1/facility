<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["password"];
    $usertype = $_POST["usertype"]; // Adicione esta linha para obter o tipo de usuário

    // Consulta SQL para buscar o usuário
    $sql = "";
    if ($usertype === "dentista") {
        $sql = "SELECT id, senha FROM medicos WHERE email = ?";
    } elseif ($usertype === "paciente") {
        $sql = "SELECT id, senha FROM pacientes WHERE email = ?";
    } else {
        echo "Tipo de usuário inválido.";
        header("refresh: 3;url=../login.php");
        exit();
    }

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
                header("Location: ../pagina_dentista.php");
            } elseif ($usertype === "paciente") {
                header("Location: ../pagina_paciente.php");
            }
            exit();
        } else {
            // Exibir mensagem de erro se a senha estiver incorreta
            echo "Usuário ou senha incorretos.";
            header("refresh: 3;url=../login.php");
        }
    } else {
        // Exibir mensagem de erro se o usuário não for encontrado
        echo "Usuário ou senha incorretos.";
        header("refresh: 3;url=../login.php");
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
