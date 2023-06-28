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
        <button onclick="btnInserirFornecedor()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO FORNECEDOR</button>
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
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Pontuacão</th>
                                        <th>Cadastro</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT * from fornecedores WHERE id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['data_cadastro']));
                                            $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone_fornecedo']);

                                            $message = "Olá, estou entrando em contato através da sua barbearia.";

                                            echo '<tr style="display: none;" class="tabela1load">
                                                <td style="display: none;">' . $row['id_fornecedo'] . '</td>
                                                <td>' . $row['nome_fornecedo'] . '</td>
                                                <td>' . $row['email_fornecedo'] . '</td>
                                                <td>' . $row['telefone_fornecedo'] . '</td>
                                                <td>' . $row['pontuacao_fornecedo'] . '</td>
                                                <td>' . $formattedDate . '</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                    <label style="cursor: pointer;" for="btnEditarForne-' . $row['id_fornecedo'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarForne"  onclick="editarFornecedor(' . $row['id_fornecedo'] . ', \'' . $row['nome_fornecedo'] . '\', \'' . $row['email_fornecedo'] . '\', \'' . $row['telefone_fornecedo'] . '\', \'' . $row['pontuacao_fornecedo'] . '\', \'' . $row['endereco_fornecedo'] . '\', \'' . $row['cidade_fornecedo'] . '\', \'' . $row['site_fornecedo'] . '\')" id="btnEditarForne-' . $row['id_fornecedo'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarForne-' . $row['id_fornecedo'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarFornecedor(' . $row['id_fornecedo'] . ')" id="btnDeletarForne-' . $row['id_fornecedo'] . '">
                                                    <input style="display: none;" type="button" onclick="deletarFornecedor(' . $row['id_fornecedo'] . ')" id="btnDeletarForne-' . $row['id_fornecedo'] . '">
                                                    <label style="cursor: pointer;" for="btnWhat1-' . $row['id_fornecedo'] . '">
                                                   <a href="https://api.whatsapp.com/send?phone=' . $formattedPhone . '&text=' . urlencode($message) . '" target="_blank">
                                                            <i class="fa fa-brands fa-whatsapp fa-lg" style="color: #7dd90d;"></i>
                                                        </a>
                                                    </label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" onclick="redirectToWhatsApp(' . $row['id_fornecedo'] . ')" type="button" class="btnWhat" id="btnWhat-' . $row['id_fornecedo'] . '" data-id="' . $row['id_fornecedo'] . '">
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


    <?php include('../modals/modal-Pessoas.php'); ?>

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
    <script type="text/javascript" src="../../assets/js/scripts/pessoas/editar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/pessoas/deletar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/pessoas/inserir.js"></script>
</body>

</html>