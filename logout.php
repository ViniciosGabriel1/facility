<?php
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login (ou qualquer outra página desejada)
header("Location: login.php");
exit();
?>
