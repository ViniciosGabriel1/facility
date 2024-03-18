<?php
// Inclua o arquivo de conexão com o banco de dados
include '../back/conexao.php';

// Função para substituir "nao" por "não"
function corrigirValor($valor)
{
    return ($valor == 'nao') ? 'não' : $valor;
}

// Verifique se o ID do paciente está presente na URL
if (isset($_GET['idPaciente'])) {
    // Recupere o ID do paciente da URL
    $idPaciente = $_GET['idPaciente'];

    // Consulta SQL para recuperar os dados da anamnese do paciente
    $sql = "SELECT * FROM anamnese WHERE id_paciente = $idPaciente";

    // Execute a consulta
    $result = $conn->query($sql);

    // Verifique se há resultados
    if ($result->num_rows > 0) {
        // Exiba os dados da anamnese
?>
 <!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Anamnese</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .field {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    align-items: baseline;
    flex-wrap: wrap;
    justify-content: space-between;
}

        .field label {
            font-weight: bold;
            color: #555;
            display: block;
        }

        .field span {
            margin-left: 30px;
            color: #777;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Dados da Anamnese</h2>
        <?php
        // Exibir os dados recuperados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    ?>
                    <div class="field">
                        <label><?php echo ucfirst(str_replace("_", " ", $key)); ?>:</label>
                        <span><?php echo $value; ?></span>
                    </div>
        <?php
                }
            }}
        } else {
            echo "Nenhum resultado encontrado.";
        }}
        ?>
    </div>
</body>

</html>
