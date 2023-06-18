<?php
require_once('../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

$query = $conn->prepare("SELECT DISTINCT nome_nivel, id_nivel FROM niveis_usuarios where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Armazenar os dados em um array
$nivels = array();
foreach ($result as $row) {
    $nivels[] = $row;
}



$query = $conn->prepare("SELECT id_servico, nome_servico FROM servicos_barbearia where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Armazenar os dados em um array
$servicos = array();
foreach ($result as $row) {
    $servicos[] = $row;
}


?>

<!-- Modal de Edição user -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de edição -->
                <form id="formEditarUsuario">
                    <!-- Campos de edição -->
                    <input type="hidden" id="editUsuarioId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editUsuarioNome">Nome:</label>
                            <input type="text" class="form-control" id="editUsuarioNome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editUsuarioEmail">Email:</label>
                            <input type="email" class="form-control" id="editUsuarioEmail" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editUsuarioAti">Ativo:</label>
                            <select id="editUsuarioAti" class="form-control">
                                <option selected>Sim</option>
                                <option>Não</option>|
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editUsuarioNivel">Cargo:</label>
                            <select id="editUsuarioNivel" class="form-control">
                                <?php
                                foreach ($nivels as $nivel) {
                                    echo '<option value="' . $nivel['id_nivel'] . '">' . $nivel['nome_nivel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editUsuarioSenha">Senha:</label>
                        <input type="text" class="form-control" id="editUsuarioSenha" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoUsuario()">Salvar</button>
            </div>
        </div>
    </div>
</div>






<!-- Modal de Edição func -->
<div class="modal fade" id="modalEditarFuncionario" tabindex="-1" role="dialog" aria-labelledby="modalEditarFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarFuncionarioLabel">Editar Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de edição -->
                <form id="formEditarFuncionario">
                    <!-- Campos de edição -->
                    <input type="hidden" id="editFuncionarioId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioEmail">Email:</label>
                            <input type="email" class="form-control" id="editFuncionarioEmail" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioNome">Nome:</label>
                            <input type="text" class="form-control" id="editFuncionarioNome" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioNivel">Cargo:</label>
                            <select id="editFuncionarioNivel" class="form-control">
                                <?php
                                foreach ($nivels as $nivel) {
                                    echo '<option value="' . $nivel['id_nivel'] . '">' . $nivel['nome_nivel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioCpf">CPF:</label>
                            <input type="text" class="form-control" id="editFuncionarioCpf" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioCom">Comissão:</label>
                            <input type="text" class="form-control" id="editFuncionarioCom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioAten">Atendimento:</label>
                            <select id="editFuncionarioAten" class="form-control">
                                <option>Sim</option>
                                <option>Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioEnd">Endereço:</label>
                            <input type="text" class="form-control" id="editFuncionarioEnd" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioCid">Cidade:</label>
                            <input type="text" class="form-control" id="editFuncionarioCid" required>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="editFuncionarioTipo">Tipo do Pix:</label>
                            <select id="editFuncionarioTipo" class="form-control">
                                <option>Telefone</option>
                                <option>CPF</option>
                                <option>Email</option>
                                <option>Chave Aleatória</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioPix">Pix:</label>
                            <input type="text" class="form-control" id="editFuncionarioPix" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoFuncionario()">Salvar</button>
            </div>
        </div>
    </div>
</div>








<!-- Modal de inserir user -->
<div class="modal fade" id="modalInserirUsuario" tabindex="-1" role="dialog" aria-labelledby="modalInserirUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirUsuarioLabel">Inserir Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirUsuario">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoUsuarioNome">Nome:</label>
                            <input type="text" class="form-control nome-input-user" id="novoUsuarioNome" required>
                            <p class="error-message-user" id="nomeErrorUser"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoUsuarioEmail">Email:</label>
                            <input type="email" class="form-control email-input-user" id="novoUsuarioEmail" required>
                            <p class="error-message-user" id="emailErrorUser"></p>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoUsuarioAti">Ativo:</label>
                            <select id="novoUsuarioAti" class="form-control">
                                <option selected>Sim</option>
                                <option>Não</option>|
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoUsuarioNivel">Cargo:</label>
                            <select id="novoUsuarioNivel" class="form-control">
                                <?php
                                foreach ($nivels as $nivel) {
                                    echo '<option value="' . $nivel['id_nivel'] . '">' . $nivel['nome_nivel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novoUsuarioSenha">Senha:</label>
                        <input type="text" class="form-control" id="novoUsuarioSenha" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" id="submit-button-user" onclick="inserirUsuario()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de inserir func -->
<div class="modal fade" id="modalInserirFuncionario" tabindex="-1" role="dialog" aria-labelledby="modalInserirFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirFuncionarioLabel">Inserir Novo Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirFuncionario">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioNome">Nome:</label>
                            <input type="text" class="form-control nome-input-funcionario" id="novoFuncionarioNome" required>
                            <p class="error-message-funcionario" id="nomeErrorFuncionario"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioEmail">Email:</label>
                            <input type="email" class="form-control email-input-funcionario" id="novoFuncionarioEmail" required>
                            <p class="error-message-funcionario" id="emailErrorFuncionario"></p>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioNivel">Cargo:</label>
                            <select id="novoFuncionarioNivel" class="form-control">
                                <?php
                                foreach ($nivels as $nivel) {
                                    echo '<option value="' . $nivel['id_nivel'] . '">' . $nivel['nome_nivel'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioCpf">CPF:</label>
                            <input type="text" class="form-control" id="novoFuncionarioCpf" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioCom">Comissão:</label>
                            <input type="text" class="form-control" id="novoFuncionarioCom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioAten">Atendimento:</label>
                            <select id="novoFuncionarioAten" class="form-control">
                                <option>Sim</option>
                                <option>Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioEnd">Endereço:</label>
                            <input type="text" class="form-control" id="novoFuncionarioEnd" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioCid">Cidade:</label>
                            <input type="text" class="form-control" id="novoFuncionarioCid" required>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="novoFuncionarioTipo">Tipo do Pix:</label>
                            <select id="novoFuncionarioTipo" class="form-control">
                                <option>Telefone</option>
                                <option>CPF</option>
                                <option>Email</option>
                                <option>Chave Aleatória</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioPix">Pix:</label>
                            <input type="text" class="form-control" id="novoFuncionarioPix" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" id="submit-button-funcionario" onclick="inserirFuncionario()">Salvar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal de inserir dia semana -->

<div class="modal fade" id="modalInserirDiaSemana" tabindex="-1" role="dialog" aria-labelledby="modalInserirDiaSemanaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirDiaSemanaLabel">Inserir Novo Dia da Semana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <form id="formInserirDiaSemena">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="novoDiaSemana">Dia Semana</label>
                            <select id="novoDiaSemana" class="form-control">
                                <option selected>Segunda-Feira</option>
                                <option>Terça-Feira</option>
                                <option>Quarta-Feira</option>
                                <option>Quinta-Feira</option>
                                <option>Sexta-Feira</option>
                                <option>Sábado</option>
                                <option>Domingo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="margin-top: 29px;">
                            <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirDiaSemana()">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <table id="tabelaDiaSemana" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="display: none;">#</th>
                            <th scope="col">Dia da Semana</th>
                            <th scope="col">Entrada/Saída</th>
                            <th scope="col">Intervalo</th>
                            <th scope="col">Acões</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os horários serão adicionados dinamicamente aqui através do JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<!-- Modal de inserir dia semana -->
<div class="modal fade" id="modalInserirServ" tabindex="-1" role="dialog" aria-labelledby="modalInserirServLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirServLabel">Definir Novo serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <form id="formInserirServ">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="novoServ">Serviços</label>
                            <select id="novoServ" class="form-control">
                                <?php
                                foreach ($servicos as $servico) {
                                    echo '<option value="' . $servico['id_servico'] . '">' . $servico['nome_servico'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="margin-top: 29px;">
                            <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirServ()">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <table id="tabelaServ" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="display: none;">#</th>
                            <th scope="col">Serviços</th>
                            <th scope="col" style="display: flex; justify-content: center; align-item: center;">ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os horários serão adicionados dinamicamente aqui através do JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<!-- Modal de deletar user -->
<div class="modal fade" id="modalDeletar" tabindex="-1" role="dialog" aria-labelledby="modalDeletarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-title1"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletar"></p>
                <p style="font-size: 1.1em;" id="textDeletar1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarUsuario()">Deletar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal de deletar Fun -->
<div class="modal fade" id="modalDeletarFun" tabindex="-1" role="dialog" aria-labelledby="modalDeletarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleF"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarF"></p>
                <p style="font-size: 1.1em;" id="textDeletarF1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarFuncionario()">Deletar</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal sucesso -->
<div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="modalSucessoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-title">SUCESSO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textSucesso"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal erro -->
<div class="modal fade" id="modalErro" tabindex="-1" role="dialog" aria-labelledby="modalErroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-title">ERRO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textErro"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>