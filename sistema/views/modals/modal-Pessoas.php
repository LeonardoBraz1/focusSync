<?php
require_once('../../models/conexao.php');

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

<style>
    .tooltip-box {
        display: none;
        position: absolute;
        background-color: #000;
        color: #fff;
        padding: 5px;
        font-size: 12px;
        margin-left: 30px;
    }

    .tooltip-trigger:hover+.tooltip-box {
        display: block;
    }
</style>

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
                            <div class="input-group">
                                <select id="editUsuarioAti" class="form-control">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se essa opção estiver definida como 'Não', o usuário não terá permissão para fazer login no sistema.">!</span>
                                </div>
                            </div>
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
                            <div class="input-group">
                                <input type="number" min="0" max="100" step="1" class="form-control" id="editFuncionarioCom" required placeholder="100%">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se você desejar atribuir uma porcentagem específica ao funcionário, basta preencher esse campo com a porcentagem correspondente. Caso contrário, deixe-o em branco e a comissão será calculada com base na porcentagem do serviço ou produto definida em cada.">!</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFuncionarioAten">Atendimento:</label>
                            <div class="input-group">
                                <select id="editFuncionarioAten" class="form-control">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se o funcionário estiver disponível para prestar serviços, selecione 'Sim' nessa opção para que o nome dele seja exibido aos clientes para agendamento.">!</span>
                                </div>
                            </div>
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

<!-- Modal de Edição fornecedor -->
<div class="modal fade" id="modalEditarFornecedor" tabindex="-1" role="dialog" aria-labelledby="modalEditarFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarFornecedorLabel">Editar Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de edição -->
                <form id="formEditarFornecedor">
                    <!-- Campos de edição -->
                    <input type="hidden" id="editFornecedorId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFornecedorNome">Nome:</label>
                            <input type="text" class="form-control" id="editFornecedorNome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFornecedorEmail">Email:</label>
                            <input type="email" class="form-control" id="editFornecedorEmail" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editFornecedorTel">Telefone:</label>
                            <input type="text" class="form-control phone" id="editFornecedorTel" required  placeholder="(00) 00000-0000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFornecedorPont">Pontuação:</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" step="1" class="form-control" id="editFornecedorPont" required placeholder="0 a 100">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Essa pontuação representa uma medida da confiabilidade e satisfação geral com os produtos ou serviços oferecidos pelo fornecedor.">!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="editFornecedorEnd">Endereço:</label>
                            <input type="text" class="form-control" id="editFornecedorEnd" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editFornecedorCid">Cidade:</label>
                            <input type="text" class="form-control" id="editFornecedorCid" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editFornecedorSit">Site do Fornecedor:</label>
                        <input type="text" class="form-control" id="editFornecedorSit" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoFornecedor()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de Edição Cliente -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarClienteLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarCliente">
                    <input type="hidden" id="editClienteId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editClienteNome">Nome:</label>
                            <input type="text" class="form-control" id="editClienteNome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editClienteEmail">Email:</label>
                            <input type="email" class="form-control" id="editClienteEmail" required>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="editClienteTel">Telefone:</label>
                            <input type="text" class="form-control" id="editClienteTel" required>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoCliente()">Salvar</button>
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
                            <div class="input-group">
                                <select id="novoUsuarioAti" class="form-control">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se essa opção estiver definida como 'Não', o usuário não terá permissão para fazer login no sistema.">!</span>
                                </div>
                            </div>
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
                            <div class="input-group">
                                <input type="number" min="0" max="100" step="1" class="form-control" id="novoFuncionarioCom" required placeholder="100%">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se você desejar atribuir uma porcentagem específica ao funcionário, basta preencher esse campo com a porcentagem correspondente. Caso contrário, deixe-o em branco e a comissão será calculada com base na porcentagem do serviço ou produto definido em cada.">!</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFuncionarioAten">Atendimento:</label>
                            <div class="input-group">
                                <select id="novoFuncionarioAten" class="form-control">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Se o funcionário estiver disponível para prestar serviços, selecione 'Sim' nessa opção para que o nome dele seja exibido aos clientes para agendamento.">!</span>
                                </div>
                            </div>
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






<!-- Modal de inserir fornecedor -->
<div class="modal fade" id="modalInserirFornecedor" tabindex="-1" role="dialog" aria-labelledby="modalInserirFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirFornecedorLabel">Inserir Fornecedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirFornecedor">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFornecedorNome">Nome:</label>
                            <input type="text" class="form-control" id="novoFornecedorNome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFornecedorEmail">Email:</label>
                            <input type="email" class="form-control" id="novoFornecedorEmail" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoFornecedorTel">Telefone:</label>
                            <input type="tel" class="form-control" id="novoFornecedorTel" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFornecedorPont">Pontuação:</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" step="1" class="form-control" id="novoFornecedorPont" placeholder="0 a 100">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Essa pontuação representa uma medida da confiabilidade e satisfação geral com os produtos ou serviços oferecidos pelo fornecedor.">!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="novoFornecedorEnd">Endereço:</label>
                            <input type="text" class="form-control" id="novoFornecedorEnd" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoFornecedorCid">Cidade:</label>
                            <input type="text" class="form-control" id="novoFornecedorCid" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="novoFornecedorSit">Site do Fornecedor:</label>
                        <input type="text" class="form-control" id="novoFornecedorSit" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirFornecedor()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de inserir Cliente -->
<div class="modal fade" id="modalInserirCliente" tabindex="-1" role="dialog" aria-labelledby="modalInserirClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirClienteLabel">Inserir Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirCliente">
                    <input type="hidden" id="novoClienteId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoClienteNome">Nome:</label>
                            <input type="text" class="form-control" id="novoClienteNome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoClienteEmail">Email:</label>
                            <input type="email" class="form-control" id="novoClienteEmail" required>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="novoClienteTel">Telefone:</label>
                            <input type="tel" class="form-control" id="novoClienteTel" required>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirCliente()">Salvar</button>
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





<!-- Modal de deletar Fornecedor -->
<div class="modal fade" id="modalDeletarForn" tabindex="-1" role="dialog" aria-labelledby="modalDeletarFornLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleForn"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarForn"></p>
                <p style="font-size: 1.1em;" id="textDeletarForn1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarFornecedor()">Deletar</button>
            </div>
        </div>
    </div>
</div>






<!-- Modal de deletar cliente -->
<div class="modal fade" id="modalDeletarClien" tabindex="-1" role="dialog" aria-labelledby="modalDeletarClienLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleClien"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarClien"></p>
                <p style="font-size: 1.1em;" id="textDeletarClien1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarCliente()">Deletar</button>
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

    <script>
        $(document).ready(function() {
            $('.tooltip-trigger').hover(function() {
                var tooltipText = $(this).data('tooltip');
                $('<div class="tooltip-box">' + tooltipText + '</div>').appendTo('body');
            }, function() {
                $('.tooltip-box').remove();
            }).mousemove(function(e) {
                var mouseX = e.pageX + 20; // Define a posição horizontal da caixa de texto
                var mouseY = e.pageY + 10; // Define a posição vertical da caixa de texto
                $('.tooltip-box').css({
                    top: mouseY,
                    left: mouseX
                });
            });
        });
    </script>