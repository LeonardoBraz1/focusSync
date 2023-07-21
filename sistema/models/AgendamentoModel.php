<?php
require_once 'conexao.php';
class ContasAPagarModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = Conexao::getInstance();
  }

  public function obterContas($startDate1, $endDate1, $id_barbearia)
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

      $stmt = $this->conn->prepare("SELECT agenda.*, usuarios.nome, usuarios.comissao, clientes.nome_cliente, servicos_barbearia.* FROM agenda LEFT JOIN usuarios ON agenda.id_usuario = usuarios.id LEFT JOIN clientes ON agenda.id_clienter = clientes.id_cliente LEFT JOIN servicos_barbearia ON agenda.id_servico = servicos_barbearia.id_servico WHERE agenda.id_barbearia = :barbearia_id AND agenda.data_conta >= :startDate1 AND agenda.data_conta <= :endDate1");
      $stmt->bindParam(':startDate1', $startDate1);
      $stmt->bindParam(':endDate1', $endDate1);
    } else {
      $stmt = $this->conn->prepare("SELECT agenda.*, usuarios.nome, usuarios.comissao, clientes.nome_cliente, servicos_barbearia.* FROM agenda LEFT JOIN usuarios ON agenda.id_usuario = usuarios.id LEFT JOIN clientes ON agenda.id_clienter = clientes.id_cliente LEFT JOIN servicos_barbearia ON agenda.id_servico = servicos_barbearia.id_servico  WHERE agenda.id_barbearia = :barbearia_id");
    }

    $stmt->bindParam(':barbearia_id', $id_barbearia);
    $stmt->execute();

    $result = '';

    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $formattedDate = date('Y-m-d', strtotime($row['data_cadastro']));
        $data_pagamento = $row['data_pagamento'] ? date('Y-m-d', strtotime($row['data_pagamento'])) : '';

        $result .= '<tr>
                    <td style="display: none; font: 1em sans-serif;">' . $row['id_agenda'] . '</td>
                    <td ><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i> ' . $row['nome_servico'] . '</td>
                    <td>R$ ' . $row['preco'] . '</td>
                    <td>' . $data_pagamento . '</td>
                    <td>' . $row['nome_cliente'] . '</td>
                    <td>' . $row['hora_agendamento'] . '</td>
                    <td>' . $row['nome_usuario'] . '</td>
                    <td>' . $formattedDate . '</td>
                    <td><span class="' . getStatusClass($row['status']) . ' statusCor">' . $row['status'] . '</span></td>                  
                    <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                    <label style="cursor: pointer;" for="btnVerAgendamento-' . $row['id_agenda'] . '"><i title="Ver Dados" class="icon fa fa-eye fa-lg" style="color: #023ea7;"></i></label>
                    <input style="display: none;" type="button" class="btnVerAgendamento"  onclick="verAgendamentosAPagar(' . $row['id_agenda'] . ', \'' . $row['nome_servico'] . '\', \'' . $row['preco'] . '\', \'' .  $data_pagamento  . '\', \'' . $row['nome_cliente'] . '\', \'' . $row['hora_agendamento'] . '\', \'' . $row['nome_usuario'] . '\', \'' . date('Y-m-d', strtotime($row['data_cadastro'])) . '\', \'' . $row['status'] . '\')" id="btnVerAgendamento-' . $row['id_agenda'] . '">
                    <label style="cursor: pointer;" for="btnDeletarAgendamento-' . $row['id_agenda'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarAgendamentoPagar(' . $row['id_agenda'] . ')" id="btnDeletarAgendamento-' . $row['id_agenda'] . '">
                    <label style="cursor: pointer;" for="btnStatusAgendamento-' . $row['id_agenda'] . '"><i title="Trocar Status" class="fa fa-check-square-o fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="statusAgendamento(' . $row['id_agenda'] . ', \'' . $row['status'] . '\')" id="btnStatusAgendamento-' . $row['id_agenda'] . '">
                    </td>
                  </tr>';
      }
    }

    return $result;
  }


  public function deletarContaAPagar($id_agenda)
  {

    $stmt = $this->conn->prepare("DELETE FROM contas_a_pagar WHERE id_agenda = :id_conta");
    $stmt->bindParam(':id_conta', $id_agenda);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = array("status" => "sucesso");
    } else {
      $response = array("status" => "erro");
    }

    return $response;
  }

  public function inserirContaAPagar($descricao, $id_fornecedo, $id_usuario, $valor, $dataPaga, $data_conta, $id_barbearia)
  {

    $stmt = $this->conn->prepare("INSERT INTO contas_a_pagar (descricao, id_fornecedor, id_usuario, valor, data_Pagamento, data_conta, id_barbearia, status) VALUES (:descricao, :id_fornecedo, :id_usuario, :valor, :dataPaga, :data_conta, :id_barbearia, " . ($dataPaga === null || $dataPaga > date('Y-m-d H:i:s') ? "'Pendente'" : "'Aprovada'") . ")");
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_fornecedo', $id_fornecedo);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':dataPaga', $dataPaga);
    $stmt->bindParam(':data_conta', $data_conta);
    $stmt->bindParam(':id_barbearia', $id_barbearia);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
      $response = array("status" => "sucesso");
    } else {
      $response = array("status" => "erro");
    }

    return $response;
  }
  public function editarStatus($id_conta, $status, $dataPaga)
  {
    $stmt = $this->conn->prepare("UPDATE contas_a_pagar SET status = :status, data_pagamento = :dataPaga  WHERE id_conta = :id_conta");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id_conta', $id_conta);
    $stmt->bindParam(':dataPaga', $dataPaga);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $stmtProcuraIdCompra = $this->conn->prepare("SELECT id_compra FROM contas_a_pagar where id_conta = :id_conta");
      $stmtProcuraIdCompra->bindParam(':id_conta', $id_conta);
      $stmtProcuraIdCompra->execute();
      $rowProcuraIdCompra = $stmtProcuraIdCompra->fetch(PDO::FETCH_ASSOC);
      $id_compra = $rowProcuraIdCompra['id_compra'];


      $stmtProcuraIdCompra = $this->conn->prepare("SELECT id_compra FROM compras WHERE id_compra = :id_compra");
      $stmtProcuraIdCompra->bindParam(':id_compra', $id_compra);
      $stmtProcuraIdCompra->execute();


      if ($stmtProcuraIdCompra->rowCount() > 0) {

        $stmtUpdateStatus = $this->conn->prepare("UPDATE compras SET status = :status, data_pagamento = :dataPaga  WHERE id_compra = :id_compra");
        $stmtUpdateStatus->bindParam(':status', $status);
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
