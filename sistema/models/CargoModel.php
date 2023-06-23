<?php
require_once 'conexao.php';

class CargoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function deletarCargo($id_nivel)
    {
        $stmt = $this->conn->prepare("DELETE FROM niveis_usuarios WHERE id_nivel = :id_nivel");
        $stmt->bindParam(':id_nivel', $id_nivel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirCargo($nome_nivel, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO niveis_usuarios (nome_nivel, id_barbearia) VALUES (:nome_nivel, :id_barbearia)");
        $stmt->bindParam(':nome_nivel', $nome_nivel);
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