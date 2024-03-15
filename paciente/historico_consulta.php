<?php
session_start();

// Verificar se o paciente está autenticado
if (!isset($_SESSION["id_usuario"])) {
    // Redirecionar para a página de login se não estiver autenticado
    header("Location: login.php");
    exit();
}

include "../back/conexao.php";
 include "menu_paciente.php"; ?>

    <div class="navigation-buttons">
        <a href="pagina_paciente.php" class="back-button">Voltar para a Tela Anterior</a>
    </div>

<?php
// Verificar se houve um erro ao avaliar o médico
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<p id='duplicate' style=' width: 100%;
    position: fixed;
    text-align: center; 
    /* align-items: center; */
    padding: 10px;
    color: #000000;
    background: yellow;
    border-radius: 12px;'>Você já avaliou esta consulta .</p>";
}

// Obter o ID do paciente
$id_paciente = $_SESSION["id_usuario"];

// Consulta SQL para obter todas as consultas do paciente com o nome e número do médico
$sql_consultas = "SELECT c.id, c.data_consulta, m.nome, m.telefone, c.servico, c.observacoes, c.status FROM consultas c
INNER JOIN medicos m ON c.id_medico = m.id
WHERE c.id_paciente = ?
ORDER BY c.data_consulta DESC";

$stmt_consultas = $conn->prepare($sql_consultas);
$stmt_consultas->bind_param("i", $id_paciente);
$stmt_consultas->execute();
$stmt_consultas->bind_result($id_consulta, $data_consulta, $nome_medico, $numero_medico, $servico, $observacoes, $status);

// Variáveis para controlar se pelo menos uma consulta pendente ou concluída foi encontrada
$consulta_pendente_encontrada = false;
$consulta_concluida_encontrada = false;

// Exibir consultas
while ($stmt_consultas->fetch()) {
    if ($status === 'Agendada' || $status === 'Reagendada') {
        // Consulta pendente
        if (!$consulta_pendente_encontrada) {
            echo "<h3 class='consultas-pendentes'>Consultas Pendentes</h3>";
            $consulta_pendente_encontrada = true;
        }
    } else {
        // Consulta concluída
        if (!$consulta_concluida_encontrada) {
            echo "<h3 class='consultas-concluidas'>Consultas Concluídas</h3>";
            $consulta_concluida_encontrada = true;
        }
    }
?>
    <div class="consulta-card">
        <p class="consulta-info">
            <strong><i class="fa fa-calendar fa-fw"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?>
        </p>
        <p class="consulta-info">
            <strong><i class="fa fa-user-md fa-fw"></i> Médico:</strong> <?php echo "$nome_medico"; ?>
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
    </div>
<?php
}

// Se nenhuma consulta pendente ou concluída foi encontrada, exibir mensagem
if (!$consulta_pendente_encontrada) {
    echo "<p>Nenhuma consulta pendente no histórico.</p>";
}

if (!$consulta_concluida_encontrada) {
    echo "<p>Nenhuma consulta concluída no histórico.</p>";
}

// Fechar a consulta
$stmt_consultas->close();

// Fechar a conexão com o banco de dados
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/historico_consultas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
    <title>Histórico de Consultas</title>
</head>

<body>



    <?php if (!empty($consultas_pendentes)) : ?>
        <h3 class='consultas-pendentes'>Consultas Pendentes</h3>
        <?php foreach ($consultas_pendentes as list($id_consulta, $data_consulta, $id_medico, $servico, $observacoes, $status)) : ?>
            <div class="consulta-card">
                <p class="consulta-info">
                    <strong><i class="fa fa-calendar fa-fw"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?>
                </p>
                <p class="consulta-info">
                    <strong><i class="fa fa-user-md fa-fw"></i> Médico:</strong> Médico ID: <?php echo $id_medico; ?>
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
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <!-- <p>Nenhuma consulta pendente no histórico.</p> -->
    <?php endif; ?>

    <?php if (!empty($consultas_concluidas)) : ?>
        <h3 class='consultas-concluidas'>Consultas Concluídas</h3>
        <?php foreach ($consultas_concluidas as list($id_consulta, $data_consulta, $id_medico, $servico, $observacoes, $status)) : ?>
            <div class="consulta-card">
                <p class="consulta-info">
                    <strong><i class="fa fa-calendar fa-fw"></i> Data da Consulta:</strong> <?php echo date('d/m/Y H:i', strtotime($data_consulta)); ?>
                </p>
                <p class="consulta-info">
                    <strong><i class="fa fa-user-md fa-fw"></i> Médico:</strong> Médico ID: <?php echo $id_medico; ?>
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
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <!-- <p>Nenhuma consulta concluída no histórico.</p> -->
    <?php endif; ?>

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
        setTimeout(function(){
            var logoutMessage = document.getElementById('duplicate');
            if(logoutMessage) {
                logoutMessage.classList.add('fade-out'); // Adiciona a classe para iniciar a animação

                // Após a animação, remove a mensagem
                setTimeout(function(){
                    logoutMessage.style.display = 'none';
                }, 1000); // Ajuste o tempo para corresponder à duração da animação CSS
            }
        }, 3000); // 3000 milissegundos = 3 segundos
    </script>
</body>

</html>
