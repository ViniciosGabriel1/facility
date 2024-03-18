<?php
// Incluir o autoload do Composer para carregar o Dompdf
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

// Incluir o arquivo de conexão com o banco de dados
include '../back/conexao.php';

// Definir uma variável para armazenar os dados da anamnese em HTML
$anamneseHTML = '';

// Verificar se o ID do paciente está presente na URL
if (isset($_GET['idPaciente'])) {
    // Recuperar o ID do paciente da URL
    $idPaciente = $_GET['idPaciente'];

    // Consulta SQL para recuperar os dados da anamnese do paciente
    $sql = "SELECT * FROM anamnese WHERE id_paciente = $idPaciente";

    // Executar a consulta
    $result = $conn->query($sql);

    // Exibir os dados recuperados em HTML
    if ($result->num_rows > 0) {
        $anamneseHTML .= '<h1 style="text-align: center; margin-bottom: 20px;">Dados da Anamnese</h1>';
        $anamneseHTML .= '<div class="container">';
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $anamneseHTML .= '<div class="field">';
                $anamneseHTML .= '<span style="font-weight: bold; color: #333;">' . ucfirst(str_replace("_", " ", $key)) . ':</span>';
                $anamneseHTML .= '<span style="margin-left: 10px; color: #666;">' . $value . '</span>';
                $anamneseHTML .= '</div>';
            }
        }
        $anamneseHTML .= '</div>';
    } else {
        $anamneseHTML .= '<p style="text-align: center; color: #ff0000;">Nenhum resultado encontrado.</p>';
    }
}

// Verificar se foi solicitado o download do PDF
if (isset($_POST['generate_pdf']) && $_POST['generate_pdf'] === 'true') {
    // Criar uma instância do Dompdf
    $dompdf = new Dompdf();

    // Renderizar HTML para PDF
    $dompdf->loadHtml($anamneseHTML);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Nome do arquivo PDF
    $filename = 'dados_anamnese.pdf';

    // Salvar o PDF
    $dompdf->stream($filename);
    exit; // Encerrar o script após o envio do PDF
}
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .field {
            margin-bottom: 10px;
        }

        .field span {
            display: block;
        }

        .field span:first-child {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Exibir os dados da anamnese -->
        <?php echo $anamneseHTML; ?>
        <!-- Botão para baixar o PDF -->
        <div style="text-align: center; margin-top: 20px;">
            <form action="exibir_anamnese.php?idPaciente=<?php echo $idPaciente; ?>" method="post">
                <input type="hidden" name="generate_pdf" value="true">
                <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Baixar PDF</button>
            </form>
        </div>
    </div>
</body>

</html>
