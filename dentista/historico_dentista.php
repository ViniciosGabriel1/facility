<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}

// Inclua o arquivo de conexão
require_once '../back/conexao.php';

// Verifica se a solicitação possui o ID do paciente
if (isset($_GET['idPaciente'])) {
    $paciente_id = $_GET['idPaciente'];

    // Consulta SQL para recuperar as consultas do paciente com nome e número do paciente
    $sql = "SELECT c.*, p.nome AS nome_paciente, p.telefone AS numero_paciente 
        FROM consultas c
        INNER JOIN pacientes p ON c.id_paciente = p.id 
        WHERE c.id_paciente = ? 
            AND c.status = 'Concluída'
        ORDER BY c.data_consulta DESC";


    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $consultas = $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo 'Erro ao obter as consultas: ' . $e->getMessage();
    }
} else {
    echo 'ID do paciente não fornecido.';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico do Dentista</title>
    <link rel="stylesheet" href="../css/historico_dentista.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include "menu_dentista.php"; ?>
    <?php
    $nome_paciente = $consultas[0]['nome_paciente'];
    // Exibe o título com o nome do paciente
    echo "<h1 class=\"titulo\">Histórico de $nome_paciente</h1>";
    ?>

    <div class="container-wrapper">


        <div class="container">
            <?php

            // Verifique se há consultas para exibir
            if (!empty($consultas)) {

                foreach ($consultas as $consulta) {

            ?>
                    <div class="card">
                        <p><strong class="info"><i class="fas fa-id-card"></i> ID Consulta:</strong> <?php echo $consulta['id']; ?></p>
                        <p><strong class="info"><i class="fas fa-calendar-alt"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($consulta['data_consulta'])); ?></p>
                        <p><strong class="info"><i class="fas fa-user"></i> Nome do Paciente:</strong> <?php echo $consulta['nome_paciente']; ?></p>
                        <p><strong class="info"><i class="fas fa-user-md"></i> Serviço Realizado:</strong> <?php echo $consulta['servico']; ?></p>
                        <p><strong class="info"><i class="fas fa-sticky-note"></i> Observações:</strong> <?php echo $consulta['observacoes']; ?></p>
                        <p><strong class="info"><i class="fas fa-info-circle"></i> Status: </strong><span class="<?php echo strtolower($consulta['status']); ?>"><?php echo $consulta['status']; ?>
                                <?php if (strtolower($consulta['status']) == 'concluída') : ?>
                                    <i class="fas fa-check-circle"></i>
                                <?php endif; ?>
                            </span>
                        </p>
                        <p><strong><i class="fab fa-whatsapp" style="color: green;"></i></strong><a href="https://api.whatsapp.com/send?phone=<?php echo $consulta['numero_paciente']; ?>" target="_blank" style="color: green;"> Clique e Fale com o paciente </a></p>

                    </div>
            <?php
                }
            } else {
                echo "<p>Nenhuma consulta encontrada.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>