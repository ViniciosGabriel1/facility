<?php
include "back/conexao.php";

$currentDate = date('Y-m-d');

// Calcular a data daqui a 3 meses
$limitDate = date('Y-m-d', strtotime('+3 months'));

// Verificar se foi fornecido um ID de médico na URL
if (isset($_GET['id_dentista'])) {
    // Obter o ID do médico a partir da URL
    $id_medico = $_GET['id_dentista'];

    // Consulta SQL para obter os serviços do médico
    $sql_servicos = "SELECT id,servico FROM servicos WHERE id_medico = ?";
    $stmt_servicos = $conn->prepare($sql_servicos);
    $stmt_servicos->bind_param("i", $id_medico);
    $stmt_servicos->execute();

    // Obter o resultado da consulta
    $result_servicos = $stmt_servicos->get_result();

    // Fechar a declaração
    $stmt_servicos->close();
} else {
    // Redirecionar de volta à página inicial se não houver ID de médico
    header("Location: index.php");
    exit();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/agendamento.css">
    <title>Agendar Consulta</title>
    <style>
        /* Seu estilo CSS anterior permanece inalterado */

        /* Adicione estilos adicionais conforme necessário */
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <h2>Agendar Consulta</h2>

    <form action="back/processar_agendamento.php" method="post">
        <input type="hidden" name="id_medico" value="<?php echo $id_medico; ?>">

        <label for="data">Escolha uma Data e Hora:</label>
        <input type="datetime-local" id="data" name="data" min="<?php echo $currentDate-1; ?>" max="<?php echo $limitDate; ?>" required>

        <label for="servico">Escolha um Serviço:</label>
        <select id="servico" name="servico" required>
            <?php
            // Exibir os serviços disponíveis do médico no menu suspenso
            while ($row_servico = $result_servicos->fetch_assoc()) {
                echo "<option value='{$row_servico['servico']}'>{$row_servico['servico']}</option>";
            }
            ?>
        </select>

        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="4" placeholder="Adicione observações, se necessário"></textarea>



        <button type="submit">Agendar</button>
    </form>

</body>

</html>