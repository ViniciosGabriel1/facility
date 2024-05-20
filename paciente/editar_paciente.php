<?php
session_start();

include "../back/conexao.php";

// Verificar se o paciente está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}

// ID do paciente autenticado
$id_paciente = $_SESSION['id_usuario'];

// Consulta SQL para obter as informações do paciente
$sql = "SELECT nome, email, telefone FROM pacientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$stmt->bind_result($nome, $email, $telefone);

// Verificar se o paciente foi encontrado
if ($stmt->fetch()) {
    // Os dados do paciente foram recuperados com sucesso, agora vamos pré-selecioná-los nos campos do formulário
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/editar_perfil.css">
    <title>Editar Perfil</title>
</head>

<body>
    <?php include "menu_paciente.php"; ?>

    <div class="form-container">
        <h2>Editar Perfil</h2>
        <form action="back/processa_edicao_paciente.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= $nome ?>">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" onblur="verificarDisponibilidadeEmail()">
            <div id="mensagemErro"></div>
            
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" value="<?= $telefone ?>">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha">

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <button type="submit">Salvar Alterações</button>
        </form>

        <p class="back-link"><a href="pagina_paciente.php">Voltar para a Página Inicial</a></p>
    </div>

    <script src="js/validaEmail.js"></script>
</body>

</html>

<?php
} else {
    echo "Erro ao recuperar informações do paciente.";
}

// Fechar a consulta e a conexão com o banco de dados
$stmt->close();
$conn->close();
?>
