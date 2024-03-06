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

// Obter a data da consulta (se fornecida, caso contrário, usar a data atual)
$currentDate = isset($_GET['data']) ? $_GET['data'] : date('Y-m-d');

// Consulta SQL para obter as consultas marcadas para o médico em uma data específica
$sql_consultas = "SELECT consultas.id, consultas.data_consulta, consultas.servico, consultas.status, consultas.observacoes, 
consultas.id_paciente, pacientes.nome AS nome_paciente, pacientes.foto AS foto_paciente, pacientes.telefone AS telefone_paciente
FROM consultas 
INNER JOIN pacientes ON consultas.id_paciente = pacientes.id 
WHERE consultas.id_medico = ? AND DATE(consultas.data_consulta) = ?
ORDER BY consultas.data_consulta
";

$stmt_consultas = $conn->prepare($sql_consultas);
$stmt_consultas->bind_param("is", $id_medico, $currentDate); // Bind do ID do médico e da data
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
