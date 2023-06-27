<?php
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$userId = $_POST['userId'];

// Consultar o banco de dados para obter o número de telefone
$sql = 'SELECT telefone FROM usuarios WHERE id = :userId';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$phoneNumber = $row['telefone'];

echo json_encode(['phoneNumber' => $phoneNumber]);

}
?>