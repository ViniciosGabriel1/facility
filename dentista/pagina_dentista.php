<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/medico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Página do Médico</title>
</head>

<body>
    <?php include "menu_dentista.php"; ?>

    <h2><i class="fa fa-calendar"></i> Suas Consultas Agendadas</h2>

    <!-- Botões para avançar e retroceder datas -->
    <div class="date-navigation">
        <button id="retroceder-data"><i class="fas fa-chevron-left"></i></button>
        <span id="data-selecionada"></span>
        <button id="avancar-data"><i class="fas fa-chevron-right"></i></button>
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
                        consultasHtml += '<h3 class="consultas-pendentes"><i class="fas fa-exclamation-circle"></i> Consultas Pendentes</h3>';
                        $.each(response, function(index, consulta) {
                            // Construir HTML para cada consulta

                            // Laço para iterar sobre as consultas pendentes

                            consultasHtml += '<div class="consulta">';
                            consultasHtml += '<div class="consulta-info">';
                            consultasHtml += '<p class="consulta-id"><strong><i class="fas fa-user"></i> ID Paciente:</strong> ' + consulta.id_paciente + '</p>';

                            consultasHtml += '<p class="consulta-id"><strong><i class="fas fa-user"></i> ID:</strong> ' + consulta.id + '</p>';
                            consultasHtml += '<img src="../uploads/' + consulta.foto_paciente + '" alt="Paciente sem Foto" style="height: 150px; float: left; margin-right: 10px; border-radius: 20px;">';
                            consultasHtml += '<br><br><p><strong>Paciente:</strong>  ' + consulta.nome_paciente + '</p>';
                            consultasHtml += '<p class="info"><strong> <i class="far fa-calendar-alt"></i> Data:</strong> ' + new Date(consulta.data_consulta).toLocaleString('pt-BR') + '</p>';
                            consultasHtml += '<p><strong><i class="fas fa-wrench"></i> Serviço:</strong> ' + consulta.servico + '</p>';
                            consultasHtml += '<p><strong> <i class="fas fa-sticky-note"></i> Observações:</strong>' + consulta.observacoes + '</p>';
                            // Exemplo de adição de classe com base no status
                            // Incluir as classes CSS correspondentes a cada status
                            var statusClass = '';
                            var statusIcon = ''; // Adicione aqui a classe do ícone Font Awesome correspondente
                            switch (consulta.status) {
                                case 'Concluída':
                                    statusClass = 'concluida';
                                    statusIcon = 'fas fa-check-circle'; // Ícone de check para "Concluída"
                                    break;
                                case 'Reagendada':
                                    statusClass = 'reagendada';
                                    statusIcon = 'fas fa-calendar-alt'; // Ícone de calendário para "Reagendada"
                                    break;
                                case 'Cancelada':
                                    statusClass = 'cancelada';
                                    statusIcon = 'fas fa-times-circle'; // Ícone de "X" para "Cancelada"
                                    break;
                                case 'Agendada':
                                    statusClass = 'agendada';
                                    statusIcon = 'fas fa-clock'; // Ícone de relógio para "Agendada"
                                    break;
                                default:
                                    statusClass = ''; // Se não houver correspondência, deixe vazio para usar a cor padrão
                                    statusIcon = 'fas fa-info-circle'; // Ícone de informação padrão
                            }

                            // Construir o HTML da div de status com a classe CSS e o ícone correspondentes
                            consultasHtml += '<h5 class="consulta-status ' + statusClass + '"><p>Status:</p>' + consulta.status + ' <i class="' + statusIcon + '"></i></h5><br>';

                            // Ícone para o WhatsApp
                            consultasHtml += '<p class="consulta-info"><strong></strong> <a href="https://api.whatsapp.com/send?phone=' + consulta.telefone_paciente + '" target="_blank" style="color: green;">Enviar mensagem pelo WhatsApp <i class="fab fa-whatsapp"></i></a></p>';

                            consultasHtml += '</div>'; // fechamento da div "consulta-info"
                            consultasHtml += '<div class="botoes-container">';
                            consultasHtml += '<input type="hidden" name="id_consulta" value="' + consulta.id + '">';
                            consultasHtml += '<button type="button" class="reagendar-btn" onclick="redirecionarParaReagendar(' + consulta.id + ', ' + consulta.id_paciente + ')">Reagendar <i class="fas fa-calendar-alt"></i> </button>';
                            consultasHtml += '<button type="submit" class="concluir-btn" onclick="redirecionarParaConclusao(' + consulta.id + ', ' + consulta.id_paciente + ')">Concluir <i class="fas fa-check"></i></button>';
                            consultasHtml += '<button type="button" class="historico-btn" onclick="redirecionarParaHistorico(' + consulta.id_paciente + ')">Histórico <i class="fas fa-calendar-alt"></i></button>';

                            consultasHtml += '</div>'; // fechamento da div "botoes-container"
                            consultasHtml += '</div>'; // fechamento da div "consulta"


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




        function redirecionarParaReagendar(idConsulta, idPaciente) {
            // Redirecionar o navegador para a página reagendar.php, passando o ID da consulta como parâmetro
            window.location.href = '../dentista/reagendar_dentista.php?idConsulta=' + idConsulta + '&idPaciente=' + idPaciente;
        }

        function redirecionarParaHistorico(idPaciente) {
            // Redirecionar o navegador para a página reagendar.php, passando o ID da consulta como parâmetro
            window.location.href = '../dentista/historico_dentista.php?idPaciente=' + idPaciente;
        }

        function redirecionarParaConclusao(idConsulta, idPaciente) {
            // Redirecionar o navegador para a página de conclusão de consulta, passando o ID da consulta e o ID do paciente como parâmetros
            window.location.href = '../dentista/pagina_conclusao.php?idConsulta=' + idConsulta + '&idPaciente=' + idPaciente;
        }
    </script>


</body>

</html>