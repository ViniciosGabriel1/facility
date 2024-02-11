<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="back/processa_login.php" method="post">
            <label for="username">Usuário (E-mail):</label>
            <input type="text" id="username" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <label for="usertype">Você é um:</label>
            <select id="usertype" name="usertype" required>
                <option value="dentista">Dentista</option>
                <option value="paciente">Paciente</option>
            </select>

            <br><button type="submit">Entrar</button>
        </form>

        <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se como Paciente</a> ou <a href="cadastro_medico.php">Cadastre-se como Médico</a></p>

    </div>
</body>
</html>
