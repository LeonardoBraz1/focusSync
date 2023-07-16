<?php
@session_start();

// Verificar se a sessão do usuário está ativa
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $barbeariaId = $_SESSION["barbearia_id"];
   
} else {
    // Redirecionar se a sessão do usuário não estiver ativa
    header("Location: ../../");
    exit();
}
?>
