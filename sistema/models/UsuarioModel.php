<?php
require_once 'conexao.php';

class UsuarioModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarUsuario($id, $email, $nome, $senha, $id_nivel, $ativo)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios SET email = :email, nome = :nome, senha = :senha, id_nivel = :id_nivel, ativo = :ativo WHERE id = :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id_nivel', $id_nivel);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarUsuario($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirUsuario($email, $nome, $senha, $id_nivel, $ativo, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (email, nome, senha, id_nivel, ativo, id_barbearia) VALUES (:email, :nome, :senha, :id_nivel, :ativo, :id_barbearia)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id_nivel', $id_nivel);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function validarNome($nome)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $response = array("status" => "existe");
        } else {
            $response = array("status" => "nao_existe");
        }

        return $response;
    }

    public function validarEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $response = array("status" => "existe");
        } else {
            $response = array("status" => "nao_existe");
        }

        return $response;
    }
}

