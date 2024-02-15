<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login_medico.php");
    exit();
}

include "back/conexao.php";

// Obter o ID do médico da sessão
$id_medico = $_SESSION['id_usuario'];

// Consulta SQL para obter as consultas marcadas para o médico
$sql_consultas = "SELECT consultas.id, consultas.data_consulta, consultas.servico, consultas.observacoes, pacientes.nome AS nome_paciente, pacientes.foto AS foto_paciente FROM consultas INNER JOIN pacientes ON consultas.id_paciente = pacientes.id WHERE consultas.id_medico = ? ORDER BY consultas.data_consulta";

$stmt_consultas = $conn->prepare($sql_consultas);
$stmt_consultas->bind_param("i", $id_medico);
$stmt_consultas->execute();
$result_consultas = $stmt_consultas->get_result();

// Consulta SQL para verificar se há consultas em outros dias
$sql_outros_dias = "SELECT DISTINCT DATE(data_consulta) AS dia FROM consultas WHERE id_medico = ?";
$stmt_outros_dias = $conn->prepare($sql_outros_dias);
$stmt_outros_dias->bind_param("i", $id_medico);
$stmt_outros_dias->execute();
$result_outros_dias = $stmt_outros_dias->get_result();

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/medico.css">
    <title>Página do Médico</title>
</head>

<body>

    <?php include "menu_dentista.php"; ?>

    <h2>Suas Consultas Agendadas</h2>

    <div class="consultas-container">
        <div class="consultas-do-dia">
            <h3>Consultas Agendadas para Hoje</h3>
            <?php
            // Exibir consultas agendadas para hoje
            while ($row = $result_consultas->fetch_assoc()) {
                $data_consulta = new DateTime($row['data_consulta']);
                $hoje = new DateTime();
                if ($data_consulta->format('Y-m-d') == $hoje->format('Y-m-d')) {
                    echo "<div class='consulta'>";
                    echo "<p>Data: " . $data_consulta->format('d/m/Y H:i') . "</p>";
                    echo "<p>Serviço: " . $row['servico'] . "</p>";
                    echo "<p>Observações: " . $row['observacoes'] . "</p>";
                    
                    // Adicionando informações do paciente
                    echo "<p>Paciente: " . $row['nome_paciente'] . "</p>";
                    echo "<img src='uploads/" . $row['foto_paciente'] . "' alt='Foto do Paciente' style='height: 100px;'>";

                    echo "</div>";
                }
            }
            ?>
        </div>

        <div class="consultas-outros-dias">
            <h3>Outros Dias com Consultas Agendadas</h3>
            <?php
            // Exibir dias com consultas agendadas
            while ($row_outros_dias = $result_outros_dias->fetch_assoc()) {
                $data_dia = new DateTime($row_outros_dias['dia']);
                echo "<p>Dia: " . $data_dia->format('d/m/Y') . "</p>";

                // Consultar e exibir consultas para este dia
                $sql_consultas_dia = "SELECT id, data_consulta, servico, observacoes FROM consultas WHERE id_medico = ? AND DATE(data_consulta) = ?";
                $stmt_consultas_dia = $conn->prepare($sql_consultas_dia);
                $stmt_consultas_dia->bind_param("is", $id_medico, $row_outros_dias['dia']);
                $stmt_consultas_dia->execute();
                $result_consultas_dia = $stmt_consultas_dia->get_result();

                while ($row_consultas_dia = $result_consultas_dia->fetch_assoc()) {
                    echo "<div class='consulta'>";
                    echo "<img src='uploads/" . $row['foto_paciente'] . "' alt='Foto do Paciente' style='height: 100px;'>";
                    echo "<p>Data: " . $data_consulta->format('d/m/Y H:i') . "</p>";
                    echo "<p>Serviço: " . $row_consultas_dia['servico'] . "</p>";
                    echo "<p>Observações: " . $row_consultas_dia['observacoes'] . "</p>";
                    
                    // Adicionando informações do paciente
                    echo "<p>Paciente: " . $row['nome_paciente'] . "</p>";
                   

                    echo "</div>";
                }

                // Fechar a declaração
                $stmt_consultas_dia->close();
            }
            ?>
        </div>
    </div>

</body>

</html>
