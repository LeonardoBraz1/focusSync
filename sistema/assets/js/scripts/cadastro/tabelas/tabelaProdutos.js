
$(document).ready(function() {
    mostrarSpinner();
    obterProdutos();
});

function obterProdutos() {
    $.ajax({
        url: "../../controllers/ProdutoController.php",
        type: "POST",
        data: { action: "obterProdutos" },
        dataType: "json",
        success: function(response) {
            if (response.status === "erro") {
                alert(response.message);
                return;
            }
            $("#sampleTable").DataTable().destroy();
            var produtos = JSON.parse(response);
            var produtosTableBody = $("#produtosTableBody");

            produtosTableBody.empty();

                for (var i = 0; i < produtos.length; i++) {
                    var produto = produtos[i];
                    var row = $("<tr>");

                    if (produto.estoque < produto.alerta_estoque) {
                        row.addClass("text-danger");
                    }

                    row.append("<td style='display: none;'>" + produto.id_pro + "</td>");
                    row.append("<td><img src='" + produto.imagemSrc + "' alt='Imagem do Produto' style='max-width: 30px;'>" + produto.nome_pro + "</td>");
                    row.append("<td>R$ " + produto.valor_compra + "</td>");
                    row.append("<td>R$ " + produto.valor_venda + "</td>");
                    row.append("<td>" + produto.estoque + "</td>");
                    row.append("<td>" + produto.validade + "</td>");
                    row.append("<td>" + produto.alerta_estoque + "</td>");
                    row.append("<td>" + produto.data_cadastro + "</td>");

                    var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
                    actions.append("<label style='cursor: pointer;' for='btnEditarProduto-" + produto.id_pro + "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnEditarProduto'  onclick='editarProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\", \"" + produto.valor_compra + "\", \"" + produto.valor_venda + "\", \"" + produto.estoque + "\", \"" + produto.validade + "\", \"" + produto.alerta_estoque + "\",  \"" + produto.comissao + "\", \"" + produto.descricao + "\", \"" + produto.imagemSrc + "\")' id='btnEditarProduto-" + produto.id_pro + "'>");
                    actions.append("<label style='cursor: pointer;' for='btnVerProduto-" + produto.id_pro + "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnVerProduto'  onclick='verProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\", \"" + produto.data_cadastro + "\", \"" + produto.valor_compra + "\", \"" + produto.valor_venda + "\", \"" + produto.estoque + "\", \"" + produto.validade + "\", \"" + produto.alerta_estoque + "\",  \"" + produto.comissao + "\", \"" + produto.descricao + "\", \"" + produto.imagemSrc + "\")' id='btnVerProduto-" + produto.id_pro + "'>");
                    actions.append("<label style='cursor: pointer;' for='btnDeletarProduto-" + produto.id_pro + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
                    actions.append("<input style='display: none;' type='button' onclick='deletarProduto(" + produto.id_pro + ")' id='btnDeletarProduto-" + produto.id_pro + "'>");
                    actions.append("<label style='cursor: pointer;' for='btnSaidaProduto-" + produto.id_pro + "'><i title='Saída de Produto' class='fa fa-solid fa-share fa-lg' style='color: #c30404;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnSaidaProduto'  onclick='SaidaProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\")' id='btnSaidaProduto-" + produto.id_pro + "'>");
                    actions.append("<label style='cursor: pointer;' for='btnEntradaProduto-" + produto.id_pro + "'><i title='Entrada de Produto' class='fa fa-solid fa-reply fa-lg' style='color: #5c6370;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnEntradaProduto'  onclick='entradaProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\")' id='btnEntradaProduto-" + produto.id_pro + "'>");

                    row.append(actions);
                    produtosTableBody.append(row);
                }

            $("#sampleTable").DataTable();
            ocultarSpinner();
        },
        error: function() {
            ocultarSpinner();
            alert("Ocorreu um erro ao obter os produtos.");
        },
    });
}


function mostrarSpinner() {
    $("#loadingIndicator6").show();
  }
  
  function ocultarSpinner() {
    $("#loadingIndicator6").hide();
  }