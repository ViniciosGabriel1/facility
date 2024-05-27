<?php

include "conexao.php";
session_start();

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id_usuario"])) {
        // Limpeza e validação dos dados do formulário
        $id_consulta = $_POST["id_consulta"];
        $id_medico = $_POST["id_medico"];
        $id_paciente = $_SESSION["id_usuario"];
        $data_consulta = $_POST["data"]; 
        $servico = $_POST["servico"];
        $observacoes = $_POST["observacoes"];
        
        // Formate a data e hora para o formato desejado (se necessário)

        // Definindo o status como "Reagendada"
        $status = "Reagendada";

        // Preparar e executar o update do agendamento
        $atualizar_agendamento = "UPDATE consultas SET data_consulta = ?, servico = ?, observacoes = ?, status = ? WHERE id = ? AND id_paciente = ? AND id_medico = ?";
        $stmt_agendamento = $conn->prepare($atualizar_agendamento);
        $stmt_agendamento->bind_param("ssssiii", $data_consulta, $servico, $observacoes, $status, $id_consulta, $id_paciente, $id_medico);

        if ($stmt_agendamento->execute()) {
            echo "Consulta Reagendada com sucesso!";
            header("refresh: 3;url=../paciente/historico_consulta.php?success_scheduling=1");
            exit();
        } else {
            echo "Erro ao reagendar consulta. Tente novamente.";
        }

        // Fechar a consulta preparada
        $stmt_agendamento->close();
    } else {
        echo "Usuário não autenticado. Faça o login antes de agendar uma consulta.";
        header("Location: ../index.php");

        // Redirecionar para a página de login ou realizar outras ações necessárias
    }
} else {
    echo "Método inválido de requisição.";
}

// Fechar a conexão com o banco de dados
$conn->close();

?>
