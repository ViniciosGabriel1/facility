<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Menu</title>
</head>

<body>
    <div class="menu-toggle" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <div class="menu">
        <ul>
            <li><a href="pagina_dentista.php"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li><a href="perfil_dentista.php"><i class="fas fa-user"></i> Perfil</a></li>
            <li><a href="add_loc.php"><i class="fas fa-user"></i> Adicionar Localização</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Configurações</a></li>
            <li><a href="../back/logout.php" style="color: red"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>

    </div>

    <script src="../js/menu.js"></script>
</body>

</html>