<?php
require_once('../../models/conexao.php');

// Obter a instância da conexão
$conn = Conexao::getInstance();

$query = $conn->prepare("SELECT * FROM produtos where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$produtos = array();
foreach ($result as $row) {
    $produtos[] = $row;
}

$query = $conn->prepare("SELECT * FROM usuarios where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);


$usuarios = array();
foreach ($result as $row) {
    $usuarios[] = $row;
}

$query = $conn->prepare("SELECT * FROM clientes where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$clientes = array();
foreach ($result as $row) {
    $clientes[] = $row;
}
?>



<!-- Modal de inserir venda -->
<div class="modal fade" id="modalInserirVenda" tabindex="-1" role="dialog" aria-labelledby="modalInserirVendaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirVendaLabel">Inserir Venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirVenda" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaVendaPro">Produtos:</label>
                            <select id="novaVendaPro" class="form-control" placeholder="Selecionar">
                                <?php
                                foreach ($produtos as $produto) {
                                    echo '<option value="' . $produto['id_pro'] . '" data-valor="' . $produto['valor_venda'] . '">' . $produto['nome_pro'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaVendaUser">Vendedor:</label>
                            <select id="novaVendaUser" class="form-control" placeholder="Selecionar">
                                <option value="">Selecionar Vendedor</option>
                                <?php
                                foreach ($usuarios as $usuario) {
                                    echo '<option value="' . $usuario['id'] . '">' . $usuario['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaVendaCliente">Cliente:</label>
                            <select id="novaVendaCliente" class="form-control" placeholder="Selecionar">
                                <option value="">Selecionar Cliente</option>
                                <?php
                                foreach ($clientes as $cliente) {
                                    echo '<option value="' . $cliente['id_cliente'] . '">' . $cliente['nome_cliente'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaVendaVend">Valor Venda:</label>
                            <input type="text" class="form-control" id="novaVendaVend" placeholder="R$" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaVendaQuant">Quantidade:</label>
                            <input type="number" class="form-control" id="novaVendaQuant" required placeholder="Digite a Quantidade Vendida">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaVendaTota">Valor Total:</label>
                            <input type="text" class="form-control" id="novaVendaTota" placeholder="R$" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaVendaPaga">Data Pagamento:</label>
                            <input type="text" class="form-control" id="novaVendaPaga" required placeholder="0000-00-00">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaVendaFpaga">Forma Pagamento:</label>
                            <div class="input-group">
                                <select id="novaVendaFpaga" class="form-control" placeholder="Selecionar">
                                    <option>Pix</option>
                                    <option>Dinheiro</option>
                                    <option>Cartão de Crédito</option>
                                    <option>Cartão de Débito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirVenda()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal  verVenda-->
<div class="modal fade" id="modalVerVenda" tabindex="-1" role="dialog" aria-labelledby="modalNovoEntradaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <p id="status_message" class="status_message" style="margin-bottom: -15px; background-color: indianred; color: #fff; text-align: center; display: none;">A venda será automaticamente marcada como "Aprovada" na data prevista.</p>
            <div class="modal-header">
                <h5 class="modal-title" id="nome_dados"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="vendaId" value="">
            <div class="modal-body">
                <div class="row" style="border-bottom: 1px solid #cac7c7;  margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Nome Cliente: </b></span>
                        <span id="nomeCli_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Volor Venda: </b></span>
                        <span id="venda_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Quantidade: </b></span>
                        <span id="quantidade_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Volor Total: </b></span>
                        <span id="total_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Data Venda: </b></span>
                        <span id="data_venda_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Data Pagamento: </b></span>
                        <span id="data_pag_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Nº da Fatura: </b></span>
                        <span id="nFatura_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Nome Usuário: </b></span>
                        <span id="nomeUser_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Forma Pagamento: </b></span>
                        <span id="forPag_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Status: </b></span>
                        <span id="status_dados"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <a id="link_mostrar" target="_blank" title="Clique para abrir o arquivo!">
                            <img width="200px" id="img_mostrar">
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de deletar venda -->
<div class="modal fade" id="modalDeletarVenda" tabindex="-1" role="dialog" aria-labelledby="modalDeletarVendaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleVenda"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarVenda"></p>
                <p style="font-size: 1.1em;" id="textDeletarVenda1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarVenda()">Deletar</button>
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
        // Função para atualizar o valor do produto e a soma
        function updateValues() {
            var produtoSelecionado = document.getElementById("novaVendaPro");
            var valorVenda = parseFloat(produtoSelecionado.options[produtoSelecionado.selectedIndex].getAttribute("data-valor"));
            var quantidade = parseInt(document.getElementById("novaVendaQuant").value);

            if (!isNaN(valorVenda)) {
                document.getElementById("novaVendaVend").value = valorVenda.toFixed(2);

                if (!isNaN(quantidade)) {
                    var valorTotal = valorVenda * quantidade;
                    document.getElementById("novaVendaTota").value = valorTotal.toFixed(2);
                }
            }
        }

        // Atualiza os valores iniciais ao carregar a página
        window.onload = function() {
            updateValues();
        }

        // Manipula o evento de alteração do produto
        document.getElementById("novaVendaPro").onchange = function() {
            updateValues();
        }

        // Manipula o evento de alteração da quantidade
        document.getElementById("novaVendaQuant").oninput = function() {
            updateValues();
        }

        $(document).ready(function() {
            var status = $("#status_dados").text().trim();
            if (status === "Pendente") {
                $(".status-message").show();
            } else {
                $(".status-message").hide();
            }
        });
    </script>