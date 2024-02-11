<?php
include "conexao.php";

$mensagemErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verificar se o e-mail já existe no banco de dados
    $verificar_email = "SELECT id FROM pacientes WHERE email = ?";
    $stmt_verificar_email = $conn->prepare($verificar_email);
    $stmt_verificar_email->bind_param("s", $email);
    $stmt_verificar_email->execute();
    $result_verificar_email = $stmt_verificar_email->get_result();

    if ($result_verificar_email->num_rows > 0) {
        $mensagemErro = "E-mail já cadastrado. Por favor, use outro e-mail.";
        $stmt_verificar_email->close();
        $conn->close();
    } else {
        // Inserir paciente no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $inserir_paciente = "INSERT INTO pacientes (nome, telefone, email, senha) VALUES (?, ?, ?, ?)";
        $stmt_inserir_paciente = $conn->prepare($inserir_paciente);
        $stmt_inserir_paciente->bind_param("ssss", $nome, $telefone, $email, $senha_hash);

        if ($stmt_inserir_paciente->execute()) {
            echo "Paciente cadastrado com sucesso!";
            header("refresh: 10;url=../login.php"); // Redirecionar para a página inicial após o cadastro
        } else {
            echo "Erro ao cadastrar paciente. Tente novamente.";
        }

        // Fechar consulta
        $stmt_inserir_paciente->close();
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
