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
                case 'Aprovada':
                    return 'status-aprovado';
                case 'Cancelada':
                    return 'status-cancelado';
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
                    <input style="display: none;" type="button" class="btnVerCompra"  onclick="verCompra(' . $row['id_compra'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['valor_unitario'] . '\', \'' . $row['quantidade'] . '\', \'' . $row['valor_total'] . '\', \'' . $row['nome_fornecedo'] . '\', \'' . date('Y-m-d', strtotime($row['data_compra'])) . '\', \'' . $data_pagamento . '\', \'' . $row['forma_pagamento'] . '\', \'' . $row['status_pagamento'] . '\', \'' . $imagemSrc . '\')" id="btnVerCompra-' . $row['id_compra'] . '">
                    <label style="cursor: pointer;" for="btnDeletarCompra-' . $row['id_compra'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarCompra(' . $row['id_compra'] . ')" id="btnDeletarCompra-' . $row['id_compra'] . '">
                    <label style="cursor: pointer;" for="btnStatusP-' . $row['id_compra'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="statusCompra(' . $row['id_compra'] . ', \'' . $row['status_pagamento'] . '\')" id="btnStatusP-' . $row['id_compra'] . '">
                    </td>
                  </tr>';
        }


        return $result;
    }


    public function deletarCompra($id_compra)
    {

        $stmt = $this->conn->prepare("DELETE FROM compras WHERE id_compra = :id_compra");
        $stmt->bindParam(':id_compra', $id_compra);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array("status" => "sucesso");
        } else {
            $response = array("status" => "erro");
        }

        return $response;
    }

    public function inserirCompra($id_pro, $id_fornecedo, $valor_unitario, $quantidade, $venTotal, $dataPaga, $formapaga, $dataCompra, $id_barbearia)
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


            $stmt = $this->conn->prepare("INSERT INTO compras (id_pro, id_fornecedor, valor_unitario, quantidade, valor_total, data_pagamento, forma_pagamento, data_compra, id_barbearia, status_pagamento) VALUES (:id_pro, :id_fornecedo, :valor_unitario, :quantidade, :venTotal, :dataPaga, :formapaga, :dataCompra, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ")");
            $stmt->bindParam(':id_pro', $id_pro);
            $stmt->bindParam(':id_fornecedo', $id_fornecedo);
            $stmt->bindParam(':valor_unitario', $valor_unitario);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':venTotal', $venTotal);
            $stmt->bindParam(':dataPaga', $dataPaga);
            $stmt->bindParam(':formapaga', $formapaga);
            $stmt->bindParam(':dataCompra', $dataCompra);
            $stmt->bindParam(':id_barbearia', $id_barbearia);
            $stmt->execute();
            $id_compra = $this->conn->lastInsertId();



            if ($stmt->rowCount() > 0) {
                // codigo abaixo inseri na tabela contas a pagar a compra
                $dataConta = date('Y-m-d H:i:s');

                $stmtNomePro = $this->conn->prepare("SELECT nome_pro FROM produtos WHERE id_pro = :id_pro");
                $stmtNomePro->bindParam(':id_pro', $id_pro);
                $stmtNomePro->execute();

                $rowNomePro = $stmtNomePro->fetch(PDO::FETCH_ASSOC);
                $nomePro = $rowNomePro['nome_pro'];

                $nomePro1 = 'Compra - (' . $quantidade . ') ' . $nomePro;

                $stmtContasAPagar = $this->conn->prepare("INSERT INTO contas_a_pagar (descricao, id_fornecedor, valor, data_pagamento, data_conta, id_compra, id_barbearia, status) VALUES (:nomePro1, :id_fornecedo, :venTotal, :dataPaga, :dataConta, :id_compra, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ")");
                $stmtContasAPagar->bindParam(':nomePro1', $nomePro1);
                $stmtContasAPagar->bindParam(':id_fornecedo', $id_fornecedo);
                $stmtContasAPagar->bindParam(':venTotal', $venTotal);
                $stmtContasAPagar->bindParam(':dataPaga', $dataPaga);
                $stmtContasAPagar->bindParam(':dataConta', $dataConta);
                $stmtContasAPagar->bindParam(':id_compra', $id_compra);
                $stmtContasAPagar->bindParam(':id_barbearia', $id_barbearia);
                $stmtContasAPagar->execute();


                $response = array("status" => "sucesso");
            } else {
                $response = array("status" => "erro");
            }
        } else {

            $response = array("status" => "produto_nao_encontrado");
        }
        return $response;
    }

    public function editarStatus($id_compra, $status_pagamento, $dataPaga)
    {
        $stmt = $this->conn->prepare("UPDATE compras SET status_pagamento = :status_pagamento, data_pagamento = :dataPaga  WHERE id_compra = :id_compra");
        $stmt->bindParam(':status_pagamento', $status_pagamento);
        $stmt->bindParam(':id_compra', $id_compra);
        $stmt->bindParam(':dataPaga', $dataPaga);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // sempre que modificar o status da compra serar também modificado na tabela contas a pagar
            $stmtProcuraIdCompra = $this->conn->prepare("SELECT id_compra FROM contas_a_pagar WHERE id_compra = :id_compra");
            $stmtProcuraIdCompra->bindParam(':id_compra', $id_compra);
            $stmtProcuraIdCompra->execute();

            if ($stmtProcuraIdCompra->rowCount() > 0) {

                $stmtUpdateStatus = $this->conn->prepare("UPDATE contas_a_pagar SET status = :status_pagamento, data_pagamento = :dataPaga  WHERE id_compra = :id_compra");
                $stmtUpdateStatus->bindParam(':status_pagamento', $status_pagamento);
                $stmtUpdateStatus->bindParam(':id_compra', $id_compra);
                $stmtUpdateStatus->bindParam(':dataPaga', $dataPaga);
                $stmtUpdateStatus->execute();
            }


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
