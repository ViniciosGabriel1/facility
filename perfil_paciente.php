<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/perfil_paciente.css">
    <title>Perfil do Paciente</title>
</head>

<body>
    <?php include "menu.php"; ?>

    <h2>Seu Perfil</h2>

    <?php
    session_start();
    include "back/conexao.php";

    // Verificar se o paciente está autenticado
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: login.php");
        exit();
    }

    // Obter o ID do paciente
    $id_paciente = $_SESSION["id_usuario"];

    // Consulta SQL para obter as informações do paciente
    $sql = "SELECT nome, telefone, email FROM pacientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $stmt->bind_result($nome, $telefone, $email);

    // Verificar se o paciente foi encontrado
    if ($stmt->fetch()) {
    ?>
        <div class="info-card">
            <p><strong>Nome:</strong> <?php echo $nome; ?></p>
            <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
        </div>

        <!-- Adicione links ou botões para editar as informações se desejar -->
        <a class= "a" href="editar_perfil_paciente.php">Editar Perfil</a>

    <?php
    } else {
        echo "<p>Não foi possível recuperar as informações do paciente.</p>";
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    ?>

</body>

</html>
