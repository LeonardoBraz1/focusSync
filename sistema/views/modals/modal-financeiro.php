


<!-- Modal  -->
<div class="modal fade" id="modalVerVenda" tabindex="-1" role="dialog" aria-labelledby="modalNovoEntradaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<input type="hidden" id="vendaId" value="">
			<div class="modal-body">
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Nome: </b></span>
						<span id="nome_dados"></span>
					</div>	
					<div class="col-md-6">							
						<span><b>Volor Venda: </b></span>
						<span id="venda_dados"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Quantidade: </b></span>
						<span id="quantidade_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Volor Total: </b></span>
						<span id="total_dados"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Venda: </b></span>
						<span id="data_venda_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Data Pagamento: </b></span>
						<span id="data_pag_dados"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Nº da Fatura: </b></span>
						<span id="nFatura_dados"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Nome Usuário: </b></span>
						<span id="nomeUser_dados"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
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
							<img width="250px" id="img_mostrar">
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