<?php
require_once 'conexao.php';
class ComissaoModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = Conexao::getInstance();
  }

  public function obterComissao($startDate1, $endDate1, $id_barbearia)
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

      $stmt = $this->conn->prepare("SELECT contas_a_pagar.*, usuarios.nome FROM contas_a_pagar LEFT JOIN usuarios ON contas_a_pagar.id_usuario = usuarios.id WHERE contas_a_pagar.id_barbearia = :barbearia_id AND contas_a_pagar.data_conta >= :startDate1 AND contas_a_pagar.data_conta <= :endDate1 AND contas_a_pagar.descricao LIKE 'Comissão%'");
      $stmt->bindParam(':startDate1', $startDate1);
      $stmt->bindParam(':endDate1', $endDate1);
    } else {
      $stmt = $this->conn->prepare("SELECT contas_a_pagar.*, usuarios.nome FROM contas_a_pagar LEFT JOIN usuarios ON contas_a_pagar.id_usuario = usuarios.id  WHERE contas_a_pagar.id_barbearia = :barbearia_id AND contas_a_pagar.descricao LIKE 'Comissão%'");
    }

    $stmt->bindParam(':barbearia_id', $id_barbearia);
    $stmt->execute();

    $result = '';

    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $formattedDate = date('Y-m-d', strtotime($row['data_conta']));
        $data_pagamento = $row['data_pagamento'] ? date('Y-m-d', strtotime($row['data_pagamento'])) : '';

        $result .= '<tr>
                    <td style="display: none; font: 1em sans-serif;">' . $row['id_conta'] . '</td>
                    <td ><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i> ' . $row['descricao'] . '</td>
                    <td>R$ ' . $row['valor'] . '</td>
                    <td>' . $data_pagamento . '</td>
                    <td>' . $row['nome'] . '</td>
                    <td>' . $formattedDate . '</td>
                    <td><span class="' . getStatusClass($row['status']) . ' statusCor">' . $row['status'] . '</span></td>                  
                    <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                    <label style="cursor: pointer;" for="btnVerComissao-' . $row['id_conta'] . '"><i title="Ver Dados" class="icon fa fa-eye fa-lg" style="color: #023ea7;"></i></label>
                    <input style="display: none;" type="button" class="btnVercomissao"  onclick="verComissao(' . $row['id_conta'] . ', \'' . $row['descricao'] . '\', \'' . $row['valor'] . '\', \'' .  $data_pagamento  . '\', \'' . $row['nome'] . '\', \'' . date('Y-m-d', strtotime($row['data_conta'])) . '\', \'' . $row['status'] . '\')" id="btnVerComissao-' . $row['id_conta'] . '">
                    </td>
                  </tr>';
      }
    }

    return $result;
  }

  public function __destruct()
  {
    $this->conn = null;
  }
}
