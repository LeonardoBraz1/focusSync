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
        <button onclick="btnInserirUsuario()" style="background-color: #337ab7; border: #337ab7; border-radius: 5px; color: #fff; padding: 7px 18px;"><i style="margin-right: 5px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i> NOVO USUÁRIO</button>
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
                                        <th>Ativo</th>
                                        <th>Senha</th>
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
                                            echo '<tr style="display: none;" class="tabela1load">
                                                <td style="display: none;">' . $row['id'] . '</td>
                                                <td>' . $row['nome'] . '</td>
                                                <td>' . $row['email'] . '</td>
                                                <td>' . $row['nome_nivel'] . '</td>
                                                <td>' . $row['ativo'] . '</td>
                                                <td>' . $row['senha'] . '</td>
                                                <td style="display: flex; justify-content: center; align-item: center; gap: 5px;">
                                                    <label style="cursor: pointer;" for="btnEditarUser-' . $row['id'] . '"><i title="Editar" class="icon fa fa-solid fa-edit fa-lg" style="color: #023ea7;"></i></label>
                                                    <input style="display: none;" type="button" class="btnEditarUser"  onclick="editarUsuario(' . $row['id'] . ', \'' . $row['nome'] . '\', \'' . $row['email'] . '\', \'' . $row['id_nivel'] . '\', \'' . $row['ativo'] . '\', \'' . $row['senha'] . '\')" id="btnEditarUser-' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnDeletarUser-' . $row['id'] . '"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
                                                    <input style="display: none;" type="button" onclick="deletarUsuario(' . $row['id'] . ')" id="btnDeletarUser-' . $row['id'] . '">
                                                    <label style="cursor: pointer;" for="btnCadUser-' . $row['id'] . '"><i class="fa fa-duotone fa-lock fa-lg" style="--fa-primary-color: #12161c; --fa-secondary-color: #12213a;"></i></label>
                                                    <input style="display: none; pointer-events: none; opacity: 0;" type="button" class="btnCadUser1" id="btnCadUser-' . $row['id'] . '" data-id="' . $row['id'] . '">
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