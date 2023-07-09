<?php
@session_start();

require_once('../../controllers/session.php');
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

include('../../components/head.php');
?>
<link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

<body class="app sidebar-mini">
  <?php
  include('../../components/navbar.php');

  include('../../components/sidebar.php');
  ?>

  <main class="app-content">
    <div class="py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <img style="width: 40px; margin-top: 10px;" src="../../assets/images/contas.png" alt="">
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Contas a Paga Hoje</p>
                <h4 class="mb-0">$53k</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div style="background-color: #00FF7F;" class="icon icon-lg icon-shape  shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <img style="width: 40px; margin-top: 10px;" src="../../assets/images/faturamento.png" alt="">
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">R$ Faturamento da Semana</p>
                <h4 class="mb-0">R$ 2,300</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than lask month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-calendar fa-lg opacity-10" style="color: #000; font-size: 2.4em;"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Agendamentos Dia</p>
                <h4 class="mb-0">10</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <img style="width: 40px; margin-top: 10px;" src="../../assets/images/estoque-baixo.png" alt="">
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Produtos Estoque baixo</p>
                <h4 class="mb-0">$103,430</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6" style="width: 100%;">
        <div class="tile">
          <h3 class="tile-title" style="font-size: 1.3em;">Faturamento e Despesas Diárias</h3>
          <div style="height: 50vh;" class="embed-responsive embed-responsive-16by9">
            <canvas style="height: 50vh;" class="embed-responsive-item" id="lineChartDemo"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-6">
                <h3>$16,756</h3>
                <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
              </div>
              <div class="col-6">
                <div id="seo-chart1" class="d-flex align-items-end"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-6">
                <h3>49.54%</h3>
                <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
              </div>
              <div class="col-6">
                <div id="seo-chart2" class="d-flex align-items-end"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-6">
                <h3>1,62,564</h3>
                <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
              </div>
              <div class="col-6">
                <div id="seo-chart3" class="d-flex align-items-end"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- Essential javascripts for application to work-->
  <script src="../../assets/js/jquery-3.3.1.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/plugins/dashboard-main.js"></script>
  <script src="../../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../../assets/js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script type="text/javascript" src="../../assets/js/plugins/chart.js"></script>
</body>

</html>