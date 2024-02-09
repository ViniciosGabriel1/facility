<?php
include "conexao.php"; // Inclua o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["password"];

    // Consulta SQL para buscar o paciente
    $sql = "SELECT id, senha FROM pacientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->get_result();

    // Verificar se o paciente foi encontrado
    if ($result->num_rows > 0) {
        // Obter os dados do paciente
        $row = $result->fetch_assoc();
        $id_paciente = $row["id"];
        $senha_hash = $row["senha"];

        // Verificar se a senha fornecida é válida
        if (password_verify($senha, $senha_hash)) {
            // Iniciar a sessão
            session_start();

            // Armazenar informações do paciente na sessão
            $_SESSION["id_paciente"] = $id_paciente;

            // Redirecionar para a página do paciente após o login bem-sucedido
            header("Location: ../pagina_paciente.php");
            exit();
        } else {
            // Exibir mensagem de erro se a senha estiver incorreta
            echo "Usuário ou senha incorretos.";
            header("refresh: 3;url=../login.php");
        }
    } else {
        // Exibir mensagem de erro se o paciente não for encontrado
        echo "Usuário ou senha incorretos.";
        header("refresh: 3;url=../login.php");
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
