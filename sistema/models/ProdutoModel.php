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
        $stmt = $this->conn->prepare("UPDATE produtos SET nome_pro = :nome_pro, valor_compra = :valor_compra, valor_venda = :valor_venda, estoque = :estoque, validade = :validade, alerta_estoque = :alerta_estoque, descricao = :descricao, imagem = :imagem WHERE id_pro = :id_pro");
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

    public function inserirSaida($id_pro, $quantidade, $motivo, $id_barbearia)
    {
        // Consulta o estoque atual do produto
        $stmtEstoque = $this->conn->prepare("SELECT estoque FROM produtos WHERE id_pro = :id_pro");
        $stmtEstoque->bindParam(':id_pro', $id_pro);
        $stmtEstoque->execute();

        if ($stmtEstoque->rowCount() > 0) {
            $rowEstoque = $stmtEstoque->fetch(PDO::FETCH_ASSOC);
            $estoqueAtual = $rowEstoque['estoque'];

            // Verifica se há estoque suficiente para a saída
            if ($estoqueAtual >= $quantidade) {
                // Atualiza o estoque do produto
                $novoEstoque = $estoqueAtual - $quantidade;
                $stmtUpdateEstoque = $this->conn->prepare("UPDATE produtos SET estoque = :novoEstoque WHERE id_pro = :id_pro");
                $stmtUpdateEstoque->bindParam(':novoEstoque', $novoEstoque);
                $stmtUpdateEstoque->bindParam(':id_pro', $id_pro);
                $stmtUpdateEstoque->execute();

                // Insere a saída na tabela de "Saídas"
                $stmt = $this->conn->prepare("INSERT INTO saidas (id_pro, quantidade, motivo_saida, id_barbearia) VALUES (:id_pro, :quantidade, :motivo, :id_barbearia)");
                $stmt->bindParam(':id_pro', $id_pro);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':motivo', $motivo);
                $stmt->bindParam(':id_barbearia', $id_barbearia);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $response = array("status" => "sucesso");
                } else {
                    $response = array("status" => "erro");
                }
            } else {
                // Não há estoque suficiente para a saída
                $response = array("status" => "estoque_insuficiente");
            }
        } else {
            // Produto não encontrado
            $response = array("status" => "produto_nao_encontrado");
        }
        return $response;
    }

    public function inserirEntrada($id_pro, $quantidade, $motivo, $id_barbearia)
    {
        // Consulta o estoque atual do produto
        $stmtEstoque = $this->conn->prepare("SELECT estoque FROM produtos WHERE id_pro = :id_pro");
        $stmtEstoque->bindParam(':id_pro', $id_pro);
        $stmtEstoque->execute();

        if ($stmtEstoque->rowCount() > 0) {
            $rowEstoque = $stmtEstoque->fetch(PDO::FETCH_ASSOC);
            $estoqueAtual = $rowEstoque['estoque'];

            // Atualiza o estoque do produto
            $novoEstoque = $estoqueAtual + $quantidade;
            $stmtUpdateEstoque = $this->conn->prepare("UPDATE produtos SET estoque = :novoEstoque WHERE id_pro = :id_pro");
            $stmtUpdateEstoque->bindParam(':novoEstoque', $novoEstoque);
            $stmtUpdateEstoque->bindParam(':id_pro', $id_pro);
            $stmtUpdateEstoque->execute();

            // Insere a saída na tabela de "Saídas"
            $stmt = $this->conn->prepare("INSERT INTO entradas (id_pro, quantidade, motivo_entrada, id_barbearia) VALUES (:id_pro, :quantidade, :motivo, :id_barbearia)");
            $stmt->bindParam(':id_pro', $id_pro);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':motivo', $motivo);
            $stmt->bindParam(':id_barbearia', $id_barbearia);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $response = array("status" => "sucesso");
            } else {
                $response = array("status" => "erro");
            }
        } else {
            // Produto não encontrado
            $response = array("status" => "produto_nao_encontrado");
        }
        return $response;
    }

    public function obterEntradas($id_barbearia)
    {
        $stmt = $this->conn->prepare("SELECT produtos.*, entradas.* FROM produtos LEFT JOIN entradas ON produtos.id_pro = entradas.id_pro WHERE entradas.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();

        $entradas = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

            $entrada = array(
                'id_entrada' => $row['id_entrada'],
                'imagemSrc' => $imagemSrc,
                'nome_produto' => $row['nome_pro'],
                'quantidade' => $row['quantidade'],
                'motivo_entrada' => $row['motivo_entrada'],
                'data_entrada' => date('Y-m-d', strtotime($row['data_entrada']))
            );

            $entradas[] = $entrada;
        }

        return $entradas;
    }

    public function obterProdutos($barbeariaId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE produtos.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $barbeariaId);
        $stmt->execute();

        $produtos = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('Y-m-d', strtotime($row['cadastro']));
            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

            $estoque = $row['estoque'];
            $alertaEstoque = $row['alerta_estoque'];

            $produto = array(
                'id_pro' => $row['id_pro'],
                'imagemSrc' => $imagemSrc,
                'nome_pro' => $row['nome_pro'],
                'valor_compra' => $row['valor_compra'],
                'valor_venda' => $row['valor_venda'],
                'estoque' => $estoque,
                'validade' => $row['validade'],
                'alerta_estoque' => $alertaEstoque,
                'data_cadastro' => $formattedDate,
                'descricao' => $row['descricao']
            );

            $produtos[] = $produto;
        }

        return $produtos;
    }

    public function obterProdutosEstoqueBaixo($barbeariaId)
    {

        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id_barbearia = :barbearia_id AND estoque < alerta_estoque");
        $stmt->bindParam(':barbearia_id', $barbeariaId);
        $stmt->execute();

        $produtosEstoque = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

            $produtoEstoque = [
                'id_pro' => $row['id_pro'],
                'nome_pro' => $row['nome_pro'],
                'valor_compra' => $row['valor_compra'],
                'valor_venda' => $row['valor_venda'],
                'estoque' => $row['estoque'],
                'validade' => $row['validade'],
                'alerta_estoque' => $row['alerta_estoque'],
                'data_cadastro' => date('Y-m-d', strtotime($row['cadastro'])),
                'imagemSrc' => $imagemSrc
            ];

            $produtosEstoque[] = $produtoEstoque;
        }

        return $produtosEstoque;
    }

    public function obterSaidas($barbeariaId)
    {

        $stmt = $this->conn->prepare("SELECT saidas.*, produtos.nome_pro, produtos.imagem FROM saidas LEFT JOIN produtos ON saidas.id_pro = produtos.id_pro WHERE saidas.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $barbeariaId);
        $stmt->execute();

        $saidas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('Y-m-d', strtotime($row['data_saida']));
            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

            $saida = [
                'id_saida' => $row['id_saida'],
                'nome_pro' => $row['nome_pro'],
                'quantidade' => $row['quantidade'],
                'motivo_saida' => $row['motivo_saida'],
                'data_saida' => $formattedDate,
                'imagemSrc' => $imagemSrc
            ];

            $saidas[] = $saida;
        }

        return $saidas;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
