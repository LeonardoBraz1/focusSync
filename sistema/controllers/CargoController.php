<?php
require_once '../models/CargoModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cargoModel = new CargoModel();

    $id_nivel = isset($_POST['id_nivel']) ? $_POST['id_nivel'] : '';
    $nome_nivel = isset($_POST['nome_nivel']) ? $_POST['nome_nivel'] : '';

    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'deletar') {

        $response = $cargoModel->deletarCargo($id_nivel);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $cargoModel->inserirCargo($nome_nivel, $_SESSION["barbearia_id"]);
    
    }  elseif ($_POST['action'] === 'obterCargos') {

        $cargos = $cargoModel->obterCargos($_SESSION["barbearia_id"]);
        $response = json_encode($cargos);
        
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