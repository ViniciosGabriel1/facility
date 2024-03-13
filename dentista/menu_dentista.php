<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Responsive Navbar using HTML & CSS</title>
    <style>
        /* Adicione estilos personalizados aqui, se necessário */
    </style>
</head>

<body>
    <header>
    <a href="pagina_dentista.php"><div class="logo"><strong>FacilityOdonto</strong></div></a>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li>
                    <a href="pagina_dentista.php" class="active"><i class="fa fa-home"></i> <strong> Home</strong></a>
                </li>

                <li class="submenu">
                    <input type="checkbox" id="submenu_check" hidden>
                    <label for="submenu_check"><i class="fa fa-calendar"></i><strong> Informações adicionais</strong></label>
                    <ul class="submenu-content">
                        <li>
                            <a href="add_loc.php"><i class="fa fa-map-marker"></i> Adicionar Localização</a>
                        </li>
                        <li>
                            <a href="add_servico.php"><i class="fa fa-wrench"></i> Adicionar Serviços</a>
                        </li>
                        <li>
                            <a href="add_formacao.php"><i class="fa fa-graduation-cap"></i> Adicionar Formação</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="perfil_dentista.php"><i class="fa fa-user"></i> <strong>Perfil</strong></a>
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