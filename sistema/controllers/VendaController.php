<?php
require_once '../models/VendaModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendaModel = new VendaModel();

    
    if ($_POST['action'] === 'obterVendas') {

        $vendas = $vendaModel->obterVendas($_SESSION["barbearia_id"]);
        $response = json_encode($vendas);
        var_dump($vendas);
    } else {
        // Ação desconhecida
        $response = array("status" => "erro", "message" => "Ação desconhecida.");
    }

    echo json_encode($response);
} else {
    // Retorna uma resposta em caso de requisição inválida
    $response = array('error' => false, 'message' => 'Requisição inválida!');
    echo json_encode($response);
}