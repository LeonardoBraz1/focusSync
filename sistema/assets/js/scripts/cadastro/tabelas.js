$(document).ready(function() {
    obterCargos();
});

function obterCargos() {
    $.ajax({
        url: "../../controllers/CargoController.php",
        type: "POST",
        data: {
            action: "obterCargos"
        },
        dataType: "json",
        success: function(response) {
            if (response.status === "erro") {
                alert(response.message);
                return;
            }
            $("#sampleTable").DataTable().destroy();
            var cargos = JSON.parse(response);
            var cargosTableBody = $("#cargosTableBody");

            cargosTableBody.empty();

            if (Array.isArray(cargos) && cargos.length > 0) {
                for (var i = 0; i < cargos.length; i++) {
                    var cargo = cargos[i];
                    var row = $("<tr>");

                    row.append("<td style='display: none;'>" + cargo.id_nivel + "</td>");
                    row.append("<td>" + cargo.nome_nivel + "</td>");
                    row.append("<td>" + cargo.data + "</td>");

                    var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
                    actions.append("<label style='cursor: pointer;' for='btnDeletarCargo-" + cargo.id_nivel + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnDeletarCargo' onclick='deletarCargo(" + cargo.id_nivel + ")' id='btnDeletarCargo-" + cargo.id_nivel + "'>");

                    row.append(actions);
                    cargosTableBody.append(row);
                }
            } else {
                // Nenhum cargo encontrado, exibir mensagem
                $("#cargosTableBody").html("<tr><td align='center' colspan='4'>Nenhum cargo encontrado</td></tr>");
            }

            $("#sampleTable").DataTable();
        },
        error: function() {
            alert("Ocorreu um erro ao obter os cargos.");
        },
    });
}


$(document).ready(function() {
    obterEntradas();
});
    function obterEntradas() {
        $.ajax({
            url: "../../controllers/ProdutoController.php",
            type: "POST",
            data: {
                action: "obterEntradas"
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "erro") {
                    alert(response.message);
                    return;
                }

                $("#sampleTable").DataTable().destroy();
                var entradas = JSON.parse(response);
                var entradasTableBody = $("#entradasTableBody");

                entradasTableBody.empty();

                if (Array.isArray(entradas) && entradas.length > 0) {
                    for (var i = 0; i < entradas.length; i++) {
                        var entrada = entradas[i];
                        var row = $("<tr>");

                        row.append("<td style='display: none;'>" + entrada.id_entrada + "</td>");
                        row.append("<td><img src='" + entrada.imagemSrc + "' alt='Imagem do Produto' style='max-width: 30px;'>" + entrada.nome_produto + "</td>");
                        row.append("<td>" + entrada.quantidade + "</td>");
                        row.append("<td>" + entrada.motivo_entrada + "</td>");
                        row.append("<td>" + entrada.nome_fornecedor + "</td>");
                        row.append("<td>" + entrada.data_entrada + "</td>");

                        entradasTableBody.append(row);
                    }
                } else {
                    // Nenhuma entrada encontrada, exibir mensagem
                    $("#entradasTableBody").html("<tr><td align='center' colspan='6'>Nenhuma entrada encontrada</td></tr>");
                }

                // Inicializar a tabela DataTables
                $("#sampleTable").DataTable();
            },
            error: function() {
                alert("Ocorreu um erro ao obter as entradas.");
            },
        });
    }






    $(document).ready(function() {
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
    
                var produtos = JSON.parse(response);
                var produtosTableBody = $("#produtosTableBody");
    
                produtosTableBody.empty();
    
                if (Array.isArray(produtos) && produtos.length > 0) {
                    for (var i = 0; i < produtos.length; i++) {
                        var produto = produtos[i];
                        var row = $("<tr>");
    
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
                        actions.append("<input style='display: none;' type='button' class='btnEditarProduto'  onclick='editarProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\", \"" + produto.valor_compra + "\", \"" + produto.valor_venda + "\", \"" + produto.estoque + "\", \"" + produto.validade + "\", \"" + produto.alerta_estoque + "\", \"" + produto.descricao + "\", \"" + produto.imagemSrc + "\", \"" + produto.id_fornecedor + "\")' id='btnEditarProduto-" + produto.id_pro + "'>");
                        actions.append("<label style='cursor: pointer;' for='btnDeletarProduto-" + produto.id_pro + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
                        actions.append("<input style='display: none;' type='button' onclick='deletarProduto(" + produto.id_pro + ")' id='btnDeletarProduto-" + produto.id_pro + "'>");
                        actions.append("<label style='cursor: pointer;' for='btnSaidaProduto-" + produto.id_pro + "'><i title='Saída de Produto' class='fa fa-solid fa-share fa-lg' style='color: #c30404;'></i></label>");
                        actions.append("<input style='display: none;' type='button' class='btnSaidaProduto'  onclick='SaidaProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\")' id='btnSaidaProduto-" + produto.id_pro + "'>");
                        actions.append("<label style='cursor: pointer;' for='btnEntradaProduto-" + produto.id_pro + "'><i title='Entrada de Produto' class='fa fa-solid fa-reply fa-lg' style='color: #5c6370;'></i></label>");
                        actions.append("<input style='display: none;' type='button' class='btnEntradaProduto'  onclick='entradaProduto(" + produto.id_pro + ", \"" + produto.nome_pro + "\", \"" + produto.id_fornecedor + "\")' id='btnEntradaProduto-" + produto.id_pro + "'>");
    
                        row.append(actions);
                        produtosTableBody.append(row);
                    }
                } else {
                    // Nenhum produto encontrado, exibir mensagem
                    $("#produtosTableBody").html("<tr><td align='center' colspan='8'>Nenhum produto encontrado</td></tr>");
                }
    
                // Inicializar a tabela DataTables
                $("#produtosTable").DataTable();
            },
            error: function() {
                alert("Ocorreu um erro ao obter os produtos.");
            },
        });
    }