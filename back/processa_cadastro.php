<?php
include "conexao.php"; // Inclua o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    // Verificar se o email já está cadastrado
    $verifica_email = "SELECT * FROM pacientes WHERE email = ?";
    $stmt_verifica = $conn->prepare($verifica_email);
    $stmt_verifica->bind_param("s", $email);
    $stmt_verifica->execute();

    $result_verifica = $stmt_verifica->get_result();

    if ($result_verifica->num_rows > 0) {
        // Exibir mensagem se o email já estiver cadastrado
        echo "Email já cadastrado. Escolha outro.";
        header("refresh: 3;url=../cadastro.php");

    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir novo paciente no banco de dados
        $inserir_paciente = "INSERT INTO pacientes (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";
        $stmt_inserir = $conn->prepare($inserir_paciente);
        $stmt_inserir->bind_param("ssss", $nome, $email, $telefone, $senha_hash);

        if ($stmt_inserir->execute()) {
            // Redirecionar para a página de login após o cadastro bem-sucedido
            header("Location: ../login.php");
            exit();
        } else {
            // Exibir mensagem de erro em caso de falha no cadastro
            echo "Erro ao cadastrar. Tente novamente.";
            header("refresh: 3;url=../cadastro.php");

        }

        // Fechar as consultas
        $stmt_inserir->close();
    }

    $stmt_verifica->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
