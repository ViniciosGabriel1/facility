<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
</head>

<body>

    <h2>Cadastro</h2>

    <form action="back/processa_cadastro.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" onblur="verificarDisponibilidadeEmail()" required>
        <div id="mensagemErro"></div>


        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="confirma_senha">Confirme a Senha:</label>
        <input type="password" id="confirma_senha" name="confirma_senha" onblur="verificarCoincidenciaSenhas()" required>
        <div id="mensagemErroSenha" style="color: red"></div>

        <button type="submit">Cadastrar</button>
        <br>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </form>

    <script src="js/validaEmail.js"></script>
    <script src="js/validaSenha.js"></script>

</body>

</html>

