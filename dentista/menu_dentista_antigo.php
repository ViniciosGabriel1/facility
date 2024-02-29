<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu_dentista.css">
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
            <li class="submenu-toggle"><a href="#"><i class="fas fa-plus"></i> Cadastros Gerais</a>
                <ul class="submenu hidden">
                    <li><a href="add_loc.php"><i class="fas fa-map-marker"></i> Adicionar Localização</a></li>
                    <li><a href="add_servico.php"><i class="fas fa-tools"></i>Adicionar Serviços</a></li>
                    <li><a href="add_formacao.php"><i class="fas fa-graduation-cap"></i> Adicionar Formação</a></li>

                    <!-- Adicione outras opções de cadastro aqui -->
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-cogs"></i> Configurações</a></li>
            <li><a href="../back/logout.php" style="color: red"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var submenuToggle = document.querySelector(".submenu-toggle");
            var submenu = document.querySelector(".submenu");

            submenuToggle.addEventListener("click", function() {
                submenu.classList.toggle("active");
            });
        });
    </script>
    <script src="../js/menu.js"></script>
</body>

</html>