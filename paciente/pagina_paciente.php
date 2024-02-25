<?php
session_start();

// Verificar se o usuário está autenticado (possui uma sessão ativa)
if (!isset($_SESSION["id_usuario"])) {
    // Redirecionar para a página de login se não estiver autenticado
    header("Location: login.php");
    exit();
}

include "../back/conexao.php";

// O ID do paciente está disponível em $_SESSION["id_paciente"]
$id_paciente = $_SESSION["id_usuario"];

// Consulta SQL para obter a lista de dentistas
$sql_dentistas = "SELECT id, nome, especializacao, telefone, foto, formacao, link_localizacao FROM medicos";
$result_dentistas = $conn->query($sql_dentistas);

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/paciente.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/verMais.js"></script>
    <title>Escolha um Dentista</title>
</head>

<body>
    <?php include "../paciente/menu.php"; ?>
    <section id="banner">
        <div class="conteiner">
            <h2 class="procura">Que Tipo de Profissional Procura?</h2>
        </div>
        <select id="filtro-especializacao" class="select-box">
            <option value="todos">Todos</option>
            <option value="Clínico Geral">Clínico Geral</option>
            <option value="Dentista">Dentista</option>
            <option value="Buco Maxilo">Buco Maxilo</option>
        </select>
    </section>
    <h2>Escolha um Dentista</h2>
    <?php
    if ($result_dentistas->num_rows > 0) {
        while ($row = $result_dentistas->fetch_assoc()) {
    ?>
            <div class="dentista-card" data-especializacao="<?= $row['especializacao'] ?>">
                <img src="../uploads/<?= $row['foto'] ?>" alt="Foto do Médico" style="height: 350px;">
                <h3>Doutor <?= $row['nome'] ?></h3>
                <p>Especialização: <?= $row['especializacao'] ?></p>

                <a href='agendar_consulta.php?id_dentista=<?= $row['id'] ?>'>Marcar Consulta</a>
                <button class="ver-mais-btn" data-id-medico="<?= $row['id'] ?>" data-foto="../uploads/<?= $row['foto'] ?>" data-nome="<?= $row['nome'] ?>" data-especializacao="<?= $row['especializacao'] ?>" data-formacao="<?= $row['formacao'] ?>" data-link-localizacao="<?= $row['link_localizacao'] ?>">Ver Mais
                </button>

                <a class="whatsapp-btn" href="https://wa.me/<?= $row['telefone'] ?>" target="_blank">Entrar em contato pelo WhatsApp
                    <img src="../img/whatsapp.png" alt="WhatsApp" style="height: 30px;">
                </a>
            </div>
    <?php
        }
    } else {
        echo "<p>Nenhum dentista cadastrado no momento.</p>";
    }
    ?>

    <script>
        function mostrarMaisDetalhes(idMedico) {
            window.location.href = 'detalhes_medico.php?id_medico=' + idMedico;
        }
    </script>

    <!-- Estrutura do modal -->
    <!-- Estrutura do modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">
                <h2><i class="fas fa-user-md"></i> Informações do Médico</h2>
            </div>
            <div class="modal-body">
                <div class="medico-info">
                    <img id="medico-foto" src="" alt="Foto do Médico">
                    <div class="medico-details">
                        <p><strong><i class="fas fa-user"></i> Nome:</strong> <span id="medico-nome">Nome do Médico</span></p>
                        <p><strong><i class="fas fa-user-graduate"></i> Especialização:</strong> <span id="medico-especializacao">Especialização</span></p>
                        <p><strong><i class="fas fa-graduation-cap"></i> Formação Acadêmica:</strong> <span id="medico-formacao">Graduação em Medicina</span></p>
                        <!-- Link para o Google Maps -->
                        <a href="#" id="medico-maps" target="_blank"><i class="fas fa-map-marker-alt"></i>
                            Ver no Google Maps <i class="fas fa-map-marker-alt"></i>
                        </a>

                        <!-- Outras informações relevantes podem ser adicionadas aqui -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Botões adicionais ou links de ação podem ser colocados aqui -->
            </div>
        </div>
    </div>

    
        <script>
        $(document).ready(function() {
            $('#filtro-especializacao').change(function() {
                var especializacaoSelecionada = $(this).val();

                $('.dentista-card').each(function() {
                    var especializacaoCard = $(this).data('especializacao');

                    if (especializacaoSelecionada === 'todos' || especializacaoSelecionada === especializacaoCard) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
        $(document).ready(function() {
            // Função para exibir os detalhes do médico ao clicar em Ver Mais
            $('.ver-mais-btn').click(function() {
                var formacao = $(this).data('formacao');
                var nome = $(this).data('nome');
                var especializacao = $(this).data('especializacao');
                var linkLocalizacao = $(this).data('link-localizacao');

                // Preencher os campos do modal com as informações do médico
                $('#medico-formacao').text(formacao);
                $('#medico-nome').text(nome);
                $('#medico-especializacao').text(especializacao);

                // Adicionar o link do Google Maps
                $('#medico-maps').attr('href', 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(linkLocalizacao));
            });
        });
    </script>

</body>

</html>