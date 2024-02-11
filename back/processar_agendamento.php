<?php
include "conexao.php";
session_start(); // Inicie a sessão

date_default_timezone_set('America/Sao_Paulo'); // Substitua pelo seu fuso horário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o usuário está autenticado
    if (isset($_SESSION["id_usuario"])) {
        // Obter dados do formulário
    $id_paciente = $_SESSION["id_usuario"];
        $id_medico = $_POST["id_medico"];
        $data_consulta = $_POST["data"];
        $servico = $_POST["servico"];
        $observacoes = $_POST["observacoes"];

        // Formatar a data e hora para o formato desejado


        // Inserir agendamento no banco de dados
        $inserir_agendamento = "INSERT INTO consultas (id_paciente, id_medico, data_consulta, servico, observacoes) VALUES (?, ?, ?, ?, ?)";
        $stmt_agendamento = $conn->prepare($inserir_agendamento);
        $stmt_agendamento->bind_param("iisss", $id_paciente, $id_medico, $data_consulta, $servico, $observacoes);

        if ($stmt_agendamento->execute()) {
            echo "Consulta agendada com sucesso!";
            header("refresh: 3;url=../pagina_paciente.php");
        } else {
            echo "Erro ao agendar consulta. Tente novamente.";
        }

        // Fechar as consultas
        $stmt_agendamento->close();
    } else {
        echo "Usuário não autenticado. Faça o login antes de agendar uma consulta.";
        // Redirecionar para a página de login ou realizar outras ações necessárias
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
