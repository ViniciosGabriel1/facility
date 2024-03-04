<?php
// Arquivo de conexão com o banco de dados
include "conexao.php";


// Verifica se o ID da consulta e a ação foram recebidos por meio do método POST
if(isset($_POST['id_consulta']) && isset($_POST['acao'])) {
    // Obtém o ID da consulta e a ação a ser executada
    $id_consulta = $_POST['id_consulta'];
    $acao = $_POST['acao'];

    // Define o status da consulta com base na ação recebida
    $status = ($acao == 'concluir') ? 'Concluída' : 'Cancelada';

    // Atualiza o status da consulta no banco de dados
    $sql = "UPDATE consultas SET status = '$status' WHERE id = $id_consulta";

    if ($conn->query($sql) === TRUE) {
        echo "Status da consulta atualizado com sucesso!";
        header("Location: ../dentista/pagina_dentista.php");


    } else {
        echo "Erro ao atualizar o status da consulta: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID da consulta e ação não foram recebidos corretamente.";
}
?>
