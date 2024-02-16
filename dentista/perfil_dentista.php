<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil_paciente.css">
    <title>Perfil do Paciente</title>
</head>

<body>
    <?php include "menu_dentista.php"; ?>

    <h2>Seu Perfil</h2>

    <?php
    session_start();
    include "../back/conexao.php";

    // Verificar se o paciente está autenticado
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: login.php");
        exit();
    }

    // Obter o ID do medico
    $id_medico = $_SESSION["id_usuario"];

    // Consulta SQL para obter as informações do medico
    $sql = "SELECT nome, especializacao, telefone, email, foto FROM medicos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_medico);
    $stmt->execute();
    $stmt->bind_result($nome,$especializacao, $telefone, $email, $foto);

    // Verificar se o medico foi encontrado
    if ($stmt->fetch()) {
    ?>
        <div class="info-card">
            <!-- Exibir a foto do medico se estiver presente -->
            <div class="paciente-card">
                <!-- Ajuste de tamanho da imagem -->
                <img class = "img"src="../uploads/<?= $foto ?>" alt="Foto do Médico" style="height: 350px;">
                <h3>Médico: <?= $nome ?></h3>
                <p>Especialização: <?= $especializacao ?></p>
                <p>Email: <?= $email ?></p>
                <p>Telefone: <?= $telefone ?></p>
                <a href="../editar_medico.php" class="button">Editar Perfil</a>
            </div>
        </div>

    <?php
    } else {
        echo "<p>Nenhum médico cadastrado no momento.</p>";
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    ?>

</body>

</html>
