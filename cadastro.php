<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include "menu_login.php"; ?>
    <section class="signup-section">
        <h2>Cadastro</h2>
        <form id="cadastroForm" action="back/processa_cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>

            <p id="mensagemAviso" style="color: red;"></p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <div id="emailErro" style="color: red;"></div>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <div id="senhaErro" style="color: red;"></div>

            <label for="confirma_senha">Confirme a Senha:</label>
            <input type="password" id="confirma_senha" name="confirma_senha" required>
            <div id="confirmaSenhaErro" style="color: red;"></div>

            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" pattern="[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9A-Za-z]{1}" title="Formato inválido. Por favor, siga o formato XX.XXX.XXX-X" required>
                <div id="rgErro" style="color: red;"></div>
            </div>

            <button type="button" id="btnCadastrar">Cadastrar</button>

        </form>
    </section>

    <script src="js/cadastro.js"></script>

</body>

</html>
