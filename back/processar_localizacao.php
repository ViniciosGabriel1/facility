<?php
session_start();

// Verificar se o médico está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit(); // Encerrar o script para evitar que o código continue sendo executado
}

// Verificar se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    require_once "conexao.php";

    // Obter o ID do médico logado da sessão
    $id_medico = $_SESSION['id_usuario'];

    // Obter os dados do formulário
    $link_localizacao = $_POST['link_localizacao'];

    // Preparar a consulta SQL para atualizar a localização da clínica
    $sql = "UPDATE medicos SET link_localizacao = ? WHERE id_medico = ?";

    // Preparar a instrução SQL usando PDO
    $stmt = $conn->prepare($sql);

    // Executar a consulta
    try {
        $stmt->execute([$link_localizacao, $id_medico]);
        echo "Localização da clínica adicionada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao adicionar localização da clínica: " . $e->getMessage();
    }

    // Fechar a conexão com o banco de dados
    $conn = null;
}
?>
