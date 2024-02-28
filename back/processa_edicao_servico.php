<?php
// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $id_servico = $_POST['id_servico'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Consulta SQL para atualizar os detalhes do serviço
    $sql = "UPDATE servicos SET servico = '$nome', descricao = '$descricao' WHERE id = $id_servico";

    if ($conn->query($sql) === TRUE) {
        // Redirecione de volta para a página do perfil do médico após a atualização
        header("Location: ../dentista/perfil_dentista.php");
        exit();
    } else {
        echo "Erro ao atualizar serviço: " . $conn->error;
    }
} else {
    // Se a solicitação não for POST, redirecione de volta para a página do perfil do médico
    header("Location: ../dentista/perfil_dentista.php");
    exit();
}
?>
