<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/perfil_paciente.css">
    <title>Perfil do Paciente</title>
</head>

<body>
    <?php include "menu_paciente.php"; ?>

    <h2>Seu Perfil</h2>

    <?php
    session_start();
    include "../back/conexao.php";

    // Verificar se o paciente está autenticado
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: index.php");
        exit();
    }

    $id_paciente = $_SESSION["id_usuario"];
    // echo "ID do Paciente: $id_paciente";

    // Consulta SQL para obter as informações do paciente
    $sql = "SELECT nome, telefone, email, foto FROM pacientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $stmt->bind_result($nome, $telefone, $email, $foto);

    // Verificar se o paciente foi encontrado
    if ($stmt->fetch()) {
    ?>
        <div class="info-card">
            <!-- Exibir a foto do paciente se estiver presente -->
            <div class="paciente-card">
                <!-- Ajuste de tamanho da imagem -->
                <img class="img" src="../uploads_pacientes/<?= $foto ?>" alt="Foto do Paciente" style="height: 350px;">
                <h3>Paciente: <?= $nome ?></h3>
                <p>Email: <?= $email ?></p>
                <p>Telefone: <?= $telefone ?></p>
                <a href="editar_paciente.php" class="button">Editar Perfil</a>
            </div>
        </div>

    <?php
    } else {
        echo "<p>Nenhum paciente cadastrado no momento.</p>";
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    ?>

</body>

</html>
