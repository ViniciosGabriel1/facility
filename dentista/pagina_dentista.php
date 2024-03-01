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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/medico.css">
    <title>Página do Médico</title>
<style>.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Navigation links */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* The subnavigation menu */
.subnav {
  float: left;
  overflow: hidden;
}

/* Subnav button */
.subnav .subnavbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
  z-index: 1000;
}

/* Add a red background color to navigation links on hover */
.navbar a:hover, .subnav:hover .subnavbtn {
  background-color: red;
}

/* Style the subnav content - positioned absolute */
.subnav-content {
  display: none;
  position: absolute;
  left: 0;
  background-color: red;
  width: 100%;
  z-index: 1;
}

/* Style the subnav links */
.subnav-content a {
  float: left;
  color: white;
  text-decoration: none;
}

/* Add a grey background color on hover */
.subnav-content a:hover {
  background-color: #eee;
  color: black;
}

/* When you move the mouse over the subnav container, open the subnav content */
.subnav:hover .subnav-content {
  display: block;
}</style>
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