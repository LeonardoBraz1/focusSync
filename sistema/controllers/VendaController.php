<?php
require_once '../models/VendaModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendaModel = new VendaModel();

    $id_venda = isset($_POST['id_venda']) ? $_POST['id_venda'] : '';
    
    if ($_POST['action'] === 'obterVendas') {

        $vendas = $vendaModel->obterVendas($_SESSION["barbearia_id"]);
        echo $vendas;

    } elseif ($_POST['action'] === 'deletar') {

        $response = $vendaModel->deletarVenda($id_venda);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $vendaModel->inserirVenda($id_pro, $id_user, $id_cli, $quantidade, $venTotal, $dataPaga, $formapaga, $_SESSION["barbearia_id"]);

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