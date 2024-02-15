<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

<header>
<h1 class="logo">FacilityOdonto</h1>
		<div class="container">
        
			<nav class="headernav" id="headnav">
                
				<ul>
					<li class="active"><a href="#home">Home</a></li>
					<li><a href="#about">Sobre Sistema</a></li>
					<li><a href="#contact">Contato</a></li>
				</ul>
			</nav>¨
            </div>





	</header>
    <div class="bannertext">
        <h2>
        Obtenha seu exame e tratamento odontológico completo.
        </h2>
    </div>

    <div class="login-container">
        <!-- Adição da imagem centralizada -->
        <img src="img/logoblue.png" alt="Logo" class="logo">

        <div class="videoouter">
            <video autoplay muted loop>
                <source src="img/videobg2.mp4" type="video/mp4">
            </video>
        </div>



        <h2>Login</h2>
        <div id="form">
            <form action="back/processa_login.php" method="POST">
                <label for="username">Usuário (E-mail):</label>
                <input type="text" id="username" name="email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required autocomplete="off">

                <label for="usertype">Você é um:</label>
                <select id="usertype" name="usertype" required>
                    <option value="dentista">Dentista</option>
                    <option value="paciente">Paciente</option>
                </select>

                <br><button type="submit" class="login-button">Entrar</button>
            </form>
        </div>
        <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se como Paciente</a> ou <a href="cadastro_medico.php">Cadastre-se como Médico</a></p>
    </div>
</body>

</html>