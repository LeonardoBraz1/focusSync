<?php
require_once '../models/ServicoModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicoModel = new ServicoModel();

    $id_servico = isset($_POST['id_servico']) ? $_POST['id_servico'] : '';
    $nome_servico = isset($_POST['nome_servico']) ? $_POST['nome_servico'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : '';
    $comissao = isset($_POST['comissao']) ? $_POST['comissao'] : '';
    $tempo = isset($_POST['tempo']) ? $_POST['tempo'] : '';

    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $servicoModel->editarServico($id_servico, $nome_servico, $preco, $comissao, $tempo);

    } elseif ($_POST['action'] === 'deletar') {

        $response = $servicoModel->deletarServico($id_servico);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $servicoModel->inserirServico($nome_servico, $preco, $comissao, $tempo, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'obterServicos') {

        $servicos = $servicoModel->obterServicos($_SESSION["barbearia_id"]);
        $response = json_encode($servicos);
        
    }  else {
        // Ação desconhecida
        $response = array("status" => "erro", "message" => "Ação desconhecida.");
    }

    echo json_encode($response);
} else {
    // Retorna uma resposta em caso de requisição inválida
    $response = array('error' => false, 'message' => 'Requisição inválida!');
    echo json_encode($response);
}