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

    // Variáveis para controlar se já foram exibidas as consultas pendentes e concluídas
    $consultas_pendentes_exibidas = false;
    $consultas_concluidas_exibidas = false;

    // Verificar se há consultas no histórico
    if ($stmt->num_rows > 0) {
        // Exibir consultas no histórico
        while ($stmt->fetch()) {
            // Consulta para obter o nome do médico
            $sql_medico = "SELECT nome, telefone FROM medicos WHERE id = ?";
            $stmt_medico = $conn->prepare($sql_medico);
            $stmt_medico->bind_param("i", $id_medico);
            $stmt_medico->execute();
            $stmt_medico->bind_result($nome_medico, $telefone_medico);

            // Verificar se encontrou o médico
            if ($stmt_medico->fetch()) {
                // Exibir as consultas pendentes
                if ($status == 'Agendada' || $status == 'Reagendada') {
                    if (!$consultas_pendentes_exibidas) {
                        echo "<h3 class='consultas-pendentes'>Consultas Pendentes</h3>";
                        $consultas_pendentes_exibidas = true;
                    }
                    includeConsultCard($data_consulta, $nome_medico, $servico, $observacoes, $status, $telefone_medico);
                } elseif ($status == 'Concluída') {
                    if (!$consultas_concluidas_exibidas) {
                        echo "<h3 class='consultas-concluidas'>Consultas Concluídas</h3>";
                        $consultas_concluidas_exibidas = true;
                    }
                    includeConsultCard($data_consulta, $nome_medico, $servico, $observacoes, $status, $telefone_medico);
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

    // Função para incluir o card de consulta
    function includeConsultCard($data_consulta, $nome_medico, $servico, $observacoes, $status, $telefone_medico)
    {
    ?>
        <div class="consulta-card">
            <p class="consulta-info">
                <strong><i class="fa fa-calendar fa-fw"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-user-md fa-fw"></i> Médico:</strong> <?php echo $nome_medico; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-stethoscope fa-fw"></i> Serviço:</strong> <?php echo $servico; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-commenting fa-fw"></i> Observações:<br></strong> <?php echo $observacoes; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-info-circle fa-fw"></i> Status:</strong>
                <span class="<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
            </p>
            <div class="consulta-botoes">
                <?php if ($status == 'Agendada' || $status == 'Reagendada') { ?>
                    <div class="whats">
                        <p class="consulta-info">
                            <a target="_blank" style="color: green;" href="https://api.whatsapp.com/send?phone=<?php echo $telefone_medico; ?>">
                                <i class="fa fa-whatsapp fa-fw" style="color: green;"></i> Enviar mensagem pelo WhatsApp
                            </a>
                        </p>
                    </div>
                    <br>
                    <button class="btn-cancelar"><i class="fa fa-times-circle fa-fw" style="color: red;"></i> Cancelar</button>
                    <button class="btn-reagendar"><i class="fa fa-calendar-plus-o fa-fw" style="color: blue;"></i> Reagendar</button>
                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>
