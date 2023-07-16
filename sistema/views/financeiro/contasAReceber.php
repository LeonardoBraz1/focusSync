<?php

@session_start();

require_once('../../controllers/session.php');
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

include('../../components/head.php');
?>

<style>
    .status-pendente {
        background-color: blue;
        color: #fafcff;
    }

    .status-aprovada {
        background-color: #00EE76;
    }

    .status-cancelada {
        background-color: red;
        color: #fafcff;
    }


    .statusCor {
        padding: 2px 10px;
        font-weight: bold;
        border-radius: 8px;
    }
</style>

<body class="app sidebar-mini">
    <?php
    include('../../components/navbar.php');

    include('../../components/sidebar.php');
    ?>


    <main class="app-content">
        <button onclick="btnInserirContaR()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><img style="width: 30px; margin-left: -10px; margin-right: 7px;" src="../../assets/images/icons/icon_venda.png" alt="icon compra"> NOVA CONTA</button>
        <div style="display: flex; justify-content: center; align-items: center; margin: 20px 0 -13px 0;">
            <input id="startDate1" style="border-radius: 6px;" type="date">
            <input id="endDate1" style="border-radius: 6px;" type="date">
        </div>
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
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Data do Pagamento</th>
                                        <th>Cliente</th>
                                        <th>Cadastro</th>
                                        <th>Status</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody id="ContasAReceberTableBody" style="position: relative;">
                                    <div id="loadingIndicator14" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
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

    <?php include('../modals/modal-financeiro.php'); ?>

    <!-- Essential javascripts for application to work-->
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/plugins/pace.min.js"></script>

    <script type="text/javascript" src="../../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="../../assets/js/scripts/financeiro/editar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/financeiro/deletar.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/financeiro/inserir.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/financeiro/verDados.js"></script>
    <script type="text/javascript" src="../../assets/js/scripts/financeiro/tabelas/tabelaContasAReceber.js"></script>

</body>

</html>