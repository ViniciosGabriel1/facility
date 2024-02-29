<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Responsive Navbar using HTML & CSS</title>
</head>
<body>
    <header>
        <div class="logo"><strong>FacilityOdonto</strong></div>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="pagina_paciente.php" class="active"><strong>Home</strong></a>
                </li>
                <li>
                    <a href="procura_medico.php"><strong>Procurar Médico</strong></a>
                </li>
                <li>
                    <a href="historico_consulta.php"><strong>Consultas</strong></a>
                </li>
                <li>
                    <a href="perfil_paciente.php"><strong>Perfil</strong></a>
                </li>
                <li>
                    <a href="../back/logout.php"><strong>Logout</strong></a>
                </li>
            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </header>
</body>
</html>