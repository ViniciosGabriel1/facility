<?php
// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

// Verifique se o ID do serviço foi enviado através do método GET
if (isset($_GET['id'])) {
    // Obtenha o ID do serviço a ser excluído
    $id_servico = $_GET['id'];

    // Consulta SQL para excluir o serviço do banco de dados
    $sql_excluir_servico = "DELETE FROM servicos WHERE id = $id_servico";

    // Execute a consulta SQL
    if ($conn->query($sql_excluir_servico) === TRUE) {
        // Redirecione de volta para a página do perfil do médico após a exclusão
        header("Location: ../dentista/perfil_dentista.php");
        exit();
    } else {
        echo "Erro ao excluir serviço: " . $conn->error;
    }
} else {
    // Se o ID do serviço não foi enviado, redirecione de volta para a página do perfil do médico
    header("Location: peril_medico.php");
    exit();
}
?>
