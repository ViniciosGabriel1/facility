<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}

include "../back/conexao.php";

// Obter o ID do médico da sessão
$id_medico = $_SESSION['id_usuario'];

// Consulta SQL para obter as consultas marcadas para o médico
$sql_consultas = "SELECT consultas.id, consultas.data_consulta, consultas.servico, consultas.observacoes, pacientes.nome AS nome_paciente, pacientes.foto AS foto_paciente 
                  FROM consultas 
                  INNER JOIN pacientes ON consultas.id_paciente = pacientes.id 
                  WHERE consultas.id_medico = ? 
                  ORDER BY consultas.data_consulta";

$stmt_consultas = $conn->prepare($sql_consultas);
$stmt_consultas->bind_param("i", $id_medico); // Bind do ID do médico
$stmt_consultas->execute();
$result_consultas = $stmt_consultas->get_result();


// Array para armazenar as consultas
$consultas = array();

// Adicionar as consultas ao array
while ($row = $result_consultas->fetch_assoc()) {
    $consultas[] = $row;
}

// Fechar a conexão
$stmt_consultas->close();
$conn->close();

// Retornar os dados como JSON
header('Content-Type: application/json');
echo json_encode($consultas);
?>
