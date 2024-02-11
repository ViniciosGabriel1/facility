<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter e-mail do formulário
    $email = $_POST["email"];

    // Verificar se o e-mail já existe no banco de dados
    $verificar_email = "SELECT id FROM pacientes WHERE email = ?";
    $stmt_verificar_email = $conn->prepare($verificar_email);
    $stmt_verificar_email->bind_param("s", $email);
    $stmt_verificar_email->execute();
    $result_verificar_email = $stmt_verificar_email->get_result();

    // Definir mensagem e cor com base na disponibilidade
    $mensagem = "";
    $disponivel = $result_verificar_email->num_rows === 0;
    if ($disponivel) {
        $mensagem = "E-mail disponível!";
    } else {
        $mensagem = "E-mail já cadastrado. Por favor, use outro e-mail.";
    }

    // Retornar resposta em formato JSON
    echo json_encode(["disponivel" => $disponivel, "mensagem" => $mensagem]);

    // Fechar a consulta
    $stmt_verificar_email->close();
    $conn->close();
}
?>
