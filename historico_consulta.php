<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/historico_consultas.css">
    <title>Histórico de Consultas</title>
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="historico-container">
        <h2>Histórico de Consultas</h2>
        <?php
        session_start();
        include "back/conexao.php";
        // Verificar se o paciente está autenticado
        if (!isset($_SESSION["id_usuario"])) {
            // Redirecionar para a página de login se não estiver autenticado
            header("Location: login.php");
            exit();
        }
        // Obter o ID do paciente
        $id_paciente = $_SESSION["id_usuario"];
        // Consulta SQL para obter o histórico de consultas do paciente
        $sql = "SELECT id, data_consulta, id_medico FROM consultas WHERE id_paciente = ? ORDER BY data_consulta DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_paciente);
        $stmt->execute();
        $stmt->bind_result($id_consulta, $data_consulta, $id_medico);
        // Armazenar o resultado da consulta principal
        $stmt->store_result();
        // Verificar se há consultas no histórico
        if ($stmt->num_rows > 0) {
            // Exibir consultas no histórico
            while ($stmt->fetch()) {
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
                        <!-- Adicione outros detalhes da consulta conforme necessário -->
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
