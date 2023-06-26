<?php
require_once '../models/ProdutoModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoModel = new ProdutoModel();

    $id_pro = isset($_POST['id_pro']) ? $_POST['id_pro'] : '';
    $nome_pro = isset($_POST['nome_pro']) ? $_POST['nome_pro'] : '';
    $valor_compra = isset($_POST['valor_compra']) ? $_POST['valor_compra'] : '';
    $valor_venda = isset($_POST['valor_venda']) ? $_POST['valor_venda'] : '';
    $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : '';
    $validade = isset($_POST['validade']) ? $_POST['validade'] : '';
    $alerta_estoque = isset($_POST['alerta_estoque']) ? $_POST['alerta_estoque'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $imagem = isset($_POST['imagem']) ? file_get_contents($_POST['imagem']) : '';

    
    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $produtoModel->editarProduto($id_pro, $nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $descricao, $imagem);
    
    } elseif ($_POST['action'] === 'deletar') {

        $response = $produtoModel->deletarProduto($id_pro);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $produtoModel->inserirProduto($nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $descricao, $imagem, $_SESSION["barbearia_id"]);
    
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