<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403); // Proibido
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Serviços</title>
    
    <link rel="stylesheet" href="../css/servico1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php include "menu_dentista.php"; ?>
    <h1 class="pergunta">Quer Adicionar algum Serviço?</h1>
    <div class="container-wrapper">
        <img src="../img/doctor.svg" alt="Descrição da imagem" class="background-image">

        <div class="container">
            <h2>Adicionar Serviços</h2>
            <form id="form-servico">
                <div class="form-group">
                    <label for="nome">Nome do Serviço</label>
                    <input type="text" id="nome" name="servico" class="form-control" placeholder="Digite o nome do serviço" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição do Serviço</label>
                    <textarea id="descricao" name="descricao" class="form-control" placeholder="Descreva o serviço" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Adicionar Serviço</button>
            </form>
            <div id="mensagem" class="mensagem"></div>
        </div>
    </div>
    <script src="../js/servico.js"></script>
</body>
</html>
