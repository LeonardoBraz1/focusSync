<?php
require_once 'conexao.php';

class ProdutoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarProduto($id_pro, $nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $descricao, $imagem)
    {
        $stmt = $this->conn->prepare("UPDATE produtos SET nome_pro = :nome_pro, valor_compra = :valor_compra, valor_venda = :valor_venda, estoque = :estoque, validade = :validade, alerta_estoque = :alerta_estoque, descricao = :descricao, imagem = :imagem  WHERE id_pro = :id_pro");
        $stmt->bindParam(':nome_pro', $nome_pro);
        $stmt->bindParam(':valor_compra', $valor_compra);
        $stmt->bindParam(':valor_venda', $valor_venda);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':validade', $validade);
        $stmt->bindParam(':alerta_estoque', $alerta_estoque);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
        $stmt->bindParam(':id_pro', $id_pro);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarProduto($id_pro)
    {
        $stmt = $this->conn->prepare("DELETE FROM produtos WHERE id_pro = :id_pro");
        $stmt->bindParam(':id_pro', $id_pro);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirProduto($nome_pro, $valor_compra, $valor_venda, $estoque, $validade, $alerta_estoque, $descricao, $imagem, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO produtos (nome_pro, valor_compra, valor_venda, estoque, validade, alerta_estoque, descricao, imagem, id_barbearia) VALUES (:nome_pro, :valor_compra, :valor_venda, :estoque, :validade, :alerta_estoque, :descricao, :imagem, :id_barbearia)");
        $stmt->bindParam(':nome_pro', $nome_pro);
        $stmt->bindParam(':valor_compra', $valor_compra);
        $stmt->bindParam(':valor_venda', $valor_venda);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':validade', $validade);
        $stmt->bindParam(':alerta_estoque', $alerta_estoque);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }
}
