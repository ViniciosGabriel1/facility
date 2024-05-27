

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <a href="index.php"><div class="logo"><strong>FacilityOdonto</strong></div></a><input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="#" class="active"><i class="fa fa-home"></i> <strong>Home</strong></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-search"></i> <strong>Sobre o Sistema</strong></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-calendar"></i> <strong>Contatos</strong></a>
                </li>
            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </header>

    <?php

session_start();

// Verificar se o parâmetro 'logout' está presente na URL e se é igual a 1
if(isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Exibir a mensagem de logout
    echo '<p id="logoutMessage">Você foi desconectado com sucesso!</p>';
}
?>


<h2>Obtenha seu exame e tratamento odontológico completo</h2>

<div id="show">
    <!-- Adição da imagem centralizada -->
    <img class="img" src="img/login2.svg" alt="Sua Imagem" width="400" height="400" style="margin-top: 12%;">
    

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

    <script>
// Esperar 3 segundos e, em seguida, ocultar suavemente a mensagem de logout
setTimeout(function(){
    var logoutMessage = document.getElementById('logoutMessage');
    if(logoutMessage) {
        logoutMessage.classList.add('fade-out'); // Adiciona a classe para iniciar a animação

        // Após a animação, remove a mensagem
        setTimeout(function(){
            logoutMessage.style.display = 'none';
        }, 1000); // Ajuste o tempo para corresponder à duração da animação CSS
    }
}, 3000); // 3000 milissegundos = 3 segundos
</script>


</body>

</html>
