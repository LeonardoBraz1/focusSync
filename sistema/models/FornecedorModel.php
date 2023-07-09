<?php
require_once 'conexao.php';

class FornecedorModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarFornecedor($id_fornecedo, $nome_fornecedo, $email_fornecedo, $telefone_fornecedo, $pontuacao_fornecedo, $endereco_fornecedo, $cidade_fornecedo, $site_fornecedo)
    {
        $stmt = $this->conn->prepare("UPDATE fornecedores SET nome_fornecedo = :nome_fornecedo, email_fornecedo = :email_fornecedo, telefone_fornecedo = :telefone_fornecedo, pontuacao_fornecedo = :pontuacao_fornecedo, endereco_fornecedo = :endereco_fornecedo, cidade_fornecedo = :cidade_fornecedo, site_fornecedo = :site_fornecedo WHERE id_fornecedo = :id_fornecedo");
        $stmt->bindParam(':nome_fornecedo', $nome_fornecedo);
        $stmt->bindParam(':email_fornecedo', $email_fornecedo);
        $stmt->bindParam(':telefone_fornecedo', $telefone_fornecedo);
        $stmt->bindParam(':pontuacao_fornecedo', $pontuacao_fornecedo);
        $stmt->bindParam(':endereco_fornecedo', $endereco_fornecedo);
        $stmt->bindParam(':cidade_fornecedo', $cidade_fornecedo);
        $stmt->bindParam(':site_fornecedo', $site_fornecedo);
        $stmt->bindParam(':id_fornecedo', $id_fornecedo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function deletarFornecedor($id_fornecedo)
    {
        $stmt = $this->conn->prepare("DELETE FROM fornecedores WHERE id_fornecedo = :id_fornecedo");
        $stmt->bindParam(':id_fornecedo', $id_fornecedo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirFornecedor($nome_fornecedo, $email_fornecedo, $telefone_fornecedo, $pontuacao_fornecedo, $endereco_fornecedo, $cidade_fornecedo, $site_fornecedo, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO fornecedores (nome_fornecedo, email_fornecedo, telefone_fornecedo, pontuacao_fornecedo, endereco_fornecedo, cidade_fornecedo, site_fornecedo, id_barbearia) VALUES (:nome_fornecedo, :email_fornecedo, :telefone_fornecedo, :pontuacao_fornecedo, :endereco_fornecedo, :cidade_fornecedo, :site_fornecedo, :id_barbearia)");
        $stmt->bindParam(':nome_fornecedo', $nome_fornecedo);
        $stmt->bindParam(':email_fornecedo', $email_fornecedo);
        $stmt->bindParam(':telefone_fornecedo', $telefone_fornecedo);
        $stmt->bindParam(':pontuacao_fornecedo', $pontuacao_fornecedo);
        $stmt->bindParam(':endereco_fornecedo', $endereco_fornecedo);
        $stmt->bindParam(':cidade_fornecedo', $cidade_fornecedo);
        $stmt->bindParam(':site_fornecedo', $site_fornecedo);
        $stmt->bindParam(':id_barbearia', $id_barbearia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function obterFornecedores($id_barbearia)
    {
        $stmt = $this->conn->prepare("SELECT * FROM fornecedores WHERE id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();

        $fornecedores = array();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $formattedDate = date('Y-m-d', strtotime($row['data_cadastro']));
                $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone_fornecedo']);

                $message = "Olá, estou entrando em contato através da sua barbearia.";

                $fornecedor = array(
                    'id_fornecedo' => $row['id_fornecedo'],
                    'nome_fornecedo' => $row['nome_fornecedo'],
                    'email_fornecedo' => $row['email_fornecedo'],
                    'telefone_fornecedo' => $row['telefone_fornecedo'],
                    'pontuacao_fornecedo' => $row['pontuacao_fornecedo'],
                    'data_cadastro' => $formattedDate,
                    'endereco_fornecedo' => $row['endereco_fornecedo'],
                    'cidade_fornecedo' => $row['cidade_fornecedo'],
                    'site_fornecedo' => $row['site_fornecedo'],
                    'telefone_fornecedo' => $formattedPhone,
                    'message' => $message
                );
                $fornecedores[] = $fornecedor;
            }
        }

        return $fornecedores;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
