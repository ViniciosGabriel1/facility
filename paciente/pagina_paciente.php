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
        <div class="inf">
            <?php
            session_start();
            if (!isset($_SESSION["id_usuario"])) {
                // Redirecionar para a página de login se não estiver autenticado
                header("Location: ../login.php");
                exit();
            }

            include "../back/conexao.php";

            // O ID do paciente está disponível em $_SESSION["id_paciente"]
            $id_paciente = $_SESSION["id_usuario"];

            // Consulta SQL para obter a lista de dentistas
            $sql_dentistas = "SELECT id, nome, especializacao, telefone, foto, link_localizacao FROM medicos";
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

            // Fechar a conexão com o banco de dados
            $conn->close();

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
        </div>

        <div class="container">
            <div id="changing-text"><strong>Nos ajude a encontrar o profissional certo para você!</strong></div><br><br>

            <div class="filtro-especializacao">
                <button class="filtro-btn" data-especializacao="todos">Todos</button>
                <button class="filtro-btn" data-especializacao="Clínico Geral">Clínico Geral</button>
                <button class="filtro-btn" data-especializacao="Dentista">Dentista</button>
                <button class="filtro-btn" data-especializacao="Cirurgiao">Cirurgião</button>
                <button class="filtro-btn" data-especializacao="Buco Maxilo">Buco Maxilo</button>
            </div>
        </div>
    </section>

    <h2>Veja os dentistas disponíveis para você</h2>
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
            ?>
        </div>
    </section>

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
        }, 4000); // 3000 milissegundos = 3 segundos
    </script>

</body>

</html>
