<?php
require_once 'conexao.php';
class CompraModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::getInstance();
    }

    public function obterCompras($id_barbearia)
    {
        function getStatusClass($status)
        {
            switch ($status) {
                case 'Pendente':
                    return 'status-pendente';
                case 'Pago':
                    return 'status-pago';
                default:
                    return '';
            }
        }

        $stmt = $this->conn->prepare("SELECT compras.*, produtos.nome_pro, produtos.imagem, fornecedores.nome_fornecedo FROM compras LEFT JOIN produtos ON compras.id_pro = produtos.id_pro LEFT JOIN fornecedores ON compras.id_fornecedor = fornecedores.id_fornecedo WHERE compras.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();

        $result = '';


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('Y-m-d', strtotime($row['data_compra']));
            $data_pagamento = $row['data_pagamento'] ? date('Y-m-d', strtotime($row['data_pagamento'])) : '';
            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

            $result .= '<tr>
                    <td style="display: none;">' . $row['id_compra'] . '</td>
                    <td style="width: 150px;" ><img src="' . $imagemSrc . '" alt="Imagem do Produto" style="max-width: 30px;">' . $row['nome_pro'] . '</td>
                    <td>' . $row['valor_unitario'] . '</td>
                    <td>' . $row['quantidade'] . '</td>
                    <td>' . $row['valor_total'] . '</td>
                    <td>' . $row['nome_fornecedo'] . '</td>
                    <td>' . $formattedDate . '</td>
                    <td><span class="' . getStatusClass($row['status_pagamento']) . ' statusCor">' . $row['status_pagamento'] . '</span></td>                  
                    <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                    <label style="cursor: pointer;" for="btnVerCompra-' . $row['id_compra'] . '"><i title="Ver Dados" class="icon fa fa-eye fa-lg" style="color: #023ea7;"></i></label>
                    <input style="display: none;" type="button" class="btnVerCompra"  onclick="verCompra(' . $row['id_compra'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['nome_fornecedo'] . '\', \'' . $row['valor_unitario'] . '\', \'' . $row['quantidade'] . '\', \'' . $row['valor_total'] . '\', \'' . date('Y-m-d', strtotime($row['data_compra'])) . '\', \'' . $data_pagamento . '\', \'' . $row['status_pagamento'] . '\', \'' . $imagemSrc . '\')" id="btnVerCompra-' . $row['id_compra'] . '">
                    <label style="cursor: pointer;" for="btnDeletarCompra-' . $row['id_compra'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarCompra(' . $row['id_compra'] . ')" id="btnDeletarCompra-' . $row['id_compra'] . '">
                    <label style="cursor: pointer;" for="btnStatusP-' . $row['id_compra'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="statusCompra(' . $row['id_compra'] . ', \'' . $row['status_pagamento'] . '\')" id="btnStatusP-' . $row['id_compra'] . '">
                    </td>
                  </tr>';
        }


        return $result;
    }


    public function deletarCompra($id_venda)
    {

        $stmt = $this->conn->prepare("DELETE FROM vendas WHERE id_venda = :id_venda");
        $stmt->bindParam(':id_venda', $id_venda);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirVenda($id_pro, $id_user, $id_cli, $quantidade, $venTotal, $dataPaga, $formapaga, $dataVenda, $id_barbearia)
    {


        // Consulta o estoque atual do produto
        $stmtEstoque = $this->conn->prepare("SELECT estoque FROM produtos WHERE id_pro = :id_pro");
        $stmtEstoque->bindParam(':id_pro', $id_pro);
        $stmtEstoque->execute();

        if ($stmtEstoque->rowCount() > 0) {
            $rowEstoque = $stmtEstoque->fetch(PDO::FETCH_ASSOC);
            $estoqueAtual = $rowEstoque['estoque'];


            if ($estoqueAtual >= $quantidade) {
                // Atualiza o estoque do produto
                $novoEstoque = $estoqueAtual - $quantidade;
                $stmtUpdateEstoque = $this->conn->prepare("UPDATE produtos SET estoque = :novoEstoque WHERE id_pro = :id_pro");
                $stmtUpdateEstoque->bindParam(':novoEstoque', $novoEstoque);
                $stmtUpdateEstoque->bindParam(':id_pro', $id_pro);
                $stmtUpdateEstoque->execute();


                $stmtFatura = $this->conn->prepare("SELECT max(numero_fatura) FROM vendas");
                $stmtFatura->execute();
                $maiorFatura = $stmtFatura->fetchColumn();
                $proximoNumeroFatura = $maiorFatura + 1;

                $stmt = $this->conn->prepare("INSERT INTO vendas (id_pro, id_usuario, id_cliente, quantidade, valor_Total, data_Pagamento, forma_pagamento, data_venda, id_barbearia, status, numero_fatura) VALUES (:id_pro, :id_user, :id_cli, :quantidade, :venTotal, :dataPaga, :formapaga, :dataVenda, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ", " . $proximoNumeroFatura . ")");
                $stmt->bindParam(':id_pro', $id_pro);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':id_cli', $id_cli);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':venTotal', $venTotal);
                $stmt->bindParam(':dataPaga', $dataPaga);
                $stmt->bindParam(':formapaga', $formapaga);
                $stmt->bindParam(':dataVenda', $dataVenda);
                $stmt->bindParam(':id_barbearia', $id_barbearia);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $response = array("status" => "sucesso");
                } else {
                    $response = array("status" => "erro");
                }
            } else {

                $response = array("status" => "estoque_insuficiente");
            }
        } else {

            $response = array("status" => "produto_nao_encontrado");
        }
        return $response;
    }
    public function editarStatus($id_venda, $status, $dataPaga)
    {
        $stmt = $this->conn->prepare("UPDATE vendas SET status = :status, data_pagamento = :dataPaga  WHERE id_venda = :id_venda");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_venda', $id_venda);
        $stmt->bindParam(':dataPaga', $dataPaga);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
