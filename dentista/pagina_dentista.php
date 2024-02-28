<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login_medico.php");
    exit();
}

include "../back/conexao.php";

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
    <link rel="stylesheet" href="../css/medico.css">
    <title>Página do Médico</title>

    <style>
.fac {
    /* margin: -50px; */
    margin-top: -30px;
    padding: 0.5%;
    background: #28B6F65c;
    width: 100%;
    padding-right: 10%;
    color: white;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    text-align: center;
    position: fixed;
    z-index: 1;
}

.fac h1 {
    position: absolute; /* Adiciona posição absoluta ao h1 */
    top: 0; /* Coloca o h1 no topo do contêiner pai (.fac) */
    left: 0; /* Coloca o h1 no canto superior esquerdo do contêiner pai (.fac) */
    width: 100%; /* Define a largura do h1 como 100% do contêiner pai (.fac) */
    margin: 0; /* Remove margens do h1 */
    padding: 10px; /* Adiciona preenchimento ao h1 conforme necessário */
    z-index: 1000; /* Define a ordem de empilhamento do h1 */
}
/* Estilo para dispositivos móveis */
@media (max-width: 767px) {
  .fac {
    padding: 10px;
    /* position: fixed; */
    padding-left: 9%;
    padding-right: 10px;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
}
    </style>
</head>

<body>

    <?php include "../dentista/menu_dentista.php"; ?>
    
    <h1 class="fac">FacilityOdonto</h1>
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

                    echo "<section class = 'sec'>";
                    // Adicionando informações do paciente
                    echo "<img src='../uploads/" . $row['foto_paciente'] . "' alt='Foto do Paciente' style='height: 180px; float: left; margin-right: 10px; border-radius: 20px;'>";
                    echo "<p>Data: " . $data_consulta->format('d/m/Y H:i') . "</p>";
                    echo "<p>Serviço: " . $row['servico'] . "</p>";
                    echo "<p>Observações: " . $row['observacoes'] . "</p>";
                    echo "<p>Paciente: " . $row['nome_paciente'] . "</p>";

                    echo '<div class="botoes-container">
                    <button class="concluir-btn">Concluir</button>
                    <button class="cancelar-btn">Cancelar</button>
                </div>';

                    echo "</div>";
                    echo "</section>";
                }
            }

            ?>
        </div>


    </div>

</body>

</html>