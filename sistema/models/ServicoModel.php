<?php
require_once 'conexao.php';

class ServicoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarServico($id_servico, $nome_servico, $preco, $comissao, $tempo)
    {
        $stmt = $this->conn->prepare("UPDATE servicos_barbearia SET nome_servico = :nome_servico, preco = :preco, comissao = :comissao, tempo = :tempo WHERE id_servico = :id_servico");
        $stmt->bindParam(':nome_servico', $nome_servico);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':comissao', $comissao);
        $stmt->bindParam(':tempo', $tempo);
        $stmt->bindParam(':id_servico', $id_servico);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarServico($id_servico)
    {
        $stmt = $this->conn->prepare("DELETE FROM servicos_barbearia WHERE id_servico = :id_servico");
        $stmt->bindParam(':id_servico', $id_servico);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirServico($nome_servico, $preco, $comissao, $tempo, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO servicos_barbearia (nome_servico, preco, comissao, tempo, id_barbearia) VALUES (:nome_servico, :preco, :comissao, :tempo, :id_barbearia)");
        $stmt->bindParam(':nome_servico', $nome_servico);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':comissao', $comissao);
        $stmt->bindParam(':tempo', $tempo);
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