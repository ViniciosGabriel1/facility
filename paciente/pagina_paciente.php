<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Dentistas</title>

    <link rel="stylesheet" href="../css/carrossel.css">
    <link rel="stylesheet" href="../css/paciente.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/filtro.js"></script>
</head>

<body>
    <?php include "menu_paciente.php";
    echo  "<section id='banner'>";
    echo "<div class='inf'>";


    session_start();
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: ../index.php");
        exit();
    }

    include "../back/conexao.php";



    // O ID do paciente está disponível em $_SESSION["id_paciente"]
    $id_paciente = $_SESSION["id_usuario"];


    // Consulta SQL para obter a lista de dentistas com a quantidade de avaliações
    $sql_dentistas = "SELECT m.id, m.nome, m.especializacao, m.telefone, m.foto, m.link_localizacao, AVG(a.estrelas) AS media_avaliacao, COUNT(a.id_avaliacao) AS total_avaliacoes 
                              FROM medicos m
                              LEFT JOIN avaliacoes a ON m.id = a.id_medico
                              GROUP BY m.id
                              ORDER BY media_avaliacao DESC";

    $result_dentistas = $conn->query($sql_dentistas);

    // Consulta SQL para contar o número de consultas do usuário logado com status "Agendada" ou "Reagendada"
    $sql_consultas = "SELECT COUNT(*) AS total_consultas FROM consultas WHERE id_paciente = ? AND (status = 'Agendada' OR status = 'Reagendada')";
    $stmt_consultas = $conn->prepare($sql_consultas);
    $stmt_consultas->bind_param("i", $id_paciente);
    $stmt_consultas->execute();
    $result_consultas = $stmt_consultas->get_result();
    $total_consultas = $result_consultas->fetch_assoc()["total_consultas"];

    // Definir o limite máximo de consultas
    $limite_consultas = 2;

    // Verificar se o usuário ultrapassou o limite de consultas
    if ($total_consultas >= $limite_consultas) {
        echo '<p id= "limiteMsg">Você atingiu o limite máximo de consultas.</p>';
    } else {
        // Verificar se o parâmetro 'login' está presente na URL
        if (isset($_GET['login'])) {
            $login_status = $_GET['login'];
            // Verificar o valor do parâmetro 'login'
            if ($login_status === 'success') {
                // Exibir mensagem de boas-vindas
                echo '<p id="loginMsg">Login bem-sucedido!</p>';
            } else {
                // Exibir mensagem de falha no login
                echo '<p>Falha no login. Por favor, verifique suas credenciais.</p>';
            }
        }
    }
    ?>

    <div class="container">
    <h3><strong>Conte conosco para tornar a busca pelo especialista ideal uma experiência <br>tranquila e eficiente!</strong></h3>
        <div class="filtro-especializacao">

            <button class="filtro-btn" data-especializacao="todos">Todos</button>
            <button class="filtro-btn" data-especializacao="Clínico Geral">Clínico Geral</button>
            <button class="filtro-btn" data-especializacao="Dentista">Dentista</button>
            <button class="filtro-btn" data-especializacao="Cirurgiao">Cirurgião</button>
            <button class="filtro-btn" data-especializacao="Buco Maxilo">Buco Maxilo</button>
        </div>
    </div>
    </div>
    </section>




    <h2>Veja os dentistas disponíveis para você</h2>
    <section class="swiper-container carousel-container">
        <div id="carrossel">
            <?php
            if ($result_dentistas->num_rows > 0) {
                while ($row = $result_dentistas->fetch_assoc()) {
                    // Exibir os cards dos médicos
            ?>
                    <div class="swiper-slide card <?= $row['especializacao'] ?>">
                        <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" />
                        <div class="rating" style='display: flex;
    align-items: center;'>
                            <?php
                            // Exibir as estrelas com base na média das avaliações
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $row['media_avaliacao']) {
                                    echo "<i class='fas fa-star star-filled' style='color: yellow;'></i>"; // Estrela preenchida
                                } else {
                                    echo "<i class='far fa-star'></i>"; // Estrela vazia
                                }
                            }
                            ?>
                            <a href="#" id="openModal" data-id-medico="<?php echo $row['id']; ?>" data-modal="modal-avaliacoes"><?= $row['total_avaliacoes'] ?> avaliações</a>

                        </div>
                        <div class="card-content">
                            <div class="name">Dr. <?= $row['nome'] ?></div>
                            <div class="profession"><?= $row['especializacao'] ?></div>
                            <div class="button">
                                <?php if ($total_consultas < $limite_consultas) : ?>
                                    <button onclick="agendarConsulta(<?= $row['id'] ?>)">Agendar</button><br><br>
                                <?php else : ?>
                                    <button disabled>Conclua as consultas pendentes</button><br><br>
                                <?php endif; ?>
                                <button onclick="window.location.href='ver_medico.php?id_dentista=<?= $row['id'] ?>'">Sobre Mim</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Nenhum dentista cadastrado no momento.</p>";
            }

            // Fechar a consulta de dentistas
            $result_dentistas->close();
            ?>
        </div>
        <div id="modal-avaliacoes" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Avaliações do Médico</h3>
            <div id="avaliacoes-conteudo">
                <!-- Aqui serão exibidas as avaliações do médico -->
            </div>
        </div>
    </div>
    </section>


    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script>
        // Evento de clique nos links "avaliações"
        document.querySelectorAll('#carrossel .rating a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var modalId = this.getAttribute('data-modal');
                var idMedico = this.getAttribute('data-id-medico'); // Obter o ID do médico
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'block';

                    // Enviar uma solicitação AJAX para buscar as avaliações do médico
                    $.ajax({
                        type: 'POST',
                        url: '../back/buscar_avaliacoes.php',
                        data: {
                            id_medico: idMedico
                        },
                        success: function(response) {
                            // Exibir as avaliações no modal
                            document.getElementById('avaliacoes-conteudo').innerHTML = response;
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        // Evento de clique no botão de fechar do modal
        document.querySelectorAll('.close').forEach(closeBtn => {
            closeBtn.addEventListener('click', function() {
                var modal = this.parentElement.parentElement;
                if (modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>


    <script>
        function agendarConsulta(idDentista) {
            // Verificar se o usuário ultrapassou o limite de consultas
            <?php if ($total_consultas < $limite_consultas) : ?>
                window.location.href = 'agendar_consulta.php?id_dentista=' + idDentista;
            <?php endif; ?>
        }

        // Script para fazer a mensagem de login desaparecer após alguns segundos
        setTimeout(function() {
            var message = document.getElementById('loginMsg');
            if (message) {
                message.classList.add('fade-out'); // Adiciona a classe para iniciar a animação

                // Após a animação, remove a mensagem
                setTimeout(function() {
                    message.style.display = 'none';
                }, 1000); // Ajuste o tempo para corresponder à duração da animação CSS
            }

            var message = document.getElementById('limiteMsg');
            if (message) {
                message.classList.add('fade-out'); // Adiciona a classe para iniciar a animação

                // Após a animação, remove a mensagem
                setTimeout(function() {
                    message.style.display = 'none';
                }, 1000); // Ajuste o tempo para corresponder à duração da animação CSS
            }
        }, 4000); // 4000 milissegundos = 4 segundos
    </script>

</body>

</html>