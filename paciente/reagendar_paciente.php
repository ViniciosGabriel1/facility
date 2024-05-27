<?php
session_start();
include "../back/conexao.php";


$id_paciente = $_SESSION['id_usuario'];

$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;
$id_consulta = isset($_GET['id_consulta']) ? $_GET['id_consulta'] : null;
$id_medico = isset($_GET['id_medico']) ? $_GET['id_medico'] : null;


if ($id_paciente !== null && $id_medico !== null) {
    // Consulta SQL para obter os detalhes do serviço e observações da consulta do paciente
    $sql_detalhes_consulta = "SELECT servico, observacoes FROM consultas WHERE id_paciente = ? AND id = ?";
    $stmt_detalhes_consulta = $conn->prepare($sql_detalhes_consulta);
    $stmt_detalhes_consulta->bind_param("ii", $id_paciente, $id_consulta);
    $stmt_detalhes_consulta->execute();

    // Obter o resultado da consulta
    $result_detalhes_consulta = $stmt_detalhes_consulta->get_result();

    // Consulta SQL para obter os serviços do médico
    $sql_servicos = "SELECT id,servico FROM servicos WHERE id_medico = ?";
    $stmt_servicos = $conn->prepare($sql_servicos);
    $stmt_servicos->bind_param("i", $id_medico);
    $stmt_servicos->execute();

    // Obter o resultado da consulta
    $result_servicos = $stmt_servicos->get_result();

    // Fechar a declaração
    $stmt_servicos->close();

    // Verificar se há resultados
    if ($result_detalhes_consulta->num_rows > 0) {
        // Extrair os detalhes do serviço e observações da consulta do paciente
        $row_detalhes_consulta = $result_detalhes_consulta->fetch_assoc();
        $servico = $row_detalhes_consulta['servico'];
        $observacoes = $row_detalhes_consulta['observacoes'];

        // Fechar a declaração
        $stmt_detalhes_consulta->close();

        // Agora você pode usar $servico e $observacoes para preencher os campos do formulário de reagendamento
    } else {
        echo "Detalhes da consulta não encontrados.";
    }
} else {
    echo "ID do Paciente ou ID da Consulta não fornecidos na URL.";
    // Redirecionar de volta à página inicial se não houver ID de médico
    exit();
}

// Calcular a data atual
$currentDate = date('Y-m-d\TH:i');

// Calcular a data daqui a 3 meses
$limitDate = date('Y-m-d\TH:i', strtotime('+3 months'));

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/servico1.css">
    <link rel="stylesheet" href="../css/agendamento.css">
    <title>Agendar Consulta</title>

    <style>
        #closeButton {
            display: none;
        }
    </style>

</head>

<body>
<?php include "menu_paciente.php"; 

?>
<h1 class="pergunta">Imprevisto de última hora?</h1>
    <div class="container-wrapper">
    <!-- Início da imagem -->
    <img src="../img/agenda.svg" alt="Descrição da imagem" class="background-image">
    <!-- Fim da imagem -->

    <div class="container">

    <h2>Reagende Aqui</h2>
    <span id="instrucao" class="instrucao" style="display: none;">Clique fora do calendário para fechar.</span>

    <!-- Dentro do seu formulário HTML -->
<form id="form-formacao" action="../back/processa_reagendamento_paciente.php" method="post">
    <div class="form-group">
    <input type="hidden" name="id_medico" value="<?php echo $id_medico; ?>">
    <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
    <input type="hidden" name="id_consulta" value="<?php echo $id_consulta; ?>">

        <!-- Campo de Data e Hora -->
        <label for="data">Escolha uma Data e Hora:</label>
        <input type="datetime-local" id="data" name="data" min="<?php echo $currentDate; ?>" max="<?php echo $limitDate; ?>" value="<?php echo isset($currentDate) ? $currentDate : ''; ?>" required>
    </div>
    <div class="form-group">
        <!-- Campo de Serviço -->
        <label for="servico">Escolha um Serviço:</label>
        <select id="servico" name="servico" required>
            <?php
            // Exibir os serviços disponíveis do médico no menu suspenso
            while ($row_servico = $result_servicos->fetch_assoc()) {
                $selected = ($row_servico['servico'] == $servico) ? 'selected' : '';
                echo "<option value='{$row_servico['servico']}' $selected>{$row_servico['servico']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <!-- Campo de Observações -->
        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="4" placeholder="Adicione observações, se necessário"><?php echo isset($observacoes) ? $observacoes : ''; ?></textarea>
    </div>
    <button type="submit">Agendar</button>
</form>


    
<script>
document.addEventListener("DOMContentLoaded", function() {
    var inputField = document.getElementById('data');
    var instrucao = document.getElementById('instrucao');

    inputField.addEventListener('click', function() {
        instrucao.style.display = 'block';
    });

    // Adiciona um ouvinte de evento para cliques em qualquer lugar da página
    document.addEventListener('click', function(event) {
        // Verifica se o clique não foi dentro do inputField
        if (event.target !== inputField) {
            // Oculta o texto de instruções
            instrucao.style.display = 'none';
        }
    });
});


</script>
</body>

</html>
