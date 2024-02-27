<?php
session_start(); // Inicia a sessão para acessar as variáveis de sessão

// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

// Verifique se os dados foram enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se os campos não estão vazios
    if (!empty($_POST['servico']) && !empty($_POST['descricao'])) {
        // Verifique se o ID do médico está na sessão
        if (isset($_SESSION['id_usuario'])) {
            // Prepare a declaração SQL para inserir o serviço com o ID do médico
            $stmt = $conn->prepare("INSERT INTO servicos (id_medico, servico, descricao) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_medico, $servico, $descricao); // "iss" indica que os parâmetros são int, string, string

            // Defina os parâmetros e execute
            $id_medico = $_SESSION['id_usuario'];
            $servico = $_POST['servico'];
            $descricao = $_POST['descricao'];
            if ($stmt->execute()) {
                echo "Serviço adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar o serviço: " . $conn->error;
            }

            // Feche a declaração
            $stmt->close();
        } else {
            echo "Erro: ID do médico não encontrado na sessão.";
        }
    } else {
        echo $id_medico;
        echo $servico;
        echo $descricao;

        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "Erro: Método de requisição inválido.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
