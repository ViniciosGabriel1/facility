<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu_dentista.css">
    <link rel="stylesheet" href="../css/servico.css">
    <title>Adicionar Formação</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .fac {
            /* margin-top: 1px; */
            margin: -50px;
            padding: 0.5%;
            background: #28B6F65c;
            width: 100%;
            padding-right: 10%;
            color: white;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            position: fixed;
            z-index: 1;
        }



        .fac h1 {

            position: absolute;
            /* Adiciona posição absoluta ao h1 */
            top: 0;
            /* Coloca o h1 no topo do contêiner pai (.fac) */
            left: 0;
            /* Coloca o h1 no canto superior esquerdo do contêiner pai (.fac) */
            width: 100%;
            /* Define a largura do h1 como 100% do contêiner pai (.fac) */
            margin: 0;
            /* Remove margens do h1 */
            padding: 10px;
            /* Adiciona preenchimento ao h1 conforme necessário */
            z-index: 1000;
            /* Define a ordem de empilhamento do h1 */
        }

        /* Estilo para dispositivos móveis */
        @media (max-width: 767px) {
            .fac {
                padding: 10px;
                position: fixed;
                padding-left: 70px;
                padding-right: 100px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                z-index: 1;
                /* margin-top: -28px; */
            }
        }
    </style>

</head>

<body>


    <?php include "../dentista/menu_dentista.php"; ?>

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

    <script src="../js/formacao.js"></script> <!-- Importe seu arquivo de script JavaScript aqui -->
</body>

</html>