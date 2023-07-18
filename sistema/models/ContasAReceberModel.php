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
                    <input style="display: none;" type="button" class="btnVerReceber"  onclick="verContasAReceber(' . $row['id_receber'] . ', \'' . $row['descricao'] . '\', \'' . $row['valor'] . '\', \'' .  $data_pagamento  . '\', \'' . $row['nome_cliente'] . '\', \'' . date('Y-m-d', strtotime($row['data_cadastro'])) . '\', \'' . $row['status'] . '\')" id="btnVerReceber-' . $row['id_receber'] . '">
                    <label style="cursor: pointer;" for="btnDeletarReceber-' . $row['id_receber'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarContaReceber(' . $row['id_receber'] . ')" id="btnDeletarReceber-' . $row['id_receber'] . '">
                    <label style="cursor: pointer;" for="btnStatus-' . $row['id_receber'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="statusReceber(' . $row['id_receber'] . ', \'' . $row['status'] . '\')" id="btnStatus-' . $row['id_receber'] . '">
                    </td>
                  </tr>';
      }
    }

    return $result;
  }


  public function deletarContaReceber($id_receber)
  {

    $stmt = $this->conn->prepare("DELETE FROM contas_a_receber WHERE id_receber = :id_receber");
    $stmt->bindParam(':id_receber', $id_receber);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = array("status" => "sucesso");
    } else {
      $response = array("status" => "erro");
    }

    return $response;
  }

  public function inserirContaAReceber($descricao, $id_cli, $valor, $dataPaga, $data_cadastro, $id_barbearia)
  {




    $stmt = $this->conn->prepare("INSERT INTO contas_a_receber (descricao, id_cliente, valor, data_Pagamento, data_cadastro, id_barbearia, status) VALUES (:descricao, :id_cli, :valor, :dataPaga, :data_cadastro, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ")");
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_cli', $id_cli);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':dataPaga', $dataPaga);
    $stmt->bindParam(':data_cadastro', $data_cadastro);
    $stmt->bindParam(':id_barbearia', $id_barbearia);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = array("status" => "sucesso");
    } else {
      $response = array("status" => "erro");
    }

    return $response;
  }
  public function editarStatusReceber($id_receber, $status, $dataPaga)
  {
    $stmt = $this->conn->prepare("UPDATE contas_a_receber SET status = :status, data_pagamento = :dataPaga  WHERE id_receber = :id_receber");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id_receber', $id_receber);
    $stmt->bindParam(':dataPaga', $dataPaga);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $stmtProcuraIdVenda = $this->conn->prepare("SELECT id_venda FROM contas_a_receber where id_receber = :id_receber");
      $stmtProcuraIdVenda->bindParam(':id_receber', $id_receber);
      $stmtProcuraIdVenda->execute();
      $rowProcuraIdVenda = $stmtProcuraIdVenda->fetch(PDO::FETCH_ASSOC);
      $id_venda = $rowProcuraIdVenda['id_venda'];


      $stmtProcuraIdVenda = $this->conn->prepare("SELECT id_venda FROM vendas WHERE id_venda = :id_venda");
      $stmtProcuraIdVenda->bindParam(':id_venda', $id_venda);
      $stmtProcuraIdVenda->execute();


      if ($stmtProcuraIdVenda->rowCount() > 0) {

        $stmtUpdateStatus = $this->conn->prepare("UPDATE vendas SET status = :status, data_pagamento = :dataPaga  WHERE id_venda = :id_venda");
        $stmtUpdateStatus->bindParam(':status', $status);
        $stmtUpdateStatus->bindParam(':id_venda', $id_venda);
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
