<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/procura_medico.css">
    <title>Pesquisar Médicos</title>
    
</head>

<body>
<h2>Resultados da Pesquisa</h2>
    <?php
    include "menu.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "back/conexao.php";

        // Preparar a consulta SQL
        $sql = "SELECT id, nome, especializacao, foto, telefone FROM medicos WHERE LOWER(nome) LIKE ? OR LOWER(especializacao) LIKE ?";
        $stmt = $conn->prepare($sql);

        // Verificar se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Adicionar '%' ao termo de pesquisa para corresponder a qualquer parte do nome ou especialização
        $searchTerm = '%' . strtolower($_POST["search"]) . '%';

        // Vincular os parâmetros e executar a consulta
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();

        // Obter os resultados
        $result = $stmt->get_result();
    ?>
       

        <div class="results-container">
            <?php
            // Exibir os resultados
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="result-card">
                    <img src="uploads/<?= $row['foto'] ?>" alt="Foto do Médico"  style="height: 350px;">
                    <h3><?= $row["nome"] ?></h3>
                    <p>Especialização: <?= $row["especializacao"] ?></p>
                    <p>Telefone: <?= $row["telefone"] ?></p>
                    <a href="agendar_consulta.php?id_dentista=<?= $row['id'] ?>">Marcar Consulta</a>
                </div>
            <?php
            }

            // Fechar a declaração
            $stmt->close();

            // Fechar a conexão com o banco de dados
            $conn->close();
            ?>
        </div>
    <?php
    }
    ?>

    <h2>Pesquisar Médicos</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="search">Pesquisar por Nome ou Especialização:</label>
        <input type="text" id="search" name="search" required>
        <button type="submit">Pesquisar</button>
    </form>

</body>

</html>
