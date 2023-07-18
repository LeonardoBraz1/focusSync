<?php
require_once '../models/VendaModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendaModel = new VendaModel();

    $id_venda = isset($_POST['id_venda']) ? $_POST['id_venda'] : '';
    $id_pro = isset($_POST['id_pro']) ? $_POST['id_pro'] : '';
    $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
    $id_cli = isset($_POST['id_cli']) ? $_POST['id_cli'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $venTotal = isset($_POST['venTotal']) ? $_POST['venTotal'] : '';
    $dataPaga = isset($_POST['dataPaga']) ? $_POST['dataPaga'] : '';
    $formapaga = isset($_POST['formapaga']) ? $_POST['formapaga'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : null;


    if ($_POST['action'] === 'obterVendas') {

        $vendas = $vendaModel->obterVendas($startDate, $endDate, $_SESSION["barbearia_id"]);
        echo $vendas;
    } elseif ($_POST['action'] === 'deletar') {

        $response = $vendaModel->deletarVenda($id_venda);
    } elseif ($_POST['action'] === 'inserir') {

        if ($dataPaga === '') {
            $dataPaga = NULL;
        } else {
            $dataPaga .= ' ' . date('H:i:s');
        }

        $dataVenda = date('Y-m-d H:i:s');

        if($id_user === ''){
            $id_user = NULL;
        }

        if($id_cli === ''){
            $id_cli = NULL;
        }

        $response = $vendaModel->inserirVenda($id_pro, $id_user, $id_cli, $quantidade, $venTotal, $dataPaga, $formapaga, $dataVenda, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'editarStatus') {

        if ($status === 'Aprovada') {
            $dataPaga = date('Y-m-d H:i:s');
        }else {
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
