<?php
// Inicie a sessão
session_start();

// Verifique se o médico está autenticado (você precisa implementar essa verificação)
if (!isset($_SESSION['id_usuario'])) {
    // Se o médico não estiver autenticado, redirecione para a página de login ou exiba uma mensagem de erro
    echo "Você não está autenticado. Por favor, faça login.";
    exit(); // Encerre o script
}

// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

// Verifique se os dados foram enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se os campos não estão vazios
    if (!empty($_POST['nome_formacao']) && !empty($_POST['data_inicio']) && !empty($_POST['data_termino'])) {
        // Prepare a declaração SQL para inserir a formação
        $stmt = $conn->prepare("INSERT INTO formacoes (id_medico, nome_formacao, data_inicio, data_termino) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_medico, $nome_formacao, $data_inicio, $data_termino); // "isss" indica que os parâmetros são int, string, string, string

        // Obtenha o ID do médico logado
        $id_medico = $_SESSION['id_usuario'];

        // Defina os parâmetros e execute
        $nome_formacao = $_POST['nome_formacao'];
        $data_inicio = $_POST['data_inicio'];
        $data_termino = $_POST['data_termino'];
        if ($stmt->execute()) {
            echo "Formação adicionada com sucesso!";
        } else {
            echo "Erro ao adicionar a formação: " . $conn->error;
        }

        // Feche a declaração
        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "Erro: Método de requisição inválido.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
