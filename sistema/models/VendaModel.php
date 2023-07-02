<?php
require_once 'conexao.php';

class VendaModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function deletarVenda($id)
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

    public function inserirVenda($email, $nome, $senha, $id_nivel, $ativo, $id_barbearia)
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

    public function obterVendas($id_barbearia)
    {
        $stmt = $this->conn->prepare("SELECT vendas.*, produtos.nome_pro, produtos.imagem, produtos.valor_venda, usuarios.nome, clientes.nome_cliente FROM vendas LEFT JOIN produtos ON vendas.id_pro = produtos.id_pro LEFT JOIN usuarios ON vendas.id_usuario = usuarios.id LEFT JOIN clientes ON vendas.id_cliente = clientes.id_cliente WHERE vendas.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();
    
        $vendas = array(); 
    
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $venda = array(
                    'id_venda' => $row['id_venda'],
                    'nome_pro' => $row['nome_pro'],
                    'valor_venda' => $row['valor_venda'],
                    'quantidade' => $row['quantidade'],
                    'valor_total' => $row['valor_total'],
                    'nome_cliente' => $row['nome_cliente'],
                    'data_venda' => $row['data_venda'],
                    'data_pagamento' => $row['data_pagamento'],
                    'numero_fatura' => $row['numero_fatura'],
                    'nome_usuario' => $row['nome'],
                    'imagemSrc' => $row['imagem'],
                    'forma_pagamento' => $row['forma_pagamento'],
                    'status' => $row['status']
                );
                $vendas[] = $venda;
            }
        }
    
        return $vendas; 
    }
}
