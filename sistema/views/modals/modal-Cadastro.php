<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

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





<!-- Modal de Edição serviço -->
<div class="modal fade" id="modalEditarServico" tabindex="-1" role="dialog" aria-labelledby="modalEditarServicoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarServicoLabel">Editar Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarServico">
                    <input type="hidden" id="editServicoId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editServicoNome">Nome:</label>
                            <input type="text" class="form-control" id="editServicoNome" required placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editServicoPrec">Preço:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="editServicoPrec" required placeholder="R$">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editServicoCom">Comissão: (%)</label>
                            <input type="text" class="form-control" id="editServicoCom" required placeholder="100%">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editServicoTemp">Tempo:</label>
                            <input type="number" min="0" max="100" step="1" class="form-control" id="editServicoTemp" required placeholder="30 Minutos">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoServico()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de Edição produto -->
<div class="modal fade" id="modalEditarProduto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProdutoLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarProduto" enctype="multipart/form-data">
                    <input type="hidden" id="editProdutoId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="editProdutoNome">Nome:</label>
                            <input type="text" class="form-control" id="editProdutoNome" required placeholder="Nome">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProdutoComp">Valor Compra:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="editProdutoComp" required placeholder="R$">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProdutoVend">Valor Venda:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="editProdutoVend" required placeholder="R$">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="editProdutoEsto">Estoque:</label>
                            <input type="number" min="0" max="999999" step="1" class="form-control" id="editProdutoEsto" required placeholder="Quantidade">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProdutoVali">Validade:</label>
                            <input type="text" class="form-control" id="editProdutoVali" required placeholder="0000-00-00">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editProdutoAler">Alerta Estoque:</label>
                            <div class="input-group">
                                <input type="number" min="0" max="999999" step="1" class="form-control" id="editProdutoAler" required placeholder="Quantidade">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Digite a quantidade desejada para receber um alerta quando o estoque ficar abaixo desse valor.">!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style=" display: flex; " for="editProdutoDesc">Descrição <p style="font-size: 0.9em; margin-left: 5px;"> (Até 255 Caracteres)</p></label>
                        <input type="text" max="255" class="form-control" id="editProdutoDesc" required placeholder="Descrição do Produto">
                    </div>


                    <div class="form-row" style="gap: 50px;">
                        <div class="form-group">
                            <label for="editProdutoImg">Imagem:</label>
                            <input type="file" class="form-control-file" accept="image/*" id="editProdutoImgInput">
                        </div>
                        <div class="form-group">
                            <img id="editProdutoImg" src="" alt="Imagem do Produto" style="max-width: 120px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="salvarEdicaoProduto()">Salvar</button>
            </div>
        </div>
    </div>
</div>






<!-- Modal de inserir serviço -->
<div class="modal fade" id="modalInserirServico" tabindex="-1" role="dialog" aria-labelledby="modalNovoServicoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoServicoLabel">NOVO Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNovoServico">
                    <input type="hidden" id="novoServicoId" value="">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoServicoNome">Nome:</label>
                            <input type="text" class="form-control" id="novoServicoNome" required placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoServicoPrec">Preço:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="novoServicoPrec" required placeholder="R$">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="novoServicoCom">Comissão: (%)</label>
                            <input type="number" min="0" max="100" step="1" class="form-control" id="novoServicoCom" required placeholder="100%">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="novoServicoTemp">Tempo:</label>
                            <input type="number" min="0" max="1000" step="1" class="form-control" id="novoServicoTemp" required placeholder="30 Minutos">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirServico()">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal de inserir produto -->
<div class="modal fade" id="modalInserirProduto" tabindex="-1" role="dialog" aria-labelledby="modalInserirProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInserirProdutoLabel">Inserir Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInserirProduto" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="novoProdutoNome">Nome:</label>
                            <input type="text" class="form-control" id="novoProdutoNome" required placeholder="Nome">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="novoProdutoComp">Valor Compra:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="novoProdutoComp" required placeholder="R$">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="novoProdutoVend">Valor Venda:</label>
                            <input type="number" min="0" max="10000" step="1" class="form-control" id="novoProdutoVend" required placeholder="R$">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="novoProdutoEsto">Estoque:</label>
                            <input type="number" min="0" max="999999" step="1" class="form-control" id="novoProdutoEsto" required placeholder="Quantidade">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="novoProdutoVali">Validade:</label>
                            <input type="text" class="form-control" id="novoProdutoVali" required placeholder="0000-00-00">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="novoProdutoAler">Alerta Estoque:</label>
                            <div class="input-group">
                                <input type="number" min="0" max="999999" step="1" class="form-control" id="novoProdutoAler" required placeholder="Quantidade">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" class="input-group-text tooltip-trigger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Digite a quantidade desejada para receber um alerta quando o estoque ficar abaixo desse valor.">!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style=" display: flex; " for="novoProdutoDesc">Descrição <p style="font-size: 0.9em; margin-left: 5px;"> (Até 255 Caracteres)</p></label>
                        <input type="text" max="255" class="form-control" id="novoProdutoDesc" required placeholder="Descrição do Produto">
                    </div>


                    <div class="form-row" style="gap: 50px;">
                        <div class="form-group">
                            <label for="novoProdutoImg">Imagem:</label>
                            <input type="file" class="form-control-file" accept="image/*" id="novoProdutoImgInput">
                        </div>
                        <div class="form-group">
                            <img id="novoProdutoImg" src="" alt="Imagem do Produto" style="max-width: 120px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirProduto()">Salvar</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal de inserir serviço -->
<div class="modal fade" id="modalInserirCargo" tabindex="-1" role="dialog" aria-labelledby="modalNovoCargoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoCargoLabel">NOVO CARGO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNovoCargo">
                    <input type="hidden" id="novoCargoId" value="">
                    <div class="form-group col-md-6">
                        <label for="novoCargoNome">Cargo:</label>
                        <input type="text" class="form-control" id="novoCargoNome" required placeholder="Cargo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: blue; color: #fff;" class="btn" onclick="inserirCargo()">Salvar</button>
            </div>
        </div>
    </div>
</div>








<!-- Modal de deletar serviço -->
<div class="modal fade" id="modalDeletarServico" tabindex="-1" role="dialog" aria-labelledby="modalDeletarServicoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleServico"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarServico"></p>
                <p style="font-size: 1.1em;" id="textDeletarServico1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarServico()">Deletar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal de deletar cargo -->
<div class="modal fade" id="modalDeletarCargo" tabindex="-1" role="dialog" aria-labelledby="modalDeletarCargoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleCargo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarCargo"></p>
                <p style="font-size: 1.1em;" id="textDeletarCargo1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarCargo()">Deletar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de deletar Produto -->
<div class="modal fade" id="modalDeletarProduto" tabindex="-1" role="dialog" aria-labelledby="modalDeletarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: 400;" class="modal-titleProduto"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.1em;" id="textDeletarProduto"></p>
                <p style="font-size: 1.1em;" id="textDeletarProduto1"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" style="background-color: red; color: #fff;" class="btn" onclick="btnDeletarProduto()">Deletar</button>
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
            $("#editProdutoImg").attr("src", "../../assets/images/sem-foto.jpg"); // Substitua pelo caminho da sua imagem padrão
        });

        // Atualizar a imagem quando um arquivo for selecionado
        $("#editProdutoImgInput").on("change", function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                if (file) {
                    $("#editProdutoImg").attr("src", e.target.result);
                } else {
                    $("#editProdutoImg").attr("src", "../../assets/images/sem-foto.jpg"); // Substitua pelo caminho da sua imagem padrão
                }
            };

            reader.readAsDataURL(file);
        });

        $(document).ready(function() {
            $("#novoProdutoImg").attr("src", "../../assets/images/sem-foto.jpg"); // Substitua pelo caminho da sua imagem padrão
        });

        // Atualizar a imagem quando um arquivo for selecionado
        $("#novoProdutoImgInput").on("change", function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                if (file) {
                    $("#novoProdutoImg").attr("src", e.target.result);
                } else {
                    $("#novoProdutoImg").attr("src", "../../assets/images/sem-foto.jpg"); // Substitua pelo caminho da sua imagem padrão
                }
            };

            reader.readAsDataURL(file);
        });

        $("#editProdutoVali, #novoProdutoVali").mask("0000-00-00");
    </script>