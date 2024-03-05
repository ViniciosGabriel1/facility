<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/historico_consultas.css">
    <title>Histórico de Consultas</title>
</head>
<body>
<?php
include "menu_paciente.php";
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
$sql = "SELECT id, data_consulta, id_medico, servico, observacoes, status FROM consultas WHERE id_paciente = ? ORDER BY data_consulta DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$stmt->bind_result($id_consulta, $data_consulta, $id_medico, $servico, $observacoes, $status);

// Armazenar o resultado da consulta principal
$stmt->store_result();

// Variável para controlar se já foram exibidas as consultas pendentes
$consultas_pendentes_exibidas = false;

// Verificar se há consultas no histórico
if ($stmt->num_rows > 0) {
    // Exibir consultas no histórico
    while ($stmt->fetch()) {
        // Consulta para obter o nome do dentista
        $sql_medico = "SELECT nome, telefone FROM medicos WHERE id = ?";
        $stmt_medico = $conn->prepare($sql_medico);
        $stmt_medico->bind_param("i", $id_medico);
        $stmt_medico->execute();
        $stmt_medico->bind_result($nome_medico, $telefone_medico);
        
        // Verificar se encontrou o médico
        if ($stmt_medico->fetch()) {
            // Verificar se a consulta é pendente e se ainda não foram exibidas as consultas pendentes
            if (($status == 'Agendada' || $status == 'Reagendada') && !$consultas_pendentes_exibidas) {
                echo "<h3 class='consultas-pendentes'>Consultas Pendentes</h3>";
                $consultas_pendentes_exibidas = true; // Marcamos que as consultas pendentes foram exibidas
            }
            // Exibir as consultas pendentes
            if ($status == 'Agendada' || $status == 'Reagendada') {
                ?>
                <div class="consulta-card">
                <p class="consulta-info"><strong>Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?></p>
                    <p class="consulta-info"><strong>Médico:</strong> <?php echo $nome_medico; ?></p>
                    <p class="consulta-info"><strong>Serviço:</strong> <?php echo $servico; ?></p>
                    <p class="consulta-info"><strong>Observações:</strong> <?php echo $observacoes; ?></p>
                    <p class="consulta-info"><strong>Status:</strong> 
                        <span class="<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
                    </p>
                    <div class="consulta-botoes">
                        <?php if ($status == 'Agendada' || $status == 'Reagendada') { ?>
                            <div class="whats"><p class="consulta-info"><a  target="_blank" style="color: green;" href="https://api.whatsapp.com/send?phone=<?php echo $telefone_medico; ?> ">Enviar mensagem pelo WhatsApp</a><i style="color: green;" class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i></p></div>

                            <br><button class="btn-cancelar">Cancelar</button>
                            <button class="btn-reagendar">Reagendar</button>
                        <?php } ?>
                    </div>
                </div>
                <?php
            } else {
                // Exibir as consultas concluídas
                if ($consultas_pendentes_exibidas) {
                    echo "<h3 class='consultas-concluidas'>Consultas Concluídas</h3>";
                    $consultas_pendentes_exibidas = false; // Marcamos que as consultas concluídas foram exibidas
                }
                ?>
                <div class="consulta-card">
                    <p class="consulta-info"><strong>Data da Consulta:</strong> <?php echo $data_consulta; ?></p>
                    <p class="consulta-info"><strong>Médico:</strong> <?php echo $nome_medico; ?></p>
                    <p class="consulta-info"><strong>Serviço:</strong> <?php echo $servico; ?></p>
                    <p class="consulta-info"><strong>Observações:</strong> <?php echo $observacoes; ?></p>
                    <p class="consulta-info"><strong>Status:</strong> 
                        <span class="<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
                    </p>
                </div>
                <?php
            }
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
</body>
</html>
