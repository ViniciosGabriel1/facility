<?php
include "conexao.php";
session_start();

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id_usuario"])) {
        // Limpeza e validação dos dados do formulário
        $id_paciente = $_SESSION["id_usuario"];
        $id_medico = $_POST["id_medico"];
        $data_consulta = $_POST["data"];
        $servico = $_POST["servico"];
        $observacoes = $_POST["observacoes"];
        

        // Formate a data e hora para o formato desejado (se necessário)

        // Preparar e executar a inserção do agendamento
        $inserir_agendamento = "INSERT INTO consultas (id_paciente, id_medico, data_consulta, servico, observacoes, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_agendamento = $conn->prepare($inserir_agendamento);
        $status = 'Agendada'; // Defina o status inicial
        $stmt_agendamento->bind_param("iissss", $id_paciente, $id_medico, $data_consulta, $servico, $observacoes, $status);

        if ($stmt_agendamento->execute()) {
            echo "Consulta agendada com sucesso!";
            header("refresh: 3;url=../paciente/pagina_paciente.php");
            exit();
        } else {
            echo "Erro ao agendar consulta. Tente novamente.";
        }

        // Fechar a consulta preparada
        $stmt_agendamento->close();
    } else {
        echo "Usuário não autenticado. Faça o login antes de agendar uma consulta.";
        // Redirecionar para a página de login ou realizar outras ações necessárias
    }
} else {
    echo "Método inválido de requisição.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
