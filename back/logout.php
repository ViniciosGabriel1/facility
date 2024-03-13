<?php
session_start();

// Armazenar a mensagem de logout na variável de sessão
$_SESSION['logout_message'] = "Você foi desconectado com sucesso!";

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login com o parâmetro 'logout=1' na URL
header("Location: ../login.php?logout=1");
exit();
?>
