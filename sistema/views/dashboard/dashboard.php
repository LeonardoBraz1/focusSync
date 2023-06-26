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
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="../../assets/js/jquery-3.3.1.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="../../assets/js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script type="text/javascript" src="../../assets/js/plugins/chart.js"></script>
  <script type="text/javascript">
    var data = {
      labels: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
      datasets: [{
          label: "Serviços",
          fillColor: "rgba(36, 217, 179, 0.3)",
          strokeColor: "#24d9b3",
          pointColor: "#24d9b3",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#24d9b3",
          data: [200, 400, 100, 350, 100, 300, 400]
        },
        {
          label: "Vendas",
          fillColor: "rgba(	255, 56, 64,0.3)",
          strokeColor: "rgba(	255, 56, 64)",
          pointColor: "rgba(	255, 56, 64)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(	255, 56, 64)",
          data: [80, 90, 90, 850, 100, 90, 90]
        },
        {
          label: "Despesas",
          fillColor: "rgba(	255, 56, 64,0.3)",
          strokeColor: "rgba(	255, 56, 64)",
          pointColor: "rgba(	255, 56, 64)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(	255, 56, 64)",
          data: [20, 56, 79, 500, 100, 95, 99]
        }
      ]
    };

    var options = {
      responsive: true,
      scaleBeginAtZero: true,
      scaleLabel: "<%= value%>",
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleGridLineWidth: 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      bezierCurve: true,
      bezierCurveTension: 0.4,
      pointDot: true,
      pointDotRadius: 4,
      pointDotStrokeWidth: 1,
      pointHitDetectionRadius: 20,
      datasetStroke: true,
      datasetStrokeWidth: 2,
      datasetFill: true,
      tooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>",
      multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>",
      multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>"
    };

    var ctx = document.getElementById("lineChartDemo").getContext("2d");
    var lineChart = new Chart(ctx).Line(data, options);

    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>

</html>