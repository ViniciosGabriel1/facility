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
$sql_dentistas = "SELECT id, nome, especializacao, telefone, foto, link_localizacao FROM medicos";
$result_dentistas = $conn->query($sql_dentistas);

// Fechar a conexão com o banco de dados
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Dentistas</title>
    
    <link rel="stylesheet" href="../css/carrossel.css">
    <link rel="stylesheet" href="../css/paciente.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/filtro.js"></script>

</head>

<body>
    <?php include "menu_paciente.php"; ?>
    <section id="banner">
        <div class="container">
            <div id="changing-text">Que Tipo de Profissional Procura?</div><br><br>
            

        </div>
        <select id="filtro-especializacao" class="select-box">
            <option value="todos">Todos</option>
            <option value="Clínico Geral">Clínico Geral</option>
            <option value="Dentista">Dentista</option>
            <option value="Buco Maxilo">Buco Maxilo</option>
        </select>
    </section>
    <h1><a href="#carrossel" id="scroll-link">Avançar</a></h1>

    <h2>Escolha um Dentista</h2>
    <section class="swiper-container carousel-container">
        <div id="carrossel">
        <?php
        if ($result_dentistas->num_rows > 0) {
            while ($row = $result_dentistas->fetch_assoc()) {
        ?>
                <div class="swiper-slide card <?= $row['especializacao'] ?>">
                    <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" />
                    <div class="card-content">
                        <div class="name">Dr. <?= $row['nome'] ?></div>
                        <div class="profession"><?= $row['especializacao'] ?></div>
                        <div class="button">
                            <button onclick="window.location.href='agendar_consulta.php?id_dentista=<?= $row['id'] ?>'">Agendar</button>
                            <button onclick="window.location.href='ver_medico.php?id_dentista=<?= $row['id'] ?>'">Sobre Mim</button>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>Nenhum dentista cadastrado no momento.</p>";
        }
        ?>
        </div>
    </section>

   <script>
    
        document.addEventListener("DOMContentLoaded", function() {
            var link = document.getElementById('scroll-link');
            link.addEventListener('click', function(e) {
                 // Evita o comportamento padrão do link

                // Obtém o elemento alvo pelo ID
                var target = document.getElementById(this.getAttribute('href').substring(1));

                // Verifica se o elemento alvo existe
                if (target) {
                    // Calcula a posição do elemento alvo em relação ao topo da página
                    var targetPosition = target.getBoundingClientRect().top + window.scrollY;

                    // Anima a rolagem suave até o elemento alvo
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }else{
                    console.log(target + "Não existe")
                }
            });
        });
   
   </script>
</body>

</html>