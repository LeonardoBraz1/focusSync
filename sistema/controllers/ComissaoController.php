<?php
require_once '../models/ComissaoModel.php';

date_default_timezone_set('America/Sao_Paulo');

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comissaoModel = new ComissaoModel();

    $startDate1 = isset($_POST['startDate1']) ? $_POST['startDate1'] : null;
    $endDate1 = isset($_POST['endDate1']) ? $_POST['endDate1'] : null;


    if ($_POST['action'] === 'obterComissoes') {

        $comissao = $comissaoModel->obterComissao($startDate1, $endDate1, $_SESSION["barbearia_id"]);
        echo $comissao;
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
