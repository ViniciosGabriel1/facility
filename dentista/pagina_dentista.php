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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/medico.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Página do Médico</title>

</head>

<body>

   <?php include "menu_dentista.php"; ?> 
    
  
   <h2>Suas Consultas Agendadas</h2>

<div class="consultas-container">
    <div class="consultas-do-dia" id="consultas-do-dia">
        <!-- Consultas serão adicionadas aqui via Ajax -->
    </div>
</div>

<!-- Script jQuery para fazer a requisição Ajax -->
<!-- Adicione isso ao final do seu arquivo HTML -->
<script>
    function atualizarConsultas() {
        $.ajax({
            url: '../back/buscar_agendamento.php',
            type: 'GET',
            success: function(response) {
                // Manipular os dados retornados
                if (response.length > 0) {
                    var consultasHtml = '';
                    $.each(response, function(index, consulta) {
                        // Construir HTML para cada consulta
                        consultasHtml += '<div class="consulta">';
                        consultasHtml += '<img src="../uploads/' + consulta.foto_paciente + '" alt="Foto do Paciente" style="height: 150px; float: left; margin-right: 10px; border-radius: 20px;">';
                        consultasHtml += '<p>Data: ' + consulta.data_consulta + '</p>';
                        consultasHtml += '<p>Serviço: ' + consulta.servico + '</p>';
                        consultasHtml += '<p>Observações: ' + consulta.observacoes + '</p>';
                        consultasHtml += '<p>Paciente: ' + consulta.nome_paciente + '</p>';
                        consultasHtml += '<div class="botoes-container">';
                        consultasHtml += '<button class="concluir-btn">Concluir</button>';
                        consultasHtml += '<button class="cancelar-btn">Cancelar</button>';
                        consultasHtml += '</div>';
                        consultasHtml += '</div>';
                    });
                    // Adicionar as consultas ao elemento HTML
                    $('#consultas-do-dia').html(consultasHtml);
                } else {
                    // Caso não haja consultas
                    $('#consultas-do-dia').html('<p>Nenhuma consulta agendada para hoje.</p>');
                }
            },
            error: function(xhr, status, error) {
                // Tratar erros
                console.error('Erro na requisição Ajax:', status, error);
            }
        });
    }

    // Atualizar a cada 5 segundos (5000 milissegundos)
    setInterval(atualizarConsultas, 5000);
</script>

</body>
</html>