





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


<!-- Modal de Edição serviço -->
<div class="modal fade" id="modalInserirServico" tabindex="-1" role="dialog" aria-labelledby="modalNovoServicoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoServicoLabel">Novo Serviço</h5>
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