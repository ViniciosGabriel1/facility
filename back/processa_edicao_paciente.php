<?php

session_start();

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $id_paciente = $_SESSION["id_usuario"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    // Hash da senha se fornecida
    $senha_hash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : '';

    // Upload da nova foto, se fornecida
    $foto_destino = '';
    if (!empty($_FILES["foto"]["name"])) {
        $foto_nome = $_FILES["foto"]["name"];
        $foto_temp = $_FILES["foto"]["tmp_name"];
        $foto_destino = "../uploads_pacientes/" . $foto_nome;

        move_uploaded_file($foto_temp, $foto_destino);
    }

    // Atualizar dados do paciente no banco de dados
    $atualizar_paciente = "UPDATE pacientes SET nome = ?, email = ?, telefone = ?, senha = ?, foto = ? WHERE id = ?";
    $stmt_paciente = $conn->prepare($atualizar_paciente);
    $stmt_paciente->bind_param("sssssi", $nome, $email, $telefone, $senha_hash, $foto_destino, $id_paciente);

    if ($stmt_paciente->execute()) {
        echo "Perfil do paciente atualizado com sucesso!";
        header("refresh: 3;url=../pagina_paciente.php"); // Redirecionar para a página do paciente após a atualização
    } else {
        echo "Erro ao atualizar perfil do paciente. Tente novamente.";
    }

    // Fechar a consulta
    $stmt_paciente->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
