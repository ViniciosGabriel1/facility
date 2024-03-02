<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_loc.css">
    <title>Adicionar Localização da Clínica</title>
</head>

<body>
    <?php include "menu_dentista.php"; ?>
    <h1 class="pergunta">Agora fica fácil achar você</h1>

    <div class="container-wrapper">
        <div class="background-image">
            <img src="../img/loc.svg" alt="Imagem de fundo" class="background-image">
        </div>

        <div class="container">
            <h2>Adicionar Localização da Clínica</h2>
            <form action="../back/processar_localizacao.php" method="post">

                <div class="form-group">
                    <label for="link_localizacao">Link da Localização:</label><br>
                    <input type="text" id="link_localizacao" name="link_localizacao" class="form-control" required>
                </div>

                <input type="submit" value="Adicionar Localização" class="btn-submit">
            </form>
        </div>
    </div>
</body>

</html>
