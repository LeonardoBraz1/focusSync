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


$query = $conn->prepare("SELECT * FROM fornecedores where id_barbearia = :id_barbearia");
$query->bindParam(':id_barbearia', $_SESSION["barbearia_id"]);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$fornecedores = array();
foreach ($result as $row) {
    $fornecedores[] = $row;
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
                            <select id="novaVendaCliente" class="form-control" placeholder="Selecionar um cliente" name="cliente">
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
                            <input type="number" min="1" class="form-control" id="novaVendaQuant" required placeholder="Digite a Quantidade Vendida">
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





<!-- Modal de inserir compra -->
<div class="modal fade" id="modalInserirCompra" tabindex="-1" role="dialog" aria-labelledby="modalInserirCompraLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirCompraLabel">Inserir Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirCompra" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaCompraPro">Produtos:</label>
                            <select id="novaCompraPro" class="form-control" name="Id_pro" placeholder="Selecionar">
                                <?php
                                foreach ($produtos as $produto) {
                                    echo '<option value="' . $produto['id_pro'] . '">' . $produto['nome_pro'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaCompraFor">Fornecedor:</label>
                            <select id="novaCompraFor" class="form-control" name="id_fornecedo" placeholder="Selecionar">
                                <option value="">Selecionar Fornecedor</option>
                                <?php
                                foreach ($fornecedores as $fornecedor) {
                                    echo '<option value="' . $fornecedor['id_fornecedo'] . '">' . $fornecedor['nome_fornecedo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaCompraUnit">Valor Unitário:</label>
                            <input type="number" class="form-control" id="novaCompraUnit" placeholder="R$" oninput="calculateTotal()">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaCompraQuant1">Quantidade:</label>
                            <input type="number" min="1" class="form-control" id="novaCompraQuant1" required placeholder="Digite a Quantidade comprada" oninput="calculateTotal()">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novaCompraTota1">Valor Total:</label>
                            <input type="number" class="form-control" id="novaCompraTota1" placeholder="R$" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novaCompraPaga1">Data Pagamento:</label>
                            <input type="text" class="form-control" id="novaCompraPaga1" required placeholder="0000-00-00">
                        </div>
                    </div>
                    <label for="novaCompraFpaga1">Forma Pagamento:</label>
                    <div class="input-group">
                        <select id="novaCompraFpaga1" class="form-control" placeholder="Selecionar">
                            <option>Pix</option>
                            <option>Dinheiro</option>
                            <option>Cartão de Crédito</option>
                            <option>Cartão de Débito</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirCompra()">Salvar</button>
            </div>
        </div>
    </div>
</div>











<!-- Modal  ver venda-->
<div class="modal fade" id="modalVerVenda" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <p id="status_message" class="status_message d-none" style="margin-bottom: -15px; background-color: indianred; color: #fff; text-align: center;">A Compra será automaticamente marcada como "Aprovada" na data do pagamento.</p>
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


<!-- Modal  vercompra-->
<div class="modal fade" id="modalVerCompra" tabindex="-1" role="dialog" aria-labelledby="modalNovoEntradaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <p id="status_messageCompra" class="status_message d-none" style="margin-bottom: -15px; background-color: indianred; color: #fff; text-align: center;">A venda será automaticamente marcada como "Pago" na data do pagamento.</p>
            <div class="modal-header">
                <h5 class="modal-title" id="nome1_dados"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="compraId" value="">
            <div class="modal-body">
                <div class="row" style="border-bottom: 1px solid #cac7c7;  margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Valor Unitário: </b></span>
                        <span id="valorUnit_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Quantidade: </b></span>
                        <span id="quantidade1_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Valor Total: </b></span>
                        <span id="total1_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Fornecedor: </b></span>
                        <span id="fornecedor_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Data Compra: </b></span>
                        <span id="data_compra_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Data Pagamento: </b></span>
                        <span id="data_pag1_dados"></span>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #cac7c7; margin-bottom: 10px;">
                    <div class="col-md-6">
                        <span><b>Forma Pagamento: </b></span>
                        <span id="forPag1_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Status: </b></span>
                        <span id="status1_dados"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <a>
                            <img width="200px" id="img1_mostrar">
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






<!-- modal cache -->
<div class="modal fade bottom-modal" id="cachePermissionModal" tabindex="-1" role="dialog" aria-labelledby="cachePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cachePermissionModalLabel">Permissão para usar o cache</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Gostaríamos de habilitar o uso do cache para uma melhor experiência offline. Você aceita?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="cachePermissionButtonYes">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal status -->
<div class="modal fade" id="modalEditarStatus" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-title">Trocar Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="editStatusId" value="">
            <div class="modal-body">
                <div class="form-group col-md-6">
                    <label for="novoStatus1">Status:</label>
                    <div class="input-group">
                        <select id="novoStatus1" class="form-control" placeholder="Selecionar">
                            <option>Aprovada</option>
                            <option>Pendente</option>
                            <option>Cancelada</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoStatus()">Salvar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal status compra -->
<div class="modal fade" id="modalEditarStatusPagamento" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-title">Trocar Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="editStatusPagaId" value="">
            <div class="modal-body">
                <div class="form-group col-md-6">
                    <label for="novoStatusPaga">Status:</label>
                    <div class="input-group">
                        <select id="novoStatusPaga" class="form-control" placeholder="Selecionar">
                            <option>Aprovada</option>
                            <option>Pendente</option>
                            <option>Cancelada</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoStatusPaga()">Salvar</button>
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






<!-- Modal de deletar compra -->
<div class="modal fade" id="modalDeletarCompra" tabindex="-1" role="dialog" aria-labelledby="modalDeletarCompraLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleCompra"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarCompra"></p>
                <p style="font-size: 1.1em;" id="textDeletarCompra1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarCompra()">Deletar</button>
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

        $("#novaVendaPaga").mask("0000-00-00");



        function calculateTotal() {
            var unitValue = parseFloat(document.getElementById('novaCompraUnit').value);
            var quantity = parseInt(document.getElementById('novaCompraQuant1').value);
            var total = unitValue * quantity;

            if (!isNaN(total)) {
                document.getElementById('novaCompraTota1').value = total.toFixed(2);
            } else {
                document.getElementById('novaCompraTota1').value = '';
            }
        }
    </script>