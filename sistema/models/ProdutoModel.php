<?php
require_once 'conexao.php';

class ClienteModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarCliente($id_cliente, $nome_cliente, $email_cliente, $telefone_cliente)
    {
        $stmt = $this->conn->prepare("UPDATE clientes SET nome_cliente = :nome_cliente, email_cliente = :email_cliente, telefone_cliente = :telefone_cliente WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':nome_cliente', $nome_cliente);
        $stmt->bindParam(':email_cliente', $email_cliente);
        $stmt->bindParam(':telefone_cliente', $telefone_cliente);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarCliente($id_cliente)
    {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirCliente($nome_cliente, $email_cliente, $telefone_cliente, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente, id_barbearia) VALUES (:nome_cliente, :email_cliente, :telefone_cliente, :id_barbearia)");
        $stmt->bindParam(':nome_cliente', $nome_cliente);
        $stmt->bindParam(':email_cliente', $email_cliente);
        $stmt->bindParam(':telefone_cliente', $telefone_cliente);
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