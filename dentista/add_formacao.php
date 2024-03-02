<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Formação</title>
    <link rel="stylesheet" href="../css/formacao.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php include "menu_dentista.php"; ?>
    <h1 class="pergunta">Formação ainda incompleta?</h1>
    <div class="container-wrapper">
    <!-- Início da imagem -->
    <img src="../img/formacao.svg" alt="Descrição da imagem" class="background-image">
    <!-- Fim da imagem -->

    <div class="container">
        <h2>Adicionar Formação</h2>
        <form id="form-formacao">
            <div class="form-group">
                <label for="nome_formacao">Nome da Formação:</label><br>
                <input type="text" id="nome_formacao" name="nome_formacao" class="form-control">
            </div>
            <div class="form-group">
                <label for="data_inicio">Data de Início:</label><br>
                <input type="date" id="data_inicio" name="data_inicio" class="form-control">
            </div>
            <div class="form-group">
                <label for="data_termino">Data de Término (ou Previsão):</label><br>
                <input type="date" id="data_termino" name="data_termino" class="form-control">
            </div>
            <button type="submit" class="btn-submit">Adicionar Formação</button>
        </form>
        <div id="mensagem"></div>
    </div>
    </div>

    <script src="../js/formacao.js"></script>
</body>
</html>
