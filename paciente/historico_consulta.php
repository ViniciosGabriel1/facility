<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/historico_consultas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />

    <title>Histórico de Consultas</title>

    <style>
        /* Estilos para a classe do botão */
        .botao-voltar {
            margin-top: 12px;
            margin-left: 30px;
            padding: 10px 20px;
            background-color: hsl(199deg 86% 78%);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .botao-voltar:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>

<body>

    <?php include "menu_paciente.php"; ?>
    <button class="botao-voltar" onclick="goBack()"><i class="fas fa-arrow-left"></i> Voltar</button>


    <?php
    session_start();
    include "../back/conexao.php";

        if(isset($_GET['error_avaliation']) && $_GET['error_avaliation'] == 1){
            echo "<p id='duplicate' style=' width: 100%;
        position: fixed;
        text-align: center;
        /* align-items: center; */
        padding: 10px;
        color: white;
        background: yellow;
        border-radius: 12px;'>Você já avaliou esta consulta .</p>";
        }elseif(isset($_GET['success_cancel']) && $_GET['success_cancel'] == 1 ){
            echo "<p id='duplicate' style=' width: 100%;
        position: fixed;
        text-align: center;
        /* align-items: center; */
        padding: 10px;
        color: white;
        background: green;
        border-radius: 12px;'>Consulta Cancelada com sucesso .</p>";
        }
        elseif(isset($_GET['success_scheduling']) && $_GET['success_scheduling'] == 1){
            echo "<p id='duplicate' style=' width: 100%;
        position: fixed;
        text-align: center;
        /* align-items: center; */
        padding: 10px;
        color: white;
        background: orange;
        border-radius: 12px;'>Consulta Reagendada com sucesso .</p>";
        }
    // Verificar se houve um erro ao avaliar o médico
    // if (isset($_GET['error']) && $_GET['error'] == 1) {
    //     echo "<p id='duplicate' style=' width: 100%;
    //     position: fixed;
    //     text-align: center;
    //     /* align-items: center; */
    //     padding: 10px;
    //     color: #000000;
    //     background: yellow;
    //     border-radius: 12px;'>Você já avaliou esta consulta .</p>";
    // }


    // Verificar se o paciente está autenticado
    if (!isset($_SESSION["id_usuario"])) {
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: index.php");
        exit();
    }

    // Obter o ID do paciente
    $id_paciente = $_SESSION["id_usuario"];

    // Consulta SQL para obter o histórico de consultas do paciente
    $sql = "SELECT id, data_consulta, id_medico, servico, observacoes, status FROM consultas WHERE id_paciente = ? ORDER BY data_consulta DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $stmt->bind_result($id_consulta, $data_consulta, $id_medico, $servico, $observacoes, $status);

    // Armazenar o resultado da consulta principal
    $stmt->store_result();

    // Variáveis para controlar se já foram exibidas as consultas pendentes e concluídas
    $consultas_pendentes_exibidas = false;
    $consultas_concluidas_exibidas = false;

    // Verificar se há consultas no histórico
    if ($stmt->num_rows > 0) {
        // Exibir consultas no histórico
        while ($stmt->fetch()) {
            // Consulta para obter o nome do médico
            $sql_medico = "SELECT nome, telefone FROM medicos WHERE id = ?";
            $stmt_medico = $conn->prepare($sql_medico);
            $stmt_medico->bind_param("i", $id_medico);
            $stmt_medico->execute();
            $stmt_medico->bind_result($nome_medico, $telefone_medico);

            // Verificar se encontrou o médico
            if ($stmt_medico->fetch()) {
                // Exibir as consultas pendentes
                if ($status == 'Agendada' || $status == 'Reagendada') {
                    if (!$consultas_pendentes_exibidas) {
                        echo "<h3 class='consultas-pendentes'>Consultas Pendentes</h3>";
                        $consultas_pendentes_exibidas = true;
                    }
                    includeConsultCard($id_consulta, $data_consulta, $id_medico, $nome_medico, $servico, $observacoes, $status, $telefone_medico);
                } elseif ($status == 'Concluída') {
                    if (!$consultas_concluidas_exibidas) {
                        echo "<h3 class='consultas-concluidas'>Consultas Concluídas</h3>";
                        $consultas_concluidas_exibidas = true;
                    }
                    includeConsultCard($id_consulta, $data_consulta, $id_medico, $nome_medico, $servico, $observacoes, $status, $telefone_medico);
                }
            } else {
                echo "<p>Nome do médico não encontrado.</p>";
            }
            // Fechar a consulta do médico
            $stmt_medico->close();
        }
    } else {
        echo "<p>Nenhuma consulta no histórico.</p>";
    }

    // Liberar a memória associada ao resultado da consulta principal
    $stmt->free_result();

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();

    // Função para incluir o card de consulta
    function includeConsultCard($id_consulta, $data_consulta, $id_medico, $nome_medico, $servico, $observacoes, $status, $telefone_medico)
    {
    ?>
        <div class="consulta-card">
            <p class="consulta-info">
                <strong><i class="fa fa-calendar fa-fw"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-user-md fa-fw"></i> Médico:</strong> <?php echo $nome_medico; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-stethoscope fa-fw"></i> Serviço:</strong> <?php echo $servico; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-commenting fa-fw"></i> Observações:<br></strong> <?php echo $observacoes; ?>
            </p>
            <p class="consulta-info">
                <strong><i class="fa fa-info-circle fa-fw"></i> Status:</strong>
                <span class="<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
            </p>
            <?php if ($status == 'Concluída') { ?>
                <button class="btn-avaliar" onclick="openModal(<?php echo $id_consulta; ?>, <?php echo $id_medico; ?>, '<?php echo $nome_medico; ?>')"><i class="fa fa-star fa-fw" style="color: orange;"></i> Avaliar</button>
            <?php } ?>

            <div class="consulta-botoes">
                <?php if ($status == 'Agendada' || $status == 'Reagendada') {
                    $id_paciente = $_SESSION["id_usuario"]; ?>
                    <div class="whats">
                        <p class="consulta-info">
                            <a target="_blank" style="color: green;" href="https://api.whatsapp.com/send?phone=<?php echo $telefone_medico; ?>">
                                <i class="fa fa-whatsapp fa-fw" style="color: green;"></i> Enviar mensagem pelo WhatsApp
                            </a>
                        </p>
                    </div>
                    <br>
                    <?php   ?>
                    <a href="cancelar_consulta.php?id_consulta=<?php echo $id_consulta; ?>&id_paciente=<?php echo $id_paciente; ?>&id_medico=<?php echo $id_medico; ?>" class="btn-cancelar"><i class="fa fa-times-circle fa-fw" style="color: red;"></i> Cancelar</a>
                    <a href="reagendar_paciente.php?id_consulta=<?php echo $id_consulta; ?>&id_paciente=<?php echo $id_paciente; ?>&id_medico=<?php echo $id_medico; ?>a" class="btn-reagendar"><i class="fa fa-calendar-plus-o fa-fw" style="color: blue;"></i> Reagendar</a>


                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Modal para avaliação -->
    <div id="avaliacaoModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <form action="../back/processa_avaliacao.php" method="post">
                <!-- Input hidden para o ID da consulta -->
                <input type="hidden" id="id_consulta" name="id_consulta" value="">
                <!-- Input hidden para o ID do médico -->
                <input type="hidden" id="id_medico" name="id_medico" value="">

                <!-- Seleção de estrelas -->
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" required /><label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" required /><label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" required /><label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" required /><label for="star1"><i class="fas fa-star"></i></label>
                </div>

                <!-- Comentário -->
                <textarea required name="comment" id="comment" cols="30" rows="10" placeholder="Digite seu comentário..."></textarea>

                <!-- Botão de enviar avaliação -->
                <button class="btn-modal" type="submit">Enviar Avaliação</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(idConsulta, idMedico, nomeMedico) {
            var modal = document.getElementById("avaliacaoModal");
            modal.style.display = "block";
            // Atribuir dinamicamente o valor do id_consulta ao input hidden
            document.getElementById("id_consulta").value = idConsulta;
            // Atribuir dinamicamente o valor do id_medico ao input hidden
            document.getElementById("id_medico").value = idMedico;
            // Definir dinamicamente o título do modal
            document.getElementById("modalTitle").innerText = "Avaliar Consulta do Médico " + nomeMedico;
        }

        function closeModal() {
            var modal = document.getElementById("avaliacaoModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("avaliacaoModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        // Esperar 3 segundos e, em seguida, ocultar suavemente a mensagem de logout
        setTimeout(function() {
            var logoutMessage = document.getElementById('duplicate');
            if (logoutMessage) {
                logoutMessage.classList.add('fade-out'); // Adiciona a classe para iniciar a animação

                // Após a animação, remove a mensagem
                setTimeout(function() {
                    logoutMessage.style.display = 'none';
                }, 1000); // Ajuste o tempo para corresponder à duração da animação CSS
            }
        }, 3000); // 3000 milissegundos = 3 segundos
    </script>
</body>

</html>