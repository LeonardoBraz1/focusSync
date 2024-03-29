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
    $imagem = isset($_POST['imagem']) ? file_get_contents($_POST['imagem']) : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
    $comissao = isset($_POST['comissao']) ? $_POST['comissao'] : '';


    
    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $produtoModel->editarProduto($id_pro, $nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $comissao, $descricao, $imagem);
    
    } elseif ($_POST['action'] === 'deletar') {

        $response = $produtoModel->deletarProduto($id_pro);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $produtoModel->inserirProduto($nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $comissao, $descricao, $imagem, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'inserirSaida') {

        $response = $produtoModel->inserirSaida($id_pro, $quantidade, $motivo, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'inserirEntrada') {

        $response = $produtoModel->inserirEntrada($id_pro, $quantidade, $motivo, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'obterEntradas') {

        $entradas = $produtoModel->obterEntradas($_SESSION["barbearia_id"]);
        $response = json_encode($entradas);
        
    } elseif ($_POST['action'] === 'obterProdutos') {

        $produtos = $produtoModel->obterProdutos($_SESSION["barbearia_id"]);
        $response = json_encode($produtos);
        
    } elseif ($_POST['action'] === 'obterProdutosEstoqueBaixo') {

        $produtosEstoque = $produtoModel->obterProdutosEstoqueBaixo($_SESSION["barbearia_id"]);
        $response = json_encode($produtosEstoque);
        
    } elseif ($_POST['action'] === 'obterSaidas') {

        $saidas = $produtoModel->obterSaidas($_SESSION["barbearia_id"]);
        $response = json_encode($saidas);
        
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