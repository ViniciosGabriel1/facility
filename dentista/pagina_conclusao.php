<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
include_once '../back/conexao.php';

// Verificar se os parâmetros foram passados pela URL
if (isset($_GET['idConsulta']) && isset($_GET['idPaciente'])) {
    // Obter os IDs da consulta e do paciente da URL
    $idConsulta = $_GET['idConsulta'];
    $idPaciente = $_GET['idPaciente'];

    // Consulta SQL para obter informações do paciente e da consulta
    $sql = "SELECT c.servico, c.data_consulta, c.observacoes, p.nome
            FROM consultas c
            INNER JOIN pacientes p ON c.id_paciente = p.id
            WHERE c.id = $idConsulta AND p.id = $idPaciente";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Extrair os dados do resultado da consulta
        $row = $result->fetch_assoc();
        $servico = $row['servico'];
        $dataConsulta = $row['data_consulta'];
        $observacoes = $row['observacoes'];
        $nomePaciente = $row['nome'];
    } else {
        // Se não houver resultados, redirecionar ou exibir uma mensagem de erro
        echo "Nenhum resultado encontrado para a consulta e paciente especificados.";
        exit();
    }
} else {
    // Se os parâmetros não foram passados, redirecionar ou exibir uma mensagem de erro
    echo "IDs de consulta e paciente não foram fornecidos.";
    exit();
}

// Consulta SQL para obter os serviços do dentista logado
$idMedico = $_SESSION['id_usuario'];

$sqlServicos = "SELECT servico FROM servicos WHERE id_medico = $idMedico";
$resultServicos = $conn->query($sqlServicos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_loc.css">
    <title>Concluir Consulta</title>
</head>

<body>
    <?php include "menu_dentista.php"; ?>
    <h1 class="pergunta">Quase Lá!</h1>


    <div class="container-wrapper">
        <div class="background-image">
            <img src="../img/conclusao.svg" alt="Imagem de fundo" class="background-image">
        </div>

        <div class="container">
    <h2>Concluir Consulta</h2>
    <form action="../back/processa_conclusao.php" method="post">

        <div class="form-group">
            <label for="nome_paciente">Nome do Paciente:</label><br>
            <input type="text" id="nome_paciente" name="nome_paciente" value="<?php echo $nomePaciente; ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="servico">Serviço:</label><br>
            <select id="servico" name="servico" class="form-control">
                <?php
                // Iterar sobre os serviços disponíveis
                while ($rowServico = $resultServicos->fetch_assoc()) {
                    $idServico = $rowServico['id'];
                    $nomeServico = $rowServico['servico'];
                    // Verificar se o serviço é o mesmo da consulta e marcá-lo como selecionado
                    $selected = ($servico == $nomeServico) ? "selected" : "";
                    echo "<option value='$idServico' $selected>$nomeServico</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="data_consulta">Data da Consulta:</label><br>
            <input type="text" id="data_consulta" name="data_consulta" value="<?php echo date('d/m/Y H:i', strtotime($dataConsulta)); ?>" class="form-control" readonly>
         </div>

        <div class="form-group">
            <label for="observacoes">Observações:</label><br>
            <textarea id="observacoes" name="observacoes" class="form-control"><?php echo $observacoes; ?></textarea>
        </div>

        <input type="hidden" name="id_consulta" value="<?php echo $idConsulta; ?>">
        <!-- Adicione o ID da consulta como um campo oculto -->

        <input type="submit" value="Concluir Consulta" class="btn-submit">
    </form>
</div>

    </div>
</body>

</html>
