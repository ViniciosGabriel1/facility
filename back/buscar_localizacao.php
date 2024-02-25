<?php
// Conexão com o banco de dados
include "../back/conexao.php";

// Verificar se o ID do médico foi recebido via POST
if (isset($_POST['id'])) {
    $idMedico = $_POST['id'];

    // Consulta SQL para obter a localização da clínica do médico com base no ID
    $sql_localizacao = "SELECT link_localizacao FROM localizacao_clinica WHERE id_medico = ?";
    $stmt = $conn->prepare($sql_localizacao);
    $stmt->bind_param("i", $idMedico);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retorna o link de localização da clínica
        echo $row['link_localizacao'];
    } else {
        // Se a localização não for encontrada, retorna uma mensagem de erro
        echo "Localização não encontrada para este médico";
    }

    // Fechar a conexão e liberar recursos
    $stmt->close();
    $conn->close();
} else {
    // Se o ID do médico não foi recebido, retorna uma mensagem de erro
    echo "ID do médico não recebido";
}
?>
