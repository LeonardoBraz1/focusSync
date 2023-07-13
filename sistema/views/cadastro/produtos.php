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
        <button onclick="btnInserirProduto()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><img style="width: 30px; margin-left: -10px; margin-right: 7px;" src="../../assets/images/icons/icon_pro.png" alt="icon compra"> NOVO PRODUTO</button>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table data-order='[[ 0, "desc" ]]' class="table table-hover table-bordered" id="sampleTable">
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
                                <tbody id="produtosTableBody" style="position: relative;">
                                    <div id="loadingIndicator6" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <div id="preloader-active">
                                            <div class="preloader d-flex align-items-center justify-content-center">
                                                <div class="preloader-inner position-relative">
                                                    <div style="background-color: #dfeaeb;" class="preloader-circle"></div>
                                                    <div class="preloader-img pere-text">
                                                        <img src="../../assets/images/logo-login.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/verDados.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/tabelas/tabelaProdutos.js"></script>
</body>

</html>