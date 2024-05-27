<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Responsive Navbar using HTML & CSS</title>
</head>

<body>
    <header>
        <a href="pagina_paciente.php">
            <div class="logo"><strong>FacilityOdonto <i class="fas fa-tooth"></i>
                </strong></div>
        </a><input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="pagina_paciente.php" class="active"><i class="fa fa-home"></i> <strong>Home</strong></a>
                </li>
                <li>
                    <a href="procura_medico.php"><i class="fa fa-search"></i> <strong>Procurar Médico</strong></a>
                </li>
                <li>
                    <a href="historico_consulta.php"><i class="fa fa-calendar"></i> <strong>Consultas</strong></a>
                </li>
                <li>
                    <a href="perfil_paciente.php"><i class="fa fa-user"></i> <strong>Perfil</strong></a>
                </li>
                <li>
                    <a href="../back/logout.php"><i class="fa fa-sign-out"></i> <strong>Logout</strong></a>
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