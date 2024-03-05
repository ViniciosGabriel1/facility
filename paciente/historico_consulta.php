<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/historico_consultas.css">
    <title>Histórico de Consultas</title>
    <style>
        .consultas-pendentes {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php
session_start();
include "../back/conexao.php";

// Verificar se o paciente está autenticado
if (!isset($_SESSION["id_usuario"])) {
    // Redirecionar para a página de login se não estiver autenticado
    header("Location: login.php");
    exit();
}

// Obter o ID do paciente
$id_paciente = $_SESSION["id_usuario"];

// Consulta SQL para obter o histórico de consultas do paciente
$sql = "SELECT id, data_consulta, id_medico, servico, observacoes, status FROM consultas WHERE id_paciente = ? ORDER BY FIELD(status, 'Agendada'), data_consulta DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$stmt->bind_result($id_consulta, $data_consulta, $id_medico, $servico, $observacoes, $status);

// Armazenar o resultado da consulta principal
$stmt->store_result();

// Verificar se há consultas no histórico
if ($stmt->num_rows > 0) {
    // Exibir consultas no histórico
    $consultas_pendentes_impressas = false; // Flag para indicar se as consultas pendentes já foram impressas
    while ($stmt->fetch()) {
        if ($status == 'Agendada' && !$consultas_pendentes_impressas) {
            echo "<h3 class='consultas-pendentes'>Consultas Pendentes</h3>";
            $consultas_pendentes_impressas = true; // Atualiza a flag para indicar que as consultas pendentes já foram impressas
        }
        // Consulta para obter o nome do dentista
        $sql_medico = "SELECT nome FROM medicos WHERE id = ?";
        $stmt_medico = $conn->prepare($sql_medico);
        $stmt_medico->bind_param("i", $id_medico);
        $stmt_medico->execute();
        $stmt_medico->bind_result($nome_medico);
        
        // Verificar se encontrou o médico
        if ($stmt_medico->fetch()) {
            ?>
            <div class="consulta-card">
                <p class="consulta-info"><strong>Data da Consulta:</strong> <?php echo $data_consulta; ?></p>
                <p class="consulta-info"><strong>Médico:</strong> <?php echo $nome_medico; ?></p>
                <p class="consulta-info"><strong>Serviço:</strong> <?php echo $servico; ?></p>
                <p class="consulta-info"><strong>Observações:</strong> <?php echo $observacoes; ?></p>
                <p class="consulta-info"><strong>Status:</strong> 
                    <span class="<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
                </p>
                <div class="consulta-botoes">
                    <?php if ($status == 'Agendada') { ?>
                        <button class="btn-cancelar">Cancelar</button>
                        <button class="btn-reagendar">Reagendar</button>
                    <?php } ?>
                </div>
            </div>
            <?php
        } else {
            echo "<p>Nome do médico não encontrado.</p>";
        }
        // Fechar a consulta do médico
        $stmt_medico->close();
    }
} else {
    echo "<p>Nenhuma consulta no histórico.</p>";
}

// Liberar a memória associada ao resultado da consulta principal
$stmt->free_result();

// Fechar a conexão com o banco de dados
$stmt->close();
$conn->close();
?>
    </div>
</body>
</html>
