<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editar_perfil.css">
    <title>Editar Perfil</title>
</head>

<body>
<?php include "menu.php"; ?>

    <div class="form-container">
        <h2>Editar Perfil</h2>
        <form action="back/processa_edicao_paciente.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" onblur="verificarDisponibilidadeEmail()" required>
            <div id="mensagemErro"></div>
            
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <button type="submit">Salvar Alterações</button>
        </form>

        <p class="back-link"><a href="pagina_paciente.php">Voltar para a Página Inicial</a></p>
    </div>

    <script src="js/validaEmail.js"></script>
    

</body>

</html>
