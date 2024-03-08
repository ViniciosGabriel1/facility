<?php
$host = "127.0.0.1";
$usuario = "root";
$senha = "";
$banco = "sistema_agendamento";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Configuração da codificação UTF-8
$conn->set_charset("utf8mb4");

?>
