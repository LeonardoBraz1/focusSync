<?php
require_once 'conexao.php';
class VendaModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = Conexao::getInstance();
  }

  public function obterVendas($id_barbearia)
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

    $stmt = $this->conn->prepare("SELECT vendas.*, produtos.nome_pro, produtos.imagem, produtos.valor_venda, usuarios.nome, clientes.nome_cliente FROM vendas LEFT JOIN produtos ON vendas.id_pro = produtos.id_pro LEFT JOIN usuarios ON vendas.id_usuario = usuarios.id LEFT JOIN clientes ON vendas.id_cliente = clientes.id_cliente WHERE vendas.id_barbearia = :barbearia_id");
    $stmt->bindParam(':barbearia_id', $id_barbearia);
    $stmt->execute();

    $result = '';

    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $formattedDate = $row['data_venda'];
        $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
        $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

        $result .= '<tr>
                  <td style="display: none;">' . $row['id_venda'] . '</td>
                  <td style="width: 150px;" ><img src="' . $imagemSrc . '" alt="Imagem do Produto" style="max-width: 30px;">' . $row['nome_pro'] . '</td>
                  <td>' . $row['valor_venda'] . '</td>
                  <td>' . $row['quantidade'] . '</td>
                  <td>' . $row['valor_total'] . '</td>
                  <td>' . $row['nome_cliente'] . '</td>
                  <td>' . $formattedDate . '</td>
                  <td>' . $row['numero_fatura'] . '</td>
                  <td><span class="' . getStatusClass($row['status']) . ' statusCor">' . $row['status'] . '</span></td>                  
                  <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                  <label style="cursor: pointer;" for="btnVerVenda-' . $row['id_venda'] . '"><i title="Ver Dados" class="icon fa fa-eye fa-lg" style="color: #023ea7;"></i></label>
                  <input style="display: none;" type="button" class="btnVervenda"  onclick="verVenda(' . $row['id_venda'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['nome_cliente'] . '\', \'' . $row['valor_venda'] . '\', \'' . $row['quantidade'] . '\', \'' . $row['valor_total'] . '\', \'' . date('Y-m-d', strtotime($row['data_venda'])) . '\', \'' . date('Y-m-d', strtotime($row['data_pagamento'])) . '\', \'' . $row['numero_fatura'] . '\', \'' . $row['nome'] . '\', \'' . $row['forma_pagamento'] . '\', \'' . $row['status'] . '\', \'' . $imagemSrc . '\')" id="btnVerVenda-' . $row['id_venda'] . '">
                  <label style="cursor: pointer;" for="btnDeletarVenda-' . $row['id_venda'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                  <input style="display: none;" type="button" onclick="deletarVenda(' . $row['id_venda'] . ')" id="btnDeletarVenda-' . $row['id_venda'] . '">
                  <label style="cursor: pointer;" for="btnStatus-' . $row['id_venda'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                  <input style="display: none;" type="button" onclick="statusVenda(' . $row['id_venda'] . ', \'' . $row['status'] . '\')" id="btnStatus-' . $row['id_venda'] . '">
                  </td>
                </tr>';
      }
    } else {
      $result = '<tr>
              <td colspan="13" style="text-align: center;">
                 <p>Não foram encontradas vendas.</p>
              </td>
            </tr>';
    }

    return $result;
  }

  public function deletarVenda($id_venda)
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

  public function inserirVenda($id_pro, $id_user, $id_cli, $quantidade, $venTotal, $dataPaga, $formapaga, $id_barbearia)
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

        $stmt = $this->conn->prepare("INSERT INTO vendas (id_pro, id_usuario, id_cliente, quantidade, valor_Total, data_Pagamento, forma_pagamento, id_barbearia, status, numero_fatura) VALUES (:id_pro, :id_user, :id_cli, :quantidade, :venTotal, :dataPaga, :formapaga, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ", " . $proximoNumeroFatura . ")");
        $stmt->bindParam(':id_pro', $id_pro);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_cli', $id_cli);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':venTotal', $venTotal);
        $stmt->bindParam(':dataPaga', $dataPaga);
        $stmt->bindParam(':formapaga', $formapaga);
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
  public function editarStatus($id_venda, $status)
  {

    $stmt = $this->conn->prepare("UPDATE vendas SET status = :status WHERE id_venda = :id_venda");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id_venda', $id_venda);
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
