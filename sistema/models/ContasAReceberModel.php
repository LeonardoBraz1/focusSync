<?php
require_once 'conexao.php';
class ContasAReceberModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = Conexao::getInstance();
  }

  public function obterContasReceber($startDate1, $endDate1, $id_barbearia)
  {
      function getStatusClass($status)
      {
          switch ($status) {
              case 'Pendente':
                  return 'status-pendente';
              case 'Aprovada':
                  return 'status-aprovada';
              case 'Cancelada':
                  return 'status-cancelada';
              default:
                  return '';
          }
      }
  
      if ($startDate1 && $endDate1) {
         // Adiciona 1 dia ao endDate
         $endDate1 = date('Y-m-d', strtotime($endDate1 . ' +1 day'));
         
          $stmt = $this->conn->prepare("SELECT contas_a_receber.*, clientes.nome_cliente FROM contas_a_receber LEFT JOIN clientes ON contas_a_receber.id_cliente = clientes.id_cliente WHERE contas_a_receber.id_barbearia = :barbearia_id AND contas_a_receber.data_cadastro >= :startDate1 AND contas_a_receber.data_cadastro <= :endDate1");
          $stmt->bindParam(':startDate1', $startDate1);
          $stmt->bindParam(':endDate1', $endDate1);
      } else {
          $stmt = $this->conn->prepare("SELECT contas_a_receber.*, clientes.nome_cliente FROM contas_a_receber LEFT JOIN clientes ON contas_a_receber.id_cliente = clientes.id_cliente  WHERE contas_a_receber.id_barbearia = :barbearia_id");
      }
  
      $stmt->bindParam(':barbearia_id', $id_barbearia);
      $stmt->execute();
  
      $result = '';
  
      if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $formattedDate = date('Y-m-d', strtotime($row['data_cadastro']));
              $data_pagamento = $row['data_pagamento'] ? date('Y-m-d', strtotime($row['data_pagamento'])) : '';
            
              $result .= '<tr>
                    <td style="display: none; font: 1em sans-serif;">' . $row['id_receber'] . '</td>
                    <td ><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i> ' . $row['descricao'] . '</td>
                    <td>R$ ' . $row['valor'] . '</td>
                    <td>' . $data_pagamento . '</td>
                    <td>' . $row['nome_cliente'] . '</td>
                    <td>' . $formattedDate . '</td>
                    <td><span class="' . getStatusClass($row['status']) . ' statusCor">' . $row['status'] . '</span></td>                  
                    <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                    <label style="cursor: pointer;" for="btnVerReceber-' . $row['id_receber'] . '"><i title="Ver Dados" class="icon fa fa-eye fa-lg" style="color: #023ea7;"></i></label>
                    <input style="display: none;" type="button" class="btnVerReceber"  onclick="verReceber(' . $row['id_receber'] . ', \'' . $row['descricao'] . '\', \'' . $row['valor'] . '\', \'' .  $data_pagamento  . '\', \'' . $row['nome_cliente'] . '\', \'' . date('Y-m-d', strtotime($row['data_cadastro'])) . '\', \'' . $row['status'] . '\')" id="btnVerReceber-' . $row['id_receber'] . '">
                    <label style="cursor: pointer;" for="btnDeletarReceber-' . $row['id_receber'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarReceber(' . $row['id_receber'] . ')" id="btnDeletarReceber-' . $row['id_receber'] . '">
                    <label style="cursor: pointer;" for="btnStatus-' . $row['id_receber'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="statusReceber(' . $row['id_receber'] . ', \'' . $row['status'] . '\')" id="btnStatus-' . $row['id_receber'] . '">
                    </td>
                  </tr>';
          }
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
