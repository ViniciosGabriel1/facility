<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php include "menu_login.php"; ?>

<h2>Obtenha seu exame e tratamento odontológico completo</h2>

<div id="show">
    
    <!-- Adição da imagem centralizada -->
    <img class="img" src="img/login.svg" alt="Sua Imagem" width="400" height="400" style="margin-top: 12%;">

    <form class = "form" action="back/processa_login.php" method="POST">

        <label for="username"><strong>Usuário (E-mail):</strong></label>
        <input type="text" id="username" name="email" required>

        <label for="password"><strong>Senha:</strong></label>
        <input type="password" id="password" name="password" required autocomplete="off">

        <label for="usertype"><strong>Você é um:</strong></label>
        <select id="usertype" name="usertype" required>
            <option value="paciente">Paciente</option>
            <option value="dentista">Dentista</option>
        </select>

        <br><button type="submit" class="login-button">Entrar</button>
        <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se como Paciente</a> ou <a href="cadastro_medico.php">Cadastre-se como Médico</a></p>
    </form>
    </div>

</body>

</html>
