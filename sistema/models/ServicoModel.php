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

    public function obterServicos($barbeariaId) {
       
            $stmt = $this->conn->prepare("SELECT * FROM servicos_barbearia WHERE id_barbearia = :barbearia_id");
            $stmt->bindParam(':barbearia_id', $barbeariaId);
            $stmt->execute();

            $servicos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $servico = [
                    'id_servico' => $row['id_servico'],
                    'nome_servico' => $row['nome_servico'],
                    'preco' => $row['preco'],
                    'comissao' => $row['comissao'],
                    'tempo' => $row['tempo'],
                    'data' => date('Y-m-d', strtotime($row['data']))
                ];

                $servicos[] = $servico;
            }

            return $servicos;
    }
}