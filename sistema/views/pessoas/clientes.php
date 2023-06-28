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
        <button onclick="btnInserirCliente()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO CLIENTE</button>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table id="sampleTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="display: none;">id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Cadastro</th>
                                        <th>Retorno</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM clientes WHERE id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['cadastro']));
                                            $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone_cliente']);

                                            $message = "Olá! Gostaríamos de agradecer pela sua preferência. Estamos entrando em contato para informar sobre nossos serviços de alta qualidade, profissionais especializados e um ambiente aconchegante para cuidar do seu visual. Ficamos à disposição para agendar um horário ou responder a qualquer dúvida que você possa ter. Agradecemos novamente pela confiança e esperamos vê-lo em breve na nossa barbearia. Tenha um ótimo dia!";
                                            echo '<tr style="display: none;" class="tabela1load">
                                                <td style="display: none;">' . $row['id_cliente'] . '</td>
                                                <td>' . $row['nome_cliente'] . '</td>
                                                <td>' . $row['email_cliente'] . '</td>
                                                <td>' . $row['telefone_cliente'] . '</td>
                                                <td>' . $formattedDate . '</td>
                                                <td>' . $row['retorno'] . '</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                    <label style="cursor: pointer;" for="btnEditarClien-' . $row['id_cliente'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarClien"  onclick="editarCliente(' . $row['id_cliente'] . ', \'' . $row['nome_cliente'] . '\', \'' . $row['email_cliente'] . '\', \'' . $row['telefone_cliente'] . '\')" id="btnEditarClien-' . $row['id_cliente'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarClien-' . $row['id_cliente'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarCliente(' . $row['id_cliente'] . ')" id="btnDeletarClien-' . $row['id_cliente'] . '">
                                                    <label style="cursor: pointer;" for="btnWhat-' . $row['id_cliente'] . '">
                                                    <a href="https://api.whatsapp.com/send?phone=' . $formattedPhone . '&text=' . urlencode($message) . '" target="_blank">
                                                        <i class="fa fa-brands fa-whatsapp fa-lg" style="color: #7dd90d;"></i>
                                                    </a></label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" onclick="redirectToWhatsApp(' . $row['id_cliente'] . ')" type="button" class="btnWhat" id="btnWhat-' . $row['id_cliente'] . '" data-id="' . $row['id_cliente'] . '">
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