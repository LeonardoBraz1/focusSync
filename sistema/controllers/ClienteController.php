<?php
require_once '../models/ClienteModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteModel = new ClienteModel();

    $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
    $nome_cliente = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : '';
    $email_cliente = isset($_POST['email_cliente']) ? $_POST['email_cliente'] : '';
    $telefone_cliente = isset($_POST['telefone_cliente']) ? $_POST['telefone_cliente'] : '';
    
    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $clienteModel->editarCliente($id_cliente, $nome_cliente, $email_cliente, $telefone_cliente);
    
    } elseif ($_POST['action'] === 'deletar') {

        $response = $clienteModel->deletarCliente($id_cliente);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $clienteModel->inserirCliente($nome_cliente, $email_cliente, $telefone_cliente, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'obterClientes') {

        $clientes = $clienteModel->obterClientes($_SESSION["barbearia_id"]);
        $response = json_encode($clientes);

    } elseif ($_POST['action'] === 'obterClientesRetorno') {

        $obterClientesRetornos = $clienteModel->obterClientesRetorno($_SESSION["barbearia_id"]);
        $response = json_encode($obterClientesRetornos);
        
    } else {
        // Ação desconhecida
        $response = array("status" => "erro", "message" => "Ação desconhecida.");
    }

    echo json_encode($response);
} else {
    $response = array('error' => false, 'message' => 'Requisição inválida!');
    echo json_encode($response);
}