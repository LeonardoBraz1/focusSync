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
    <link rel="stylesheet" href="css/style.css">

    <main class="app-content" style="display: flex;">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="elegant-calencar d-md-flex">
                        <div class="wrap-header d-flex align-items-center img" style="background-image: url(bg.jpg);">
                            <p id="reset">HOJE</p>
                            <div id="header" class="p-0">
                                <!-- <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div> -->
                                <div class="head-info">
                                    <div class="head-month"></div>
                                    <div class="head-day"></div>
                                </div>
                                <!-- <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div> -->
                            </div>
                        </div>
                        <div class="calendar-wrap">
                            <div class="w-100 button-wrap">
                                <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                                <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                            </div>
                            <table id="calendar">
                                <thead>
                                    <tr>
                                        <th>Dom</th>
                                        <th>Seg</th>
                                        <th>Ter</th>
                                        <th>Qua</th>
                                        <th>Qui</th>
                                        <th>Sex</th>
                                        <th>Sáb</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row col-md-8">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- CREATE TABLE agenda (
    id_agenda INT AUTO_INCREMENT PRIMARY KEY,
    data_cadastro DATEtime,
    data_agendamento DATEtime,
    hora_agendamento TIME,
    id_cliente int,
    id_usuario INT,
    id_barbearia INT,
    id_servico int,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_barbearia) REFERENCES barbearias(id_barbearia),
    FOREIGN KEY (id_servico) REFERENCES servicos_barbearia(id_servico),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
); -->

    <?php include('../modals/modal-financeiro.php'); ?>
    <script src="js/main.js"></script>
    <!-- Essential javascripts for application to work-->
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/dataTables.bootstrap.min.js"></script>

</body>

</html>