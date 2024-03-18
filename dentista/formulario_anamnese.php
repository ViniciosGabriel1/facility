<?php


session_start();

include "../back/conexao.php";
// Verifica se existe uma sessão com id_usuario
function isUserIdSet()
{
    return isset($_SESSION["id_usuario"]);
}

// Redireciona para a página de login se não houver uma sessão com id_usuario
if (!isUserIdSet()) {
    header("Location: login.php");
    exit;
}

$idPaciente = $_GET['idPaciente'];

// Query para recuperar os dados da anamnese do paciente
$sql = "SELECT * FROM anamnese WHERE id_paciente = $idPaciente";
$result = $conn->query($sql);

// Variável para armazenar os dados da anamnese do paciente
$anamneseData = [];

// Se houver resultados da consulta, armazene os dados em $anamneseData
if ($result->num_rows > 0) {
    $anamneseData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Anamnese Odontológica</title>
    <link rel="stylesheet" href="../css/anamnese.css">
</head>

<body>
    <?php include "menu_dentista.php" ?>
    <div class="container">
        <h1>Anamnese Odontológica</h1>
        <a href="exibir_anamnese.php?idPaciente=<?php echo $_GET['idPaciente']; ?>" class="button">Exibir Anamnese</a>
        <form action="../back/processa_anamnese.php" method="POST">


            <fieldset>
                <legend>Informações Pessoais</legend>
                <input type="hidden" id="paciente_id" name="paciente_id" value="<?php echo $_GET['idPaciente']; ?>">
                <script>
                    // Extrair o ID do paciente da URL
                    var urlParams = new URLSearchParams(window.location.search);
                    var pacienteId = urlParams.get('idPaciente'); // Supondo que o parâmetro na URL seja 'idPaciente'

                    // Depure o valor do pacienteId
                    console.log("ID do paciente: ", pacienteId);

                    // Inserir o ID do paciente no campo oculto
                    var pacienteIdInput = document.getElementById('paciente_id');
                    if (pacienteIdInput) {
                        pacienteIdInput.value = pacienteId;
                    } else {
                        console.error("Elemento com ID 'paciente_id' não encontrado.");
                    }
                </script>

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $anamneseData['nome'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $anamneseData['data_nascimento'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo $anamneseData['endereco'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" value="<?php echo $anamneseData['cep'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="profissao">Profissão:</label>
                    <input type="text" id="profissao" name="profissao" value="<?php echo $anamneseData['profissao'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="convenio">Convênio:</label>
                    <input type="text" id="convenio" name="convenio" value="<?php echo $anamneseData['convenio'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="telefone_residencial">Telefone Residencial:</label>
                    <input type="tel" id="telefone_residencial" name="telefone_residencial" value="<?php echo $anamneseData['telefone_residencial'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil:</label>
                    <input type="text" id="estado_civil" name="estado_civil" value="<?php echo $anamneseData['estado_civil'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="empresa_trabalha">Empresa onde trabalha:</label>
                    <input type="text" id="empresa_trabalha" name="empresa_trabalha" value="<?php echo $anamneseData['empresa_trabalha'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" value="<?php echo $anamneseData['rg'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $anamneseData['bairro'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="telefone_comercial">Telefone Comercial:</label>
                    <input type="tel" id="telefone_comercial" name="telefone_comercial" value="<?php echo $anamneseData['telefone_comercial'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="indicado_por">Indicado por:</label>
                    <input type="text" id="indicado_por" name="indicado_por" value="<?php echo $anamneseData['indicado_por'] ?? ''; ?>">
                </div>
            </fieldset>




            <fieldset>
                <legend>Histórico Médico</legend>
                <div class="form-group">
                    <label for="tratamento_medico">Está em tratamento médico?</label>
                    <label><input type="radio" name="tratamento_medico" value="sim" <?php echo ($anamneseData['tratamento_medico'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="tratamento_medico" value="não" <?php echo ($anamneseData['tratamento_medico'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="motivo_tratamento">Motivo:</label>
                    <input type="text" id="motivo_tratamento" name="motivo_tratamento" value="<?php echo $anamneseData['motivo_tratamento'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="medicamento">Está tomando algum medicamento?</label>
                    <label><input type="radio" name="medicamento" value="sim" <?php echo ($anamneseData['medicamento'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="medicamento" value="não" <?php echo ($anamneseData['medicamento'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="qual_medicamento">Qual?</label>
                    <input type="text" id="qual_medicamento" name="qual_medicamento" value="<?php echo $anamneseData['qual_medicamento'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="gravidez">Está grávida?</label>
                    <label><input type="radio" name="gravidez" value="sim" <?php echo ($anamneseData['gravidez'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="gravidez" value="não" <?php echo ($anamneseData['gravidez'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="meses_gravidez">Quantos meses?</label>
                    <input type="text" id="meses_gravidez" name="meses_gravidez" value="<?php echo $anamneseData['meses_gravidez'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="cirurgia_bucal">Já realizou cirurgia bucal?</label>
                    <label><input type="radio" name="cirurgia_bucal" value="sim" <?php echo ($anamneseData['cirurgia_bucal'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="cirurgia_bucal" value="não" <?php echo ($anamneseData['cirurgia_bucal'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="problemas_cardiacos">Já teve problemas cardíacos?</label>
                    <label><input type="radio" name="problemas_cardiacos" value="sim" <?php echo ($anamneseData['problemas_cardiacos'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="problemas_cardiacos" value="não" <?php echo ($anamneseData['problemas_cardiacos'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="hepatite">Já teve hepatite?</label>
                    <label><input type="radio" name="hepatite" value="sim" <?php echo ($anamneseData['hepatite'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="hepatite" value="não" <?php echo ($anamneseData['hepatite'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="hiv">É portador do vírus HIV?</label>
                    <label><input type="radio" name="hiv" value="sim" <?php echo ($anamneseData['hiv'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="hiv" value="não" <?php echo ($anamneseData['hiv'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="drogas">Já usou drogas?</label>
                    <label><input type="radio" name="drogas" value="sim" <?php echo ($anamneseData['drogas'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="drogas" value="não" <?php echo ($anamneseData['drogas'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="tempo_drogas">Há quanto tempo?</label>
                    <input type="text" id="tempo_drogas" name="tempo_drogas" value="<?php echo $anamneseData['tempo_drogas'] ?? ''; ?>">
                    <label for="qual_drogas">Qual?</label>
                    <input type="text" id="qual_drogas" name="qual_drogas" value="<?php echo $anamneseData['qual_drogas'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="fumante">Já fumou?</label>
                    <label><input type="radio" name="fumante" value="sim" <?php echo ($anamneseData['fumante'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="fumante" value="não" <?php echo ($anamneseData['fumante'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="pressao_arterial">Controla pressão arterial com medicamento?</label>
                    <label><input type="radio" name="pressao_arterial" value="sim" <?php echo ($anamneseData['pressao_arterial'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="pressao_arterial" value="não" <?php echo ($anamneseData['pressao_arterial'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="problemas_respiratorios">Problemas respiratórios?</label>
                    <label><input type="radio" name="problemas_respiratorios" value="sim" <?php echo ($anamneseData['problemas_respiratorios'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="problemas_respiratorios" value="não" <?php echo ($anamneseData['problemas_respiratorios'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="doencas_familia">Doenças na família?</label>
                    <label><input type="radio" name="doencas_familia" value="sim" <?php echo ($anamneseData['doencas_familia'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="doencas_familia" value="não" <?php echo ($anamneseData['doencas_familia'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="cirurgia_realizada">Já foi submetido a alguma cirurgia?</label>
                    <label><input type="radio" name="cirurgia_realizada" value="sim" <?php echo ($anamneseData['cirurgia_realizada'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="cirurgia_realizada" value="não" <?php echo ($anamneseData['cirurgia_realizada'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="qual_cirurgia">Qual?</label>
                    <input type="text" id="qual_cirurgia" name="qual_cirurgia" value="<?php echo $anamneseData['qual_cirurgia'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="dor_dentes_gengiva">Tem sentido alguma dor nos dentes ou na gengiva?</label>
                    <label><input type="radio" name="dor_dentes_gengiva" value="sim" <?php echo ($anamneseData['dor_dentes_gengiva'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="dor_dentes_gengiva" value="não" <?php echo ($anamneseData['dor_dentes_gengiva'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="gengiva_sangra">Sua gengiva sangra com facilidade?</label>
                    <label><input type="radio" name="gengiva_sangra" value="sim" <?php echo ($anamneseData['gengiva_sangra'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="gengiva_sangra" value="não" <?php echo ($anamneseData['gengiva_sangra'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="anestesia_dentario">Já tomou anestesia para tratamento dentário?</label>
                    <label><input type="radio" name="anestesia_dentario" value="sim" <?php echo ($anamneseData['anestesia_dentario'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="anestesia_dentario" value="não" <?php echo ($anamneseData['anestesia_dentario'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                    <label for="sentiu_mal_anestesia">Sentiu-se mal?</label>
                    <label><input type="radio" name="sentiu_mal_anestesia" value="sim" <?php echo ($anamneseData['sentiu_mal_anestesia'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="sentiu_mal_anestesia" value="não" <?php echo ($anamneseData['sentiu_mal_anestesia'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <div class="form-group">
                    <label for="satisfeito_dentes">Está satisfeito com a aparência de seus dentes?</label>
                    <label><input type="radio" name="satisfeito_dentes" value="sim" <?php echo ($anamneseData['satisfeito_dentes'] ?? '') == 'sim' ? 'checked' : ''; ?>>Sim</label>
                    <label><input type="radio" name="satisfeito_dentes" value="não" <?php echo ($anamneseData['satisfeito_dentes'] ?? '') == 'não' ? 'checked' : ''; ?>>Não</label>
                </div>
                <fieldset>
                    <legend>Queixa Principal</legend>
                    <div class="form-group">
                        <label for="queixa_principal">Qual a queixa principal sobre seus dentes?</label>
                        <textarea id="queixa_principal" name="queixa_principal" rows="4"><?php echo $anamneseData['queixa_principal'] ?? ''; ?></textarea>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Observações</legend>
                    <div class="form-group">
                        <label for="observacoes">Observações:</label>
                        <textarea id="observacoes" name="observacoes" rows="4"><?php echo $anamneseData['observacoes'] ?? ''; ?></textarea>
                    </div>
                </fieldset>


                <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        // Validar o formulário de anamnese
        document.getElementById('anamneseForm').addEventListener('submit', function(event) {
            var form = event.target;

            // Validar cada campo do formulário
            if (!form.checkValidity()) {
                // Se o formulário não for válido, impedir o envio e exibir mensagem de erro
                event.preventDefault();
                event.stopPropagation();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor, preencha todos os campos corretamente.',
                });
            }
        }, false);
    </script>
</body>

</html>