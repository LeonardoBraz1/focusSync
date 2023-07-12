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
        <button onclick="btnInserirCargo()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO SERVIÇO</button>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table  data-order='[[ 0, "desc" ]]' class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">id</th>
                                        <th>Nome</th>
                                        <th>Cadastro</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody id="cargosTableBody">
                                   
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
    <script type="text/javascript" src="../../assets/js/scripts/cadastro/tabelas/tabelaCargos.js"></script>
    
</body>

</html>