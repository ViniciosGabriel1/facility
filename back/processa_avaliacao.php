<?php
session_start();
include "conexao.php";

// Verificar se o paciente está autenticado
if (!isset($_SESSION["id_usuario"])) {
    // Redirecionar para a página de login se não estiver autenticado
    header("Location: login.php");
    exit();
}
echo  '<br> id usuario: '.$_SESSION["id_usuario"];
echo  '<br> estrelas : '.$_POST["rating"];
echo  '<br> comentário: '.$_POST["comment"];
echo  '<br> id consulta: '. $_POST["id_consulta"];
echo  '<br> id medico: '.$_POST["id_medico"].'<br>';

// Verificar se foram enviados os dados necessários
if (!isset($_POST["rating"]) and !isset($_POST["comment"]) and !isset($_POST["consulta_id"]) and !isset($_POST["medico_id"])) {
    // Redirecionar de volta à página anterior ou exibir uma mensagem de erro
    exit("Por favor, preencha todos os campos.");
}

// Obter o ID do paciente e os dados da avaliação do formulário
$id_paciente = $_SESSION["id_usuario"];
$rating = $_POST["rating"];
$comment = $_POST["comment"];
$consulta_id = $_POST["id_consulta"];
$medico_id = $_POST["id_medico"];
// Verificar se já existe uma avaliação para esta consulta e paciente
$sql_verificar = "SELECT * FROM avaliacoes WHERE id_paciente = ? AND id_consulta = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("ii", $id_paciente, $consulta_id); // Corrigido para $consulta_id
$stmt_verificar->execute();
$result_verificar = $stmt_verificar->get_result();

if ($result_verificar->num_rows > 0) {
    // Já existe uma avaliação para esta consulta e paciente
    header("Location: ../paciente/historico_consulta.php?error=1");
    exit();
}



// Se não existir, inserir a nova avaliação no banco de dados
$sql_inserir = "INSERT INTO avaliacoes (id_paciente, id_consulta, id_medico, estrelas, comentario) VALUES (?, ?, ?, ?, ?)";
$stmt_inserir = $conn->prepare($sql_inserir);
$stmt_inserir->bind_param("iiiss", $id_paciente, $consulta_id, $medico_id, $rating, $comment);

if ($stmt_inserir->execute()) {
    // Avaliação inserida com sucesso
    header("Location: ../paciente/historico_consulta.php");
    exit();
} else {
    // Erro ao inserir a avaliação
    exit("Ocorreu um erro ao processar sua avaliação. Por favor, tente novamente mais tarde.");
}

// Fechar as conexões e liberar recursos
$stmt_verificar->close();
$stmt_inserir->close();
$conn->close();
?>
