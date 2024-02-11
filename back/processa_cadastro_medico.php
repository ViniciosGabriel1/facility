<?php

session_start();

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $especializacao = $_POST["especializacao"];
    $senha = $_POST["senha"];
   

    // Verificar se o e-mail já existe no banco de dados
    $verificar_email = "SELECT id FROM medicos WHERE email = ?";
    $stmt_verificar_email = $conn->prepare($verificar_email);
    $stmt_verificar_email->bind_param("s", $email);
    $stmt_verificar_email->execute();
    $result_verificar_email = $stmt_verificar_email->get_result();

    if ($result_verificar_email->num_rows > 0) {
        echo "E-mail já cadastrado. Por favor, use outro e-mail.";
        $stmt_verificar_email->close();
        $conn->close();
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Upload da foto
    $foto_nome = $_FILES["foto"]["name"];
    $foto_temp = $_FILES["foto"]["tmp_name"];
    $foto_destino = "../uploads/" . $foto_nome;

    move_uploaded_file($foto_temp, $foto_destino);

    // Inserir dados do médico no banco de dados
    $inserir_medico = "INSERT INTO medicos (nome, email, telefone, especializacao, senha, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_medico = $conn->prepare($inserir_medico);
    $stmt_medico->bind_param("ssssss", $nome, $email, $telefone, $especializacao, $senha_hash, $foto_destino);

    if ($stmt_medico->execute()) {
        // Obter o ID do médico recém-inserido
        $id_medico = $stmt_medico->insert_id;

        // Inserir os serviços no banco de dados
        if (isset($_POST["servicos"]) && is_array($_POST["servicos"])) {
            foreach ($_POST["servicos"] as $servico) {
                $inserir_servico = "INSERT INTO servicos (id_medico, servico) VALUES (?, ?)";
                $stmt_servico = $conn->prepare($inserir_servico);
                $stmt_servico->bind_param("is", $id_medico, $servico);
                $stmt_servico->execute();
                $stmt_servico->close();
            }
        }

        echo "Médico cadastrado com sucesso!";
        header("refresh: 3;url=../login.php"); // Redirecionar para a página inicial após o cadastro
    } else {
        echo "Erro ao cadastrar médico. Tente novamente.";
    }

    // Fechar as consultas
    $stmt_medico->close();
    $stmt_verificar_email->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
