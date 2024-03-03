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
    <link rel="stylesheet" href="../css/agendamento.css">
    <title>Editar Serviço</title>
    <!-- Seus links para estilos CSS podem vir aqui -->

    <style>
        form {
    margin-bottom: 30%;
    width: 80%;
    max-width: 600px;
    margin-top: -10px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

    </style>
</head>
<body>
<?php include "../dentista/menu_dentista.php"; ?>

    <h2>Editar Serviço</h2>
    <?php
    // Inclua o arquivo de conexão com o banco de dados
    include_once "../back/conexao.php";

    // Verifique se o ID do serviço foi passado via GET
    if(isset($_GET['id'])) {
        $id_servico = $_GET['id'];

        // Consulta SQL para selecionar o serviço com base no ID fornecido
        $sql = "SELECT * FROM servicos WHERE id = $id_servico";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $servico = $resultado->fetch_assoc();
    ?>
            <form action="../back/processa_edicao_servico.php" method="POST">
                <input type="hidden" name="id_servico" value="<?php echo $servico['id']; ?>"
                <label for="nome">Nome do Serviço:</label><br>
                <input type="text" id="nome" name="nome" value="<?php echo $servico['servico']; ?>"><br><br>
                <label for="descricao">Descrição:</label><br>
                <textarea id="descricao" name="descricao"><?php echo $servico['descricao']; ?></textarea><br><br>
                <button type="submit">Salvar Alterações</button>
            </form>
    <?php
        } else {
            echo "Serviço não encontrado.";
        }
    } else {
        echo "ID do serviço não especificado.";
    }
    ?>
</body>
</html>
