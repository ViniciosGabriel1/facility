    <?php

    session_start();

    // Verificar se o usuário está autenticado (possui uma sessão ativa)
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: login.php");
        exit();
    }

    include "../back/conexao.php";
    // O ID do paciente está disponível em $_SESSION["id_paciente"]
    $id_paciente = $_SESSION["id_usuario"];

    // Consulta SQL para obter a lista de dentistas
    $sql_dentistas = "SELECT id, nome, especializacao,telefone, foto FROM medicos";
    $result_dentistas = $conn->query($sql_dentistas);


    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/paciente.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/verMais.js"></script>
    <title>Escolha um Dentista</title>
</head>
<body>
<?php include "../paciente/menu.php"; ?>
<section id="banner">
    <h1 class="fac">FacilityOdonto</h1>
    <div class="conteiner">
        <h2 class="procura">Que Tipo de Profissional Procura?</h2>
    </div>
    <select id="filtro-especializacao" class="select-box">
        <option value="todos">Todos</option>
        <option value="Clínico Geral">Clínico Geral</option>
        <option value="Dentista">Dentista</option>
        <option value="Buco Maxilo">Buco Maxilo</option>
    </select>
</section>
<h2>Escolha um Dentista</h2>
<?php
if ($result_dentistas->num_rows > 0) {
    while ($row = $result_dentistas->fetch_assoc()) {
        ?>
        <div class="dentista-card" data-especializacao="<?= $row['especializacao'] ?>">
            <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" style="height: 350px;">
            <h3>Doutor <?= $row['nome'] ?></h3>
            <p>Especialização: <?= $row['especializacao'] ?></p>
            
          
           
            <a href='agendar_consulta.php?id_dentista=<?= $row['id'] ?>'>Marcar Consulta</a>
            <button class="ver-mais-btn"
                    data-foto="../uploads/<?= $row['foto'] ?>"
                    data-nome="<?= $row['nome'] ?>"
                    data-especializacao="<?= $row['especializacao'] ?>">Ver Mais
            </button>

            <a class="whatsapp-btn" href="https://wa.me/<?= $row['telefone'] ?>" target="_blank">
    <img src="../img/whatsapp.png" alt="WhatsApp" style="height: 30px;">
    Entrar em contato pelo WhatsApp
</a>
        </div>
        <?php
    }
} else {
    echo "<p>Nenhum dentista cadastrado no momento.</p>";
}
?>
<!-- Estrutura do modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Informações do Médico</h2>
        <div id="medico-details">
            <img id="medico-foto" src="" alt="Foto do Médico" style="height: 350px;">
            <p><strong>Nome:</strong> <span id="medico-nome"></span></p>
            <p><strong>Especialização:</strong> <span id="medico-especializacao"></span></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#filtro-especializacao').change(function() {
            var especializacaoSelecionada = $(this).val();

            $('.dentista-card').each(function() {
                var especializacaoCard = $(this).data('especializacao');

                if (especializacaoSelecionada === 'todos' || especializacaoSelecionada === especializacaoCard) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
</body>
</html>
