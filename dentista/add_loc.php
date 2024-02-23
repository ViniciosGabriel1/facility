<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/localizacao.css">
    <title>Adicionar Localização da Clínica</title>
</head>
<body>
<?php include "../dentista/menu_dentista.php"; ?>

    <h2>Adicionar Localização da Clínica</h2>
    <form action="../back/processar_localizacao.php" method="post">

        <label for="link_localizacao">Link da Localização:</label>
        <input type="text" id="link_localizacao" name="link_localizacao" required><br><br>

        <input type="submit" value="Adicionar Localização">
    </form>
</body>
</html>
