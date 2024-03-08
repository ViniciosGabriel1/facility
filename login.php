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
<?php include "menu_login.php";?>

    <div class="hero">
        <div class="bannertext">

            <br><h2><span><strong>e tratamento odontológico completo.</strong> </span> Obtenha seu exame </h2>
        </div>
    
        <!-- Adição da imagem centralizada -->

        <div class="videoouter">
            <video autoplay muted loop>
                <source src="img/videobg2.mp4" type="video/mp4">
            </video>
        </div>

                <form action="back/processa_login.php" method="POST">

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
