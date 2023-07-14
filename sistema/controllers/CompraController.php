<?php
require_once '../models/CompraModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $compraModel = new CompraModel();

    $id_compra = isset($_POST['id_compra']) ? $_POST['id_compra'] : '';
    $id_pro = isset($_POST['id_pro']) ? $_POST['id_pro'] : '';
    $status_pagamento = isset($_POST['status_pagamento']) ? $_POST['status_pagamento'] : '';
    $id_fornecedo = isset($_POST['id_fornecedo']) ? $_POST['id_fornecedo'] : '';
    $valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $venTotal = isset($_POST['venTotal']) ? $_POST['venTotal'] : '';
    $dataPaga = isset($_POST['dataPaga']) ? $_POST['dataPaga'] : '';
    $formapaga = isset($_POST['formapaga']) ? $_POST['formapaga'] : '';


    if ($_POST['action'] === 'obterCompras') {

        $compras = $compraModel->obterCompras($_SESSION["barbearia_id"]);
        echo $compras;
    } elseif ($_POST['action'] === 'deletar') {

        $response = $compraModel->deletarCompra($id_compra);
    } elseif ($_POST['action'] === 'inserir') {

        if ($dataPaga === '') {
            $dataPaga = NULL;
        } else {
            $dataPaga .= ' ' . date('H:i:s');
        }

        $dataCompra = date('Y-m-d H:i:s');

        $response = $compraModel->inserirCompra($id_pro, $id_fornecedo, $valor_unitario, $quantidade, $venTotal, $dataPaga, $formapaga, $dataCompra, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'editarStatus') {

        if ($status_pagamento === 'Pago') {
            $dataPaga = date('Y-m-d H:i:s');
        } else {
            $dataPaga = null;
        }

        $response = $compraModel->editarStatus($id_compra, $status_pagamento, $dataPaga);
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
