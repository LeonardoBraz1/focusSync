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
        $stmt = $this->conn->prepare("SELECT vendas.*, produtos.nome_pro, produtos.imagem, produtos.valor_venda, usuarios.nome, clientes.nome_cliente FROM vendas LEFT JOIN produtos ON vendas.id_pro = produtos.id_pro LEFT JOIN usuarios ON vendas.id_usuario = usuarios.id LEFT JOIN clientes ON vendas.id_cliente = clientes.id_cliente WHERE vendas.id_barbearia = :barbearia_id");
        $stmt->bindParam(':barbearia_id', $id_barbearia);
        $stmt->execute();
    
        $result = '';
    
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $formattedDate = date('Y-m-d', strtotime($row['data_venda']));
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
                  <td>' . $row['status'] . '</td>
                  <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
                  <label style="cursor: pointer;" for="btnEditarVenda-' . $row['id_venda'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                  <input style="display: none;" type="button" class="btnEditarProduto"  onclick="editarVenda(' . $row['id_venda'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['valor_venda'] . '\', \'' . $row['quantidade'] . '\', \'' . $row['valor_total'] . '\', \'' . $row['data_venda'] . '\', \'' . $row['data_pagamento'] . '\', \'' . $row['numero_fatura'] . '\', \'' . $row['nome'] . '\', \'' . $row['forma_pagamento'] . '\', \'' . $row['status'] . '\', \'' . $imagemSrc . '\')" id="btnEditarProduto-' . $row['id_pro'] . '">
                    <label style="cursor: pointer;" for="btnDeletarVenda-' . $row['id_venda'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                    <input style="display: none;" type="button" onclick="deletarVenda(' . $row['id_venda'] . ')" id="btnDeletarVenda-' . $row['id_venda'] . '">
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
}
