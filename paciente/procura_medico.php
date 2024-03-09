

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/procura_medico.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Pesquisar Médicos</title>
</head>
<?php
session_start();
include "../back/conexao.php";

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
    <link rel="stylesheet" href="../css/procura_medico.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/results.css">
    <title>Pesquisar Médicos</title>
</head>

<body>

    <?php
    include "menu_paciente.php";
    $numDoctors = 0;
    $showResults = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "SELECT id, nome, especializacao, foto, telefone FROM medicos WHERE LOWER(nome) LIKE ? OR LOWER(especializacao) LIKE ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $searchTerm = '%' . strtolower($_POST["search"]) . '%';

        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();

        $result = $stmt->get_result();
        $numDoctors = $result->num_rows;
        $showResults = true;
    }
    ?>

    <div class="container">
        <h2>Resultados da pesquisa : <?= $numDoctors ?> </h2>
        <form class="search-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="search">Pesquisar por Nome ou Especialização:</label>
            <br><input type="text" id="search" name="search" required><br>
            <button type="submit">Pesquisar</button>
        </form>

        <?php
        if ($showResults) {
        ?>
            <div class="results-container">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="result-card">
                        <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico">
                        <h3><?= $row["nome"] ?></h3>
                        <p>Especialização: <?= $row["especializacao"] ?></p>
                        <p>Telefone: <?= $row["telefone"] ?></p>
                        <a href="agendar_consulta.php?id_dentista=<?= $row['id'] ?>">Marcar Consulta</a>
                    </div>
                <?php
                }
                $stmt->close();
                ?>
            </div>
        <?php
        }
        ?>
    </div>

</body>

</html>
