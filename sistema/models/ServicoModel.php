<?php
require_once 'conexao.php';

class ServicoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function editarServico($id_servico, $nome_servico, $preco, $tempo, $imagem)
    {
        $stmt = $this->conn->prepare("UPDATE servicos_barbearia SET nome_servico = :nome_servico, preco = :preco, tempo = :tempo, imagem = :imagem WHERE id_servico = :id_servico");
        $stmt->bindParam(':nome_servico', $nome_servico);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':tempo', $tempo);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
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

    public function inserirServico($nome_servico, $preco, $tempo, $imagem, $id_barbearia)
    {
        $stmt = $this->conn->prepare("INSERT INTO servicos_barbearia (nome_servico, preco, tempo,  imagem, id_barbearia) VALUES (:nome_servico, :preco, :tempo,  :imagem, :id_barbearia)");
        $stmt->bindParam(':nome_servico', $nome_servico);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':tempo', $tempo);
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

    public function obterServicos($barbeariaId)
    {

        $stmt = $this->conn->prepare("SELECT * FROM servicos_barbearia WHERE id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $barbeariaId);
        $stmt->execute();

        $servicos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';
            
            $servico = [
                'id_servico' => $row['id_servico'],
                'nome_servico' => $row['nome_servico'],
                'preco' => $row['preco'],
                'tempo' => $row['tempo'],
                'imagemSrc' => $imagemSrc,
                'data' => date('Y-m-d', strtotime($row['data']))
            ];

            $servicos[] = $servico;
        }

        return $servicos;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
