<?php
require_once('../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

@session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT u.id AS user_id, u.nome AS user_nome, u.email AS user_email, u.senha AS user_senha, LOWER(n.nome_nivel) AS user_nivel_nome, u.id_barbearia AS barbearia_id, b.nome AS barbearia_nome
    FROM usuarios u
    LEFT JOIN barbearias b ON u.id_barbearia = b.id_barbearia
    LEFT JOIN niveis_usuarios n ON u.id_nivel = n.id_nivel
    WHERE u.email = :username AND u.senha = :password
    ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Atribuir as variáveis de sessão do usuário e da barbearia
        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_nome"] = $result["user_nome"];
        $_SESSION["user_email"] = $result["user_email"];
        $_SESSION["user_nivel_nome"] = $result["user_nivel_nome"];
        $_SESSION["barbearia_id"] = $result["barbearia_id"];
        $_SESSION["barbearia_nome"] = $result["barbearia_nome"];

        // Redirecionar com base no cargo
        if (strtolower($_SESSION["user_nivel_nome"]) === "administrador") {
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            header("Location: ../views/outro-local.php");
            exit();
        }
    } else {
        $_SESSION["exibir_modal_senha"] = true;
        header("Location: ../");
        exit();
    }
}