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
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Escolha um Dentista</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/teste.css">
        <link rel="stylesheet" href="../css/paciente.css">

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
        <h2>Escolha um Dentista</h2>
        <section>
            <div class="swiper mySwiper container">
                <div class="swiper-wrapper content">
                    <?php
                    if ($result_dentistas->num_rows > 0) {
                        while ($row = $result_dentistas->fetch_assoc()) {
                    ?>
                            <div class="swiper-slide card">
                                <div class="card-content">
                                    <div class="image">
                                        <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" />
                                    </div>
                                    <div class="social-media">
                                        <!-- Adicione ícones de redes sociais se aplicável -->
                                    </div>
                                    <div class="name-profession">
                                        <span class="name">Dr. <?= $row['nome'] ?></span>
                                        <span class="profession"><?= $row['especializacao'] ?></span>
                                    </div>
                                    <div class="button">
                                        <!-- Adicione botões ou links para mais detalhes se necessário -->
                                        <button class="aboutMe" onclick="window.location.href='ver_medico.php?id_dentista=<?= $row['id'] ?>'">Sobre Mim</button>
                                        <button class="hireMe" onclick="window.location.href='agendar_consulta.php?id_dentista=<?= $row['id'] ?>'">Contratar</button>


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
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script src="../js/trocaCor.js"></script>
        <script src="../js/verMais.js"></script>
        <script src="../js/filtro.js"></script>

    </body>

    </html>