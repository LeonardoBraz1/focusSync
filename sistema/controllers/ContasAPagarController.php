<?php
require_once '../models/ContasAPagarModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contaModel = new ContasAPagarModel();

    $id_conta = isset($_POST['id_conta']) ? $_POST['id_conta'] : '';
    $id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';
    $id_fornecedo = isset($_POST['id_fornecedo']) ? $_POST['id_fornecedo'] : '';
    $valor = isset($_POST['valor']) ? $_POST['valor'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $dataPaga = isset($_POST['dataPaga']) ? $_POST['dataPaga'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $startDate1 = isset($_POST['startDate1']) ? $_POST['startDate1'] : null;
    $endDate1 = isset($_POST['endDate1']) ? $_POST['endDate1'] : null;


    if ($_POST['action'] === 'obterContas') {

        $contas = $contaModel->obterContas($startDate1, $endDate1, $_SESSION["barbearia_id"]);
        echo $contas;
    } elseif ($_POST['action'] === 'deletar') {

        $response = $contaModel->deletarContaAPagar($id_conta);
    } elseif ($_POST['action'] === 'inserir') {

        if ($dataPaga === '') {
            $dataPaga = NULL;
        } else {
            $dataPaga .= ' ' . date('H:i:s');
        }

        $data_conta = date('Y-m-d H:i:s');

        if($id_usuario === ''){
            $id_usuario = NULL;
        }

        if($id_fornecedo === ''){
            $id_fornecedo = NULL;
        }

        $response = $contaModel->inserirContaAPagar($descricao, $id_fornecedo, $id_usuario, $valor, $dataPaga, $data_conta, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'editarStatus') {

        if ($status === 'Aprovada') {
            $dataPaga = date('Y-m-d H:i:s');
        }else {
            $dataPaga = NULL;
        }

        $response = $contaModel->editarStatus($id_conta, $status, $dataPaga);
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
