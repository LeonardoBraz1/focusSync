<?php
require_once '../models/ContasAReceberModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contaRModel = new ContasAReceberModel();

    $id_receber = isset($_POST['id_receber']) ? $_POST['id_receber'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $id_cli = isset($_POST['id_cli']) ? $_POST['id_cli'] : '';
    $valor = isset($_POST['valor']) ? $_POST['valor'] : '';
    $dataPaga = isset($_POST['dataPaga']) ? $_POST['dataPaga'] : '';
    $data_cadastro = isset($_POST['data_cadastro']) ? $_POST['data_cadastro'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $startDate1 = isset($_POST['startDate1']) ? $_POST['startDate1'] : null;
    $endDate1 = isset($_POST['endDate1']) ? $_POST['endDate1'] : null;


    if ($_POST['action'] === 'obterContasReceber') {

        $contasR = $contaRModel->obterContasReceber($startDate1, $endDate1, $_SESSION["barbearia_id"]);
        echo $contasR;
    } elseif ($_POST['action'] === 'deletar') {

        $response = $contaRModel->deletarContaReceber($id_receber);
    } elseif ($_POST['action'] === 'inserir') {

        if ($dataPaga === '') {
            $dataPaga = NULL;
        } else {
            $dataPaga .= ' ' . date('H:i:s');
        }

        $data_cadastro = date('Y-m-d H:i:s');

        if($id_cli === ''){
            $id_cli = NULL;
        }

        $response = $contaRModel->inserirContaAReceber($descricao, $id_cli, $valor, $dataPaga, $data_cadastro, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'editarStatus') {

        if ($status === 'Aprovada') {
            $dataPaga = date('Y-m-d H:i:s');
        }else {
            $dataPaga = NULL;
        }

        $response = $contaRModel->editarStatusReceber($id_receber, $status, $dataPaga);
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
