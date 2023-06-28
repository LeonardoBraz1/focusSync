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
        <button onclick="btnInserirFuncionario()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO FUNCIONÁRIO</button>
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
                                        <th>Cargo</th>
                                        <th>CPF</th>
                                        <th>Cadastro</th>
                                        <th>Comissão</th>
                                        <th>Acões</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT usuarios.*, niveis_usuarios.nome_nivel FROM usuarios INNER JOIN niveis_usuarios ON usuarios.id_nivel = niveis_usuarios.id_nivel WHERE usuarios.id_barbearia = :barbearia_id");
                                        $stmt->bindParam(':barbearia_id', $_SESSION["barbearia_id"]);
                                        $stmt->execute();

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $formattedDate = date('Y-m-d', strtotime($row['cadastro']));
                                            $formattedPhone = str_replace(array('(', ')', '-'), '', $row['telefone']);

                                            $message = "Olá, estou entrando em contato através da sua barbearia.";
                                            
                                            echo '<tr style="display: none;" class="tabela1load">
                                                <td style="display: none;">' . $row['id'] . '</td>
                                                <td>' . $row['nome'] . '</td>
                                                <td>' . $row['email'] . '</td>
                                                <td>' . $row['nome_nivel'] . '</td>
                                                <td>' . $row['cpf'] . '</td>
                                                <td>' . $formattedDate . '</td>
                                                <td>' . $row['comissao'] . '%</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 7px;">
                                                    <label style="cursor: pointer;" for="btnEditarFunc-' . $row['id'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarFunc"  onclick="editarFuncionario(' . $row['id'] . ', \'' . $row['nome'] . '\', \'' . $row['email'] . '\', \'' . $row['id_nivel'] . '\', \'' . $row['cpf'] . '\', \'' . $row['comissao'] . '\', \'' . $row['atendimento'] . '\', \'' . $row['endereco'] . '\', \'' . $row['cidade'] . '\', \'' . $row['tipoPix'] . '\', \'' . $row['pix'] . '\')" id="btnEditarFunc-' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarFunc-' . $row['id'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarFuncionario(' . $row['id'] . ')" id="btnDeletarFunc-' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnDiaFunc-' . $row['id'] . '"><i class="fa fa-solid fa-calendar fa-lg" style="color: #6a81a9;"></i></label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" type="button" onclick="btnInserirDiaSemana(' . $row['id'] . ')" class="btnDiaFunc1" id="btnDiaFunc-' . $row['id'] . '" data-id="' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnServFunc-' . $row['id'] . '"> 
                                                    <a href="https://api.whatsapp.com/send?phone=' . $formattedPhone . '&text=' . urlencode($message) . '" target="_blank">
                                                        <i class="fa fa-brands fa-whatsapp fa-lg" style="color: #7dd90d;"></i>
                                                    </a></label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" onclick="redirectToWhatsApp(' . $row['id'] . ')" type="button" class="btnWhat" id="btnWhat-' . $row['id'] . '" data-id="' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnServFunc-' . $row['id'] . '"><i class="fa fa-solid fa-briefcase fa-lg" style="color: #334a70;"></i></label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" onclick="btnInserirServ(' . $row['id'] . ')" type="button" class="btnServFunc1" id="btnServFunc-' . $row['id'] . '" data-id="' . $row['id'] . '">
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