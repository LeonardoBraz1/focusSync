<?php
require_once '../models/CompraModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $compraModel = new CompraModel();

    $id_compra = isset($_POST['id_compra']) ? $_POST['id_compra'] : '';
    $id_pro = isset($_POST['id_pro']) ? $_POST['id_pro'] : '';


    if ($_POST['action'] === 'obterCompras') {

        $compras = $compraModel->obterCompras($_SESSION["barbearia_id"]);
        echo $compras;
    } elseif ($_POST['action'] === 'deletar') {

        $response = $vendaModel->deletarVenda($id_venda);
    } elseif ($_POST['action'] === 'inserir') {

        if ($dataPaga === '') {
            $dataPaga = NULL;
        } else {
            $dataPaga .= ' ' . date('H:i:s');
        }

        $dataVenda = date('Y-m-d H:i:s');

        $response = $vendaModel->inserirVenda($id_pro, $id_user, $id_cli, $quantidade, $venTotal, $dataPaga, $formapaga, $dataVenda, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'editarStatus') {

        if ($status === 'Aprovada') {
            $dataPaga = date('Y-m-d H:i:s');
        }elseif ($status === 'Cancelado'){
            $dataPaga = NULL;
        }

        $response = $vendaModel->editarStatus($id_venda, $status, $dataPaga);
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
