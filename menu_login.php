<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Responsive Navbar using HTML & CSS</title>
</head>
<body>
    <header>
    <a href="login.php"><div class="logo"><strong>FacilityOdonto</strong></div></a><input type="checkbox" id="nav_check" hidden>
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
</body>
</html>
