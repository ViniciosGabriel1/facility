<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Função para limpar e validar os dados
function limpar_entrada($entrada)
{
    // Remove espaços em branco no início e no final
    $entrada = trim($entrada);
    // Remove barras invertidas
    $entrada = stripslashes($entrada);
    // Converte caracteres especiais em entidades HTML
    $entrada = htmlspecialchars($entrada);
    return $entrada;
}

/// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do formulário e limpar
    $nome = limpar_entrada($_POST['nome']);
    $telefone = limpar_entrada($_POST['telefone']);
    $email = limpar_entrada($_POST['email']);
    $senha = limpar_entrada($_POST['senha']);
    $confirmaSenha = limpar_entrada($_POST['confirma_senha']);
    // $rg = limpar_entrada($_POST['rg']); // Adicione esta linha para capturar o RG

    // Validar o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "O e-mail inserido não é válido.";
    } else {
        // Verificar se o e-mail já está em uso
        $sql = "SELECT * FROM pacientes WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Este e-mail já está em uso. Por favor, escolha outro.";
        } else {
            // E-mail não está em uso, verificar se a senha coincide com a confirmação de senha
            if ($senha != $confirmaSenha) {
                echo "As senhas não coincidem. Por favor, tente novamente.";
            } else {
                // Senha e e-mail estão OK, realizar o cadastro

                // Criptografar a senha
                $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

                // Preparar a consulta SQL com a senha criptografada e RG
                $sql_insert = "INSERT INTO pacientes (nome, telefone, email, senha) VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ssss", $nome, $telefone, $email, $senhaCriptografada);

                if ($stmt_insert->execute()) {
                    echo "success";
                    exit(); // Encerrar o script após o redirecionamento
                } else {
                    echo "Erro ao cadastrar: " . $stmt_insert->error;
                }

                // Fechar a declaração de inserção
                $stmt_insert->close();
            }
        }
    }
} else {
    // Se o formulário não foi enviado, redirecionar para a página de cadastro
    header("Location: cadastro.php");
    exit();
}

// Fechar a consulta de verificação de e-mail
$stmt->close();

// Fechar conexão com o banco de dados
$conn->close();
