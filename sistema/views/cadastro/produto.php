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
        <button onclick="btnInserirProduto()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO SERVIÇO</button>
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
                                        <th>Cadastro</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM niveis_usuarios WHERE id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['data']));
                                            echo '<tr>
                                                <td style="display: none;">' . $row['id_nivel'] . '</td>
                                                <td>' . $row['nome_nivel'] . '</td>
                                                <td>' . $formattedDate . '</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                    <label style="cursor: pointer;" for="btnEditarProduto-' . $row['id_servico'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarProduto"  onclick="editarProduto(' . $row['id_servico'] . ', \'' . $row['nome_servico'] . '\', \'' . $row['preco'] . '\', \'' . $row['comissao'] . '\', \'' . $row['tempo'] . '\')" id="btnEditarServico-' . $row['id_servico'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarProduto-' . $row['id_nivel'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarProduto(' . $row['id_nivel'] . ')" id="btnDeletarProduto-' . $row['id_nivel'] . '">
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