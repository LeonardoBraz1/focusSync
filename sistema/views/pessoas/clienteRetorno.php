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
                                        <th>Telefone</th>
                                        <th>Cadastro</th>
                                        <th>ultimo_servico</th>
                                        <th>Retorno</th>
                                        <th>Dias sem Retorno</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT c.id_cliente, c.nome_cliente, c.telefone_cliente, c.cadastro, c.retorno, su.nome_servico AS ultimo_servico
                                                                FROM clientes c
                                                                LEFT JOIN (
                                                                SELECT id_cliente, MAX(su.data) AS data, sb.nome_servico
                                                                FROM servicos_usuarios su
                                                                JOIN servicos_barbearia sb ON su.id_servico = sb.id_servico
                                                                WHERE sb.id_barbearia = :barbearia_id
                                                                GROUP BY id_cliente
                                                                ) su ON c.id_cliente = su.id_cliente
                                                                WHERE c.retorno < DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND c.id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['retorno']));
                                            $formattedDate1 = date('Y-m-d', strtotime($row['cadastro']));
                                            // Cálculo dos dias sem retorno
                                            $retorno = new DateTime($row['retorno']);
                                            $hoje = new DateTime();
                                            $intervalo = $retorno->diff($hoje);
                                            $dias_sem_retorno = $intervalo->days;

                                            $ultimo_servico = isset($row['ultimo_servico']) ? $row['ultimo_servico'] : '-';

                                            echo '<tr>
                                                  <td style="display: none;">' . $row['id_cliente'] . '</td>
                                                  <td>' . $row['nome_cliente'] . '</td>
                                                  <td>' . $row['telefone_cliente'] . '</td>
                                                  <td>' . $formattedDate1 . '</td>
                                                  <td>' . $ultimo_servico . '</td>
                                                  <td>' . $formattedDate . '</td>
                                                  <td>' . $dias_sem_retorno . '</td>
                                                  <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                  <label style="cursor: pointer;" for="btnWhat-' . $row['id_cliente'] . '"><i class="fa fa-brands fa-whatsapp fa-lg" style="color: #7dd90d;"></i></label>
                                                  <input style="display: none; pointer-events: none; opacity: 0;" onclick="redirectToWhatsApp(' . $row['id_cliente'] . ')" type="button" class="btnWhat" id="btnWhat-' . $row['id_cliente'] . '" data-id="' . $row['id_cliente'] . '">
                                                  </td>
                                                  </tr>';
                                        }
                                    } catch (PDOException $e) {
                                        echo "Erro: ";
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
    <script src="../assets/js/plugins/pace.min.js"></script>
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
    <!-- Google analytics script-->
    <script type="text/javascript">
        if (document.location.hostname == "pratikborsadiya.in") {
            (function(i, s, o, g, r, a, m) {
                i["GoogleAnalyticsObject"] = r;
                (i[r] =
                    i[r] ||
                    function() {
                        (i[r].q = i[r].q || []).push(arguments);
                    }),
                (i[r].l = 1 * new Date());
                (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m);
            })(
                window,
                document,
                "script",
                "//www.google-analytics.com/analytics.js",
                "ga"
            );
            ga("create", "UA-72504830-1", "auto");
            ga("send", "pageview");
        }
    </script>
</body>

</html>