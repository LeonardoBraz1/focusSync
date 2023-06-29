<?php
@session_start();

require_once('../../controllers/session.php');
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

include('../../components/head.php');
?>

<body class="app sidebar-mini">
    <?php
    include('../../components/navbar.php');

    include('../../components/sidebar.php');
    ?>
    <main class="app-content">
        <button onclick="btnInserirProduto()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO PRODUTO</button>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">id</th>
                                        <th>Nome</th>
                                        <th>Valor Compra</th>
                                        <th>Valor Venda</th>
                                        <th>Estoque</th>
                                        <th>Validade</th>
                                        <th>Alerta Estoque</th>
                                        <th>Cadastro</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT produtos.*, fornecedores.nome_fornecedo, fornecedores.id_fornecedo FROM produtos left JOIN fornecedores ON produtos.id_fornecedor = fornecedores.id_fornecedo WHERE produtos.id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['cadastro']));
                                            $imagemBase64 = isset($row['imagem']) ? base64_encode($row['imagem']) : '';
                                            $imagemSrc = $imagemBase64 !== '' ? 'data:image/jpeg;base64,' . $imagemBase64 : '../../assets/images/sem-foto.jpg';

                                            // Verificar se o estoque está abaixo do alerta_estoque
                                            $estoque = $row['estoque'];
                                            $alertaEstoque = $row['alerta_estoque'];
                                            $corTexto = $estoque < $alertaEstoque ? 'color: red;' : '';

                                            echo '<tr style="display: none;' . $corTexto . '" class="tabela1load">
                                                  <td style="display: none;">' . $row['id_pro'] . '</td>
                                                  <td><img src="' . $imagemSrc . '" alt="Imagem do Produto" style="max-width: 30px;">' . $row['nome_pro'] . '</td>
                                                  <td>R$ ' . $row['valor_compra'] . '</td>
                                                  <td>R$ ' . $row['valor_venda'] . '</td>
                                                  <td>' . $estoque . '</td>
                                                  <td>' . $row['validade'] . '</td>
                                                  <td>' . $row['alerta_estoque'] . '</td>
                                                  <td>' . $formattedDate . '</td>
                                                  <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                  <label style="cursor: pointer;" for="btnEditarProduto-' . $row['id_pro'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                  <input style="display: none;" type="button" class="btnEditarProduto"  onclick="editarProduto(' . $row['id_pro'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['valor_compra'] . '\', \'' . $row['valor_venda'] . '\', \'' . $estoque . '\', \'' . $row['validade'] . '\', \'' . $alertaEstoque . '\', \'' . $row['descricao'] . '\', \'' . 'data:image/jpeg;base64,' . base64_encode($row['imagem']) . '\', \'' . $row['id_fornecedo'] . '\')" id="btnEditarProduto-' . $row['id_pro'] . '">
                                                  <label style="cursor: pointer;" for="btnDeletarProduto-' . $row['id_pro'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                  <input style="display: none;" type="button" onclick="deletarProduto(' . $row['id_pro'] . ')" id="btnDeletarProduto-' . $row['id_pro'] . '">
                                                  <label style="cursor: pointer;" for="btnSaidaProduto-' . $row['id_pro'] . '"><i title="Saída de Produto" class="fa fa-solid fa-share fa-lg" style="color: #c30404;"></i></label>
                                                  <input style="display: none;" type="button" class="btnSaidaProduto"  onclick="SaidaProduto(' . $row['id_pro'] . ', \'' . $row['nome_pro'] . '\')" id="btnSaidaProduto-' . $row['id_pro'] . '">
                                                  <label style="cursor: pointer;" for="btnEntradaProduto-' . $row['id_pro'] . '"><i title="Entrada de Produto" class="fa fa-solid fa-reply fa-lg" style="color: #5c6370;"></i></label>
                                                  <input style="display: none;" type="button" class="btnEntradaProduto"  onclick="entradaProduto(' . $row['id_pro'] . ', \'' . $row['nome_pro'] . '\', \'' . $row['id_fornecedo'] . '\')" id="btnEntradaProduto-' . $row['id_pro'] . '">
                                                  </td>
                                                  </tr>';
                                        }
                                    } catch (PDOException $e) {
                                        echo "Erro:";
                                    }
                                    $conn = null;
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('../modals/modal-Cadastro.php'); ?>

    <!-- Essential javascripts for application to work-->
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../../assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="../../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#sampleTable").DataTable();
    </script>
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/editar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/deletar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/inserir.js"></script>
</body>

</html>