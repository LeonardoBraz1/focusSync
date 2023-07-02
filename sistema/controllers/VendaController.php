<?php
require_once '../models/VendaModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendaModel = new VendaModel();

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $id_nivel = isset($_POST['id_nivel']) ? $_POST['id_nivel'] : '';
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : '';

    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $usuarioModel->editarUsuario($id, $email, $nome, $senha, $id_nivel, $ativo);

    } elseif ($_POST['action'] === 'deletar') {

        $response = $usuarioModel->deletarUsuario($id);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $usuarioModel->inserirUsuario($email, $nome, $senha, $id_nivel, $ativo, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'obterVendas') {

        $vendas = $vendaModel->obterVendas($_SESSION["barbearia_id"]);
        $response = json_encode($vendas);

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