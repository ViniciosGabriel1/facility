<?php
// Inclua o arquivo de conexão com o banco de dados
include_once "../back/conexao.php";

// Consulta para obter os serviços oferecidos pelo médico
$sql_servicos = "SELECT * FROM servicos WHERE id_medico = 23"; // Supondo que o ID do médico seja 1
$resultado_servicos = $conn->query($sql_servicos);

// Consulta para obter as formações acadêmicas do médico
$sql_formacoes = "SELECT * FROM formacoes WHERE id_medico = 23"; // Supondo que o ID do médico seja 1
$resultado_formacoes = $conn->query($sql_formacoes);

// Consulta SQL para obter as informações do médico
$sql_medico = "SELECT nome, email, telefone,foto FROM medicos WHERE id = 23"; // Supondo que o ID do médico seja 1
$resultado_medico = $conn->query($sql_medico);

// Verifique se há resultados
if ($resultado_medico->num_rows > 0) {
  // Exiba os dados do médico
  $row = $resultado_medico->fetch_assoc();
  $nome = $row["nome"];
  $email = $row["email"];
  $telefone = $row["telefone"];
  $foto = $row["foto"];

} else {
  echo "Nenhum médico encontrado.";
}
?>



<!DOCTYPE html>
<html>

<head>
  <title>Portfólio de Dentista</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Roboto", sans-serif
    }

    .w3-teal, .w3-hover-teal:hover {
    color: #fff !important;
    background-color: #007bff !important;
}

.w3-text-teal, .w3-hover-text-teal:hover {
    color:#007bff !important;
}

.w3-text-black, .w3-hover-text-black:hover {
    color: #fff !important;
}
  </style>
</head>

<body class="w3-light-grey">

  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">
   
      <!-- Perfil. Onde irá ter a foto do médicos, nome, email e whatsapp-->
      <div class="w3-third">

      <div class="w3-white w3-text-grey w3-card-4">
    <div class="w3-display-container">
        <img src="<?php echo $foto; ?>" style="width:100%" alt="Médico">
        <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><?php echo $nome; ?></h2>
            
        </div>
    </div>
    <div class="w3-container">
        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $email; ?></p>
        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $telefone; ?></p>
        <hr>
        
        <!-- Frase sobre os serviços odontológicos -->
        <p class="w3-large"><b><i class="fa fa-quote-left fa-fw w3-margin-right w3-text-teal"></i>Transformando sorrisos e promovendo saúde bucal com cuidado e profissionalismo.</b></p>
    </div>
</div><br>

      <!-- End Left Column -->
    </div>

    <!-- Àrea de Servicos. Pegue do banco de dados os serviços referentes ao médico selecionado-->
    <div class="w3-twothird">

      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Serviços</h2>
        <?php
        // Exibir os serviços oferecidos pelo médico
        while ($row = $resultado_servicos->fetch_assoc()) {
          echo '<div class="w3-container">';
          echo '<h5 class="w3-opacity"><b>' . $row['servico'] . '</b></h5>';
          echo '<p>' . $row['descricao'] . '</p>';
          echo '<hr>';
          echo '</div>';
        }
        ?>
      </div>
      <!-- Àrea de Fromações . Pegue do banco de dados as formações  referentes ao médico selecionado  -->
      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Formação</h2>
        <?php
        // Exibir as formações acadêmicas do médico
        while ($row = $resultado_formacoes->fetch_assoc()) {
          echo '<div class="w3-container">';
          echo '<h5 class="w3-opacity"><b>' . $row['nome_formacao'] . '</b></h5>';
          echo '<h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>' . $row['data_inicio'] . ' - ' . $row['data_termino'] . '</h6>';
          // Se houver mais informações sobre a formação, você pode exibi-las aqui
          echo '<hr>';
          echo '</div>';
        }
        ?>
      </div>

      <!-- End Right Column -->
    </div>

    <!-- End Grid -->
  </div>

  <!-- End Page Container -->
  </div>

  <footer class="w3-container w3-teal w3-center w3-margin-top">
    <p>FacilityOdonto.</p>
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>

  </footer>

</body>

</html>