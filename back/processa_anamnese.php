<?php
// Incluindo o arquivo de conexão
include 'conexao.php';

$id_paciente = $_POST['paciente_id'];
$sql_verificar_anamnese = "SELECT email FROM pacientes WHERE id = '$id_paciente'";
$resultado_verificar_anamnese = $conn->query($sql_verificar_anamnese);

// Verifica se o resultado foi encontrado
if ($resultado_verificar_anamnese) {
    // Verifica se encontrou algum registro
    if ($resultado_verificar_anamnese->num_rows > 0) {
        // Recupera os dados da consulta
        $row = $resultado_verificar_anamnese->fetch_assoc();
        
        // Email do paciente
        $email = $row['email'];
        
        // Faça algo com o email do paciente
    } else {
        // Nenhum registro encontrado para o ID do paciente fornecido
    }
} else {
    // Se houver um erro na consulta SQL
    echo "Erro ao executar a consulta: " . $conn->error;
}


// Processar os dados do formulário

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$profissao = $_POST['profissao'];
$convenio = $_POST['convenio'];
$telefone_residencial = $_POST['telefone_residencial'];
$estado_civil = $_POST['estado_civil'];
$empresa_trabalha = $_POST['empresa_trabalha'];
$email ;
$rg = $_POST['rg'];
$bairro = $_POST['bairro'];
$telefone_comercial = $_POST['telefone_comercial'];
$indicado_por = $_POST['indicado_por'];

// Campos da anamnese
$tratamento_medico = $_POST['tratamento_medico'];
$motivo_tratamento = $_POST['motivo_tratamento'];
$medicamento = $_POST['medicamento'];
$qual_medicamento = $_POST['qual_medicamento'];
$gravidez = $_POST['gravidez'];
$meses_gravidez = $_POST['meses_gravidez'];
$cirurgia_bucal = $_POST['cirurgia_bucal'];
$problemas_cardiacos = $_POST['problemas_cardiacos'];
$hepatite = $_POST['hepatite'];
$hiv = $_POST['hiv'];
$drogas = $_POST['drogas'];
$tempo_drogas = $_POST['tempo_drogas'];
$qual_drogas = $_POST['qual_drogas'];
$fumante = $_POST['fumante'];
$pressao_arterial = $_POST['pressao_arterial'];
$problemas_respiratorios = $_POST['problemas_respiratorios'];
$doencas_familia = $_POST['doencas_familia'];
$cirurgia_realizada = $_POST['cirurgia_realizada'];
$qual_cirurgia = $_POST['qual_cirurgia'];
$dor_dentes_gengiva = $_POST['dor_dentes_gengiva'];
$gengiva_sangra = $_POST['gengiva_sangra'];
$anestesia_dentario = $_POST['anestesia_dentario'];
$sentiu_mal_anestesia = $_POST['sentiu_mal_anestesia'];
$satisfeito_dentes = $_POST['satisfeito_dentes'];
$queixa_principal = $_POST['queixa_principal'];
$observacoes = $_POST['observacoes'];

// Verificar se o paciente já possui uma anamnese
$sql_verificar_anamnese = "SELECT id FROM anamnese WHERE id_paciente = '$id_paciente'";
$resultado_verificar_anamnese = $conn->query($sql_verificar_anamnese);

if ($resultado_verificar_anamnese->num_rows > 0) {
    // Paciente já possui uma anamnese, realizar UPDATE
    $sql_anamnese = "UPDATE anamnese SET nome='$nome', data_nascimento='$data_nascimento', endereco='$endereco', cep='$cep', profissao='$profissao', convenio='$convenio', telefone_residencial='$telefone_residencial', estado_civil='$estado_civil', empresa_trabalha='$empresa_trabalha', email='$email', rg='$rg', bairro='$bairro', telefone_comercial='$telefone_comercial', indicado_por='$indicado_por', tratamento_medico='$tratamento_medico', motivo_tratamento='$motivo_tratamento', medicamento='$medicamento', qual_medicamento='$qual_medicamento', gravidez='$gravidez', meses_gravidez='$meses_gravidez', cirurgia_bucal='$cirurgia_bucal', problemas_cardiacos='$problemas_cardiacos', hepatite='$hepatite', hiv='$hiv', drogas='$drogas', tempo_drogas='$tempo_drogas', qual_drogas='$qual_drogas', fumante='$fumante', pressao_arterial='$pressao_arterial', problemas_respiratorios='$problemas_respiratorios', doencas_familia='$doencas_familia', cirurgia_realizada='$cirurgia_realizada', qual_cirurgia='$qual_cirurgia', dor_dentes_gengiva='$dor_dentes_gengiva', gengiva_sangra='$gengiva_sangra', anestesia_dentario='$anestesia_dentario', sentiu_mal_anestesia='$sentiu_mal_anestesia', satisfeito_dentes='$satisfeito_dentes', queixa_principal='$queixa_principal', observacoes='$observacoes' WHERE id_paciente='$id_paciente'";
} else {
    // Paciente não possui uma anamnese, realizar INSERT
    $sql_anamnese = "INSERT INTO anamnese (id_paciente, nome, data_nascimento, endereco, cep, profissao, convenio, telefone_residencial, estado_civil, empresa_trabalha, email, rg, bairro, telefone_comercial, indicado_por, tratamento_medico, motivo_tratamento, medicamento, qual_medicamento, gravidez, meses_gravidez, cirurgia_bucal, problemas_cardiacos, hepatite, hiv, drogas, tempo_drogas, qual_drogas, fumante, pressao_arterial, problemas_respiratorios, doencas_familia, cirurgia_realizada, qual_cirurgia, dor_dentes_gengiva, gengiva_sangra, anestesia_dentario, sentiu_mal_anestesia, satisfeito_dentes, queixa_principal, observacoes) 
                    VALUES ('$id_paciente', '$nome', '$data_nascimento', '$endereco', '$cep', '$profissao', '$convenio', '$telefone_residencial', '$estado_civil', '$empresa_trabalha', '$email', '$rg', '$bairro', '$telefone_comercial', '$indicado_por', '$tratamento_medico', '$motivo_tratamento', '$medicamento', '$qual_medicamento', '$gravidez', '$meses_gravidez', '$cirurgia_bucal', '$problemas_cardiacos', '$hepatite', '$hiv', '$drogas', '$tempo_drogas', '$qual_drogas', '$fumante', '$pressao_arterial', '$problemas_respiratorios', '$doencas_familia', '$cirurgia_realizada', '$qual_cirurgia', '$dor_dentes_gengiva', '$gengiva_sangra', '$anestesia_dentario', '$sentiu_mal_anestesia', '$satisfeito_dentes', '$queixa_principal', '$observacoes')";
}

// Executar a consulta
if ($conn->query($sql_anamnese) === TRUE) {
    echo "Anamnese atualizada ou inserida com sucesso.";
} else {
    echo "Erro ao atualizar ou inserir a anamnese: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
