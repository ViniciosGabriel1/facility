<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}

// Verificar se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include_once '../back/conexao.php';

    // Obter os dados do formulário
    $idConsulta = $_POST['id_consulta'];
    $servico = $_POST['servico'];
    $observacoes = $_POST['observacoes'];
    $status = 'Concluída'; // Definindo o status como 'Concluída'

    // Preparar a consulta SQL para atualizar os dados da consulta
    $sql = "UPDATE consultas SET servico = ?, observacoes = ?, status = ? WHERE id = ?";

    // Preparar a declaração SQL
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular os parâmetros à declaração SQL
        $stmt->bind_param("sssi", $servico, $observacoes, $status, $idConsulta);

        // Executar a consulta
        if ($stmt->execute()) {
            // Redirecionar de volta para a página de consulta após a conclusão bem-sucedida
            header("Location: ../dentista/pagina_dentista.php");
            exit();
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
