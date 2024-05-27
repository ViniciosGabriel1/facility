<?php
// Incluir arquivo de conexão ao banco de dados
include '../back/conexao.php';

// Verificar se os parâmetros foram fornecidos
if (isset($_GET['id_consulta']) && isset($_GET['id_paciente']) && isset($_GET['id_medico'])) {
    $id_consulta = $_GET['id_consulta'];
    $id_paciente = $_GET['id_paciente'];
    $id_medico = $_GET['id_medico'];

    // Preparar e vincular
    $stmt = $conn->prepare("UPDATE consultas SET status = 'cancelada' WHERE id = ? AND id_paciente = ? AND id_medico = ?");
    $stmt->bind_param("iii", $id_consulta, $id_paciente, $id_medico);

    // Executar a consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Consulta cancelada com sucesso.";
            header("Location: ../paciente/historico_consulta.php?success_cancel=1");


        } else {
            echo "Nenhuma consulta encontrada com os dados fornecidos.";
        }
    } else {
        echo "Erro ao cancelar a consulta: " . $stmt->error;
    }

    // Fechar a declaração
    $stmt->close();
} else {
    echo "Parâmetros insuficientes. Por favor, forneça id_consulta, id_paciente e id_medico.";
}

// Fechar conexão
$conn->close();
?>
