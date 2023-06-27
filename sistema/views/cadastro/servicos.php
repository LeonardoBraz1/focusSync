<?php
@session_start();

require_once('../../controllers/session.php');
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

include('../../components/head.php');
?>

</style>

<body class="app sidebar-mini">
    <?php
    include('../../components/navbar.php');

    include('../../components/sidebar.php');
    ?>
    <main class="app-content">
        <button onclick="btnInserirServico()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO SERVIÇO</button>
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
                                        <th>Preço</th>
                                        <th>Comissão</th>
                                        <th>Tempo</th>
                                        <th>Cadastro</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM servicos_barbearia WHERE id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['data']));
                                            echo '<tr>
                                                <td style="display: none;">' . $row['id_servico'] . '</td>
                                                <td>' . $row['nome_servico'] . '</td>
                                                <td>R$ ' . $row['preco'] . '</td>
                                                <td>' . $row['comissao'] . '%</td>
                                                <td>' . $row['tempo'] . ' Minutos</td>
                                                <td>' . $formattedDate . '</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                    <label style="cursor: pointer;" for="btnEditarServico-' . $row['id_servico'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarServico1"  onclick="editarServico(' . $row['id_servico'] . ', \'' . $row['nome_servico'] . '\', \'' . $row['preco'] . '\', \'' . $row['comissao'] . '\', \'' . $row['tempo'] . '\')" id="btnEditarServico-' . $row['id_servico'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarServico-' . $row['id_servico'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarServico(' . $row['id_servico'] . ')" id="btnDeletarServico-' . $row['id_servico'] . '">
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