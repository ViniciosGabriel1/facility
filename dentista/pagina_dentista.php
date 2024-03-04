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

    <h2><i class="fa fa-calendar"></i> Suas Consultas Agendadas</h2>

    <!-- Botões para avançar e retroceder datas -->
    <div class="date-navigation">
        <button id="retroceder-data">Retroceder</button>
        <span id="data-selecionada"></span>
        <button id="avancar-data">Avançar</button>
    </div>

    <!-- Container para as consultas do dia -->
    <div class="consultas-container">
        <div class="consultas-do-dia" id="consultas-do-dia">
            <!-- Consultas serão adicionadas aqui via Ajax -->
        </div>
    </div>

    <!-- Script jQuery para fazer a requisição Ajax -->
    <script>
        // Função para atualizar as consultas com base na data selecionada
        function atualizarConsultas(data) {
            $.ajax({
                url: '../back/buscar_agendamento.php',
                type: 'GET',
                data: {
                    data: data
                }, // Passando a data como parâmetro
                success: function(response) {
                    // Manipular os dados retornados
                    if (response.length > 0) {
                        var consultasHtml = '';
                        $.each(response, function(index, consulta) {
                            // Construir HTML para cada consulta
                            consultasHtml += '<div class="consulta">';
                            consultasHtml += '<img src="../uploads/' + consulta.foto_paciente + '" alt="Paciente sem Foto" style="height: 150px; float: left; margin-right: 10px; border-radius: 20px;">';
                            consultasHtml += '<p><strong>Paciente:</strong> ' + consulta.nome_paciente + '</p>';
                            consultasHtml += '<p class="info"><strong>Data:</strong> ' + new Date(consulta.data_consulta).toLocaleString('pt-BR') + '</p>';
                            consultasHtml += '<p><strong>Serviço:</strong> ' + consulta.servico + '</p>';
                            consultasHtml += '<p><strong>Observações:</strong> ' + consulta.observacoes + '</p>';
                           
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
                        $('#consultas-do-dia').html('<h3>Nenhuma consulta agendada para a data selecionada.</h3>');
                    }
                },
                error: function(xhr, status, error) {
                    // Tratar erros
                    console.error('Erro na requisição Ajax:', status, error);
                }
            });
        }

        // Função para retroceder a data
        // Função para retroceder a data
        $('#retroceder-data').click(function() {
            var dataSelecionada = new Date($('#data-selecionada').text());
            dataSelecionada.setDate(dataSelecionada.getDate() - 1); // Retroceder um dia
            var dataFormatada = dataSelecionada.toISOString().split('T')[0];
            console.log('Data retrocedida para:', dataFormatada);
            $('#data-selecionada').text(dataFormatada);
            atualizarConsultas(dataFormatada);
        });


        $('#avancar-data').click(function() {
            var dataAtual = new Date($('#data-selecionada').text());
            dataAtual.setDate(dataAtual.getDate() + 1); // Avançar um dia
            var dataFormatada = dataAtual.toISOString().split('T')[0];
            console.log('Data avançada para:', dataFormatada);
            $('#data-selecionada').text(dataFormatada);
            atualizarConsultas(dataFormatada);
        });



        // Chamada inicial para carregar as consultas do dia atual
        var dataAtual = new Date().toISOString().split('T')[0]; // Formatar a data atual
        $('#data-selecionada').text(dataAtual); // Exibir a data atual
        atualizarConsultas(dataAtual);

        
    </script>

</body>

</html>