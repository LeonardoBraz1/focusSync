<?php
require_once '../models/FornecedorModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fornecedorModel = new FornecedorModel();

    $id_fornecedo = isset($_POST['id_fornecedo']) ? $_POST['id_fornecedo'] : '';
    $nome_fornecedo = isset($_POST['nome_fornecedo']) ? $_POST['nome_fornecedo'] : '';
    $email_fornecedo = isset($_POST['email_fornecedo']) ? $_POST['email_fornecedo'] : '';
    $telefone_fornecedo = isset($_POST['telefone_fornecedo']) ? $_POST['telefone_fornecedo'] : '';
    $pontuacao_fornecedo = isset($_POST['pontuacao_fornecedo']) ? $_POST['pontuacao_fornecedo'] : '';
    $endereco_fornecedo = isset($_POST['endereco_fornecedo']) ? $_POST['endereco_fornecedo'] : '';
    $cidade_fornecedo = isset($_POST['cidade_fornecedo']) ? $_POST['cidade_fornecedo'] : '';
    $site_fornecedo = isset($_POST['site_fornecedo']) ? $_POST['site_fornecedo'] : '';
    
    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $fornecedorModel->editarFornecedor($id_fornecedo, $nome_fornecedo, $email_fornecedo, $telefone_fornecedo, $pontuacao_fornecedo, $endereco_fornecedo, $cidade_fornecedo, $site_fornecedo);
    
    } elseif ($_POST['action'] === 'deletar') {

        $response = $fornecedorModel->deletarFornecedor($id_fornecedo);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $fornecedorModel->inserirFornecedor($nome_fornecedo, $email_fornecedo, $telefone_fornecedo, $pontuacao_fornecedo, $endereco_fornecedo, $cidade_fornecedo, $site_fornecedo, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'obterFornecedores') {
        $fornecedores = $fornecedorModel->obterFornecedores($_SESSION["barbearia_id"]);
        $response = json_encode($fornecedores);
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