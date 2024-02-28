<?php
// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

// Verifique se o ID da formação foi enviado através do método GET
if (isset($_GET['id'])) {
    // Obtenha o ID da formação a ser excluída
    $id_formacao = $_GET['id'];

    // Consulta SQL para excluir a formação do banco de dados
    $sql_excluir_formacao = "DELETE FROM formacoes WHERE id = $id_formacao";

    // Execute a consulta SQL
    if ($conn->query($sql_excluir_formacao) === TRUE) {
        // Redirecione de volta para a página do perfil do médico após a exclusão
        header("Location: ../dentista/perfil_dentista.php");
        exit();
    } else {
        echo "Erro ao excluir formação: " . $conn->error;
    }
} else {
    // Se o ID da formação não foi enviado, redirecione de volta para a página do perfil do médico
    header("Location: peril_medico.php");
    exit();
}
?>
