<?php
@session_start();

require_once('../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

// Verificar se a sessão do usuário está ativa
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $barbeariaId = $_SESSION["barbearia_id"];
    
    $stmt = $conn->prepare("SELECT u.*, b.nome AS barbearia_nome
    FROM usuarios u
    INNER JOIN barbearias b ON u.id_barbearia = b.id_barbearia
    WHERE u.id = :user_id AND b.id_barbearia = :barbearia_id
");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':barbearia_id', $barbeariaId);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Exibir os dados do usuário e da barbearia
    if ($userData) {
      
        // Exibir outros dados do usuário e da barbearia...
    }
} else {
    // Redirecionar se a sessão do usuário não estiver ativa
    header("Location: ../");
    exit();
}
?>
