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
    $sql_dentistas = "SELECT id, nome, especializacao, foto FROM medicos";
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


        <title>Escolha um Dentista</title>
    </head>

    <body>
        <?php include "../paciente/menu.php"; ?>

        <section id="banner">
            <div class="conteiner">
                <h2 class="procura">Que Tipo de Profissional Procura?</h2>
            </div>
            <select class="select-box" onchange="location = this.value;">
                <option value="#one">Clínico Geral</option>
                <option value="#two">Dentista</option>
                <option value="#three">Buco Maxilo</option>
            </select>
        </section>
        <h2>Escolha um Dentista</h2>

        <?php
        if ($result_dentistas->num_rows > 0) {
            while ($row = $result_dentistas->fetch_assoc()) {
        ?>
                <div class="dentista-card">
                    <!-- Ajuste de tamanho da imagem -->
                    <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" style="height: 350px;">
                    <h3>Médico: <?= $row['nome'] ?></h3>
                    <p>Especialização: <?= $row['especializacao'] ?></p>
                    <a href='agendar_consulta.php?id_dentista=<?= $row['id'] ?>'>Marcar Consulta</a>
                </div>

        <?php
            }
        } else {
            echo "<p>Nenhum dentista cadastrado no momento.</p>";
        }
        ?>
    </body>

    </html>