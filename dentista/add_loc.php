<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/servico.css">
    <title>Adicionar Localização da Clínica</title>


    <style>
        .fac {
            /* margin-top: 1px; */
            margin: -20px;
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
    <?php include "menu_dentista.php"; ?>

    <h2>Adicionar Localização da Clínica</h2>
    <form action="../back/processar_localizacao.php" method="post">

        <label for="link_localizacao">Link da Localização:</label>
        <input type="text" id="link_localizacao" name="link_localizacao" required><br><br>

        <input type="submit" value="Adicionar Localização">
    </form>
</body>

</html>