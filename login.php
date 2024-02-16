<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <header class="header">
        <div class="nav" id="headnav">
            <h1 class="logo">FacilityOdonto</h1>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
            <ul class="nav-list">
                <li class="active"><a href="#home">Home</a></li>
                <li><a href="#about">Sobre Sistema</a></li>
                <li><a href="#contact">Contato</a></li>
            </ul>
        </div>
    </header>

    <div class="hero">
        <div class="bannertext">
            <h2><span> e tratamento odontológico completo.</span> Obtenha seu exame </h2>
        </div>
    </div>

    <div class="login-container">
        <!-- Adição da imagem centralizada -->

        <div class="videoouter">
            <video autoplay muted loop>
                <source src="img/videobg2.mp4" type="video/mp4">
            </video>
        </div>

        <div id="form-container">
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
                    <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se como Paciente</a> ou <a href="cadastro_medico.php">Cadastre-se como Médico</a></p>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById('headnav').classList.toggle('show-menu');
        }
    </script>

</body>

</html>
