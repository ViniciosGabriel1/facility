<?php
session_start();
include "../back/conexao.php";

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
    echo "Id não encontrado !!!";
    // Redirecionar de volta à página inicial se não houver ID de médico
    exit();
}



// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Agendar Consulta</title>

    <style>
        #closeButton {
            display: none;
        }

        /* Estilos para a classe do botão */
        .botao-voltar {
            margin-top: 12px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: hsl(199deg 86% 78%);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .botao-voltar:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
<?php include "menu_paciente.php"; ?>

<button class="botao-voltar" onclick="goBack()"><i class="fas fa-arrow-left"></i> Voltar</button>


<h1 class="pergunta">Quanto mais rápido melhor.</h1>
    <div class="container-wrapper">
    <!-- Início da imagem -->
    <img src="../img/agenda.svg" alt="Descrição da imagem" class="background-image">
    <!-- Fim da imagem -->

    <div class="container">

    <h2>Agende Aqui</h2>
    <span id="instrucao" class="instrucao" style="display: none;">Clique fora do calendário para fechar.</span>

    <form id="form-formacao" action="../back/processar_agendamento.php" method="post">
    <div class="form-group">
        <input type="hidden" name="id_medico" value="<?php echo $id_medico; ?>">
        <label for="data">Escolha uma Data e Hora:</label>
        <input type="datetime-local" id="data" name="data" min="<?php echo $currentDate; ?>" max="<?php echo $limitDate; ?>" required>
        
        </div>
        <div class="form-group">

        <label for="servico">Escolha um Serviço:</label>
        <select id="servico" name="servico" required>
            <?php
            // Exibir os serviços disponíveis do médico no menu suspenso
            while ($row_servico = $result_servicos->fetch_assoc()) {
                echo "<option value='{$row_servico['servico']}'>{$row_servico['servico']}</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">

        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="4" placeholder="Adicione observações, se necessário"></textarea>
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

    function goBack() {
        window.history.back();
    }

</script>
</body>

</html>
