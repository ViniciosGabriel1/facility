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
    <br><h2>Cadastre-se Já.</h2>
    <button onclick="goBack()">Voltar</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
    <div id="show">
    <img class="img" src="img/cadastro.svg" alt="Sua Imagem" width="400" height="400" style="margin-top: 12%;">

    <section class="signup-section">

        <h2>Cadastro</h2>
        <form id="cadastroForm" action="back/processa_cadastro.php" method="post">
            <!-- <label for="nome">Nome:</label> -->
            <input type="text" id="nome" name="nome" placeholder="Seu Nome"required><br>

            <!-- <label for="telefone">Telefone:</label> -->
            <input type="tel" id="telefone" name="telefone" placeholder="Telefone"required><br>

            <p id="mensagemAviso" style="color: red;"></p>
            <!-- <label for="email">Email:</label> -->
            <input type="email" id="email" name="email" placeholder="E-mail"required><br>
            <div id="emailErro" style="color: red;"></div>

            <!-- <label for="senha">Senha:</label> -->
            <input type="password" id="senha" name="senha" placeholder="Senha"    required><br>
            <div id="senhaErro" style="color: red;"></div>

            <!-- <label for="confirma_senha">Confirme a Senha:</label> -->
            <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Confirme Senha"required><br>
            <div id="confirmaSenhaErro" style="color: red;"></div>

            <!-- <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required>
                <div id="rgErro" style="color: red;"></div>
            </div> -->

            <button type="button" id="btnCadastrar">Cadastrar</button><br>
            <p class="signup-link">Já tem uma conta? <a href="login.php">Entre aqui!</a></p>


        </form>
    </section>
    </div>

    <script src="js/cadastro.js"></script>

</body>

</html>
