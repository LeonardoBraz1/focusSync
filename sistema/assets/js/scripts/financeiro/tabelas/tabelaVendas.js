$(document).ready(function() {
    obterVendas();
});

function obterVendas() {
    $.ajax({
        url: "../../controllers/VendaController.php",
        type: "POST",
        data: {
            action: "obterVendas"
        },
        dataType: "json",
        success: function(response) {
            if (response.status === "erro") {
                alert(response.message);
                return;
            }
            $("#sampleTable").DataTable().destroy();
            var vendas = JSON.parse(response);
            var vendasTableBody = $("#vendasTableBody");

            vendasTableBody.empty();

                for (var i = 0; i < vendas.length; i++) {
                    var venda = vendas[i];
                    var row = $("<tr>");

                    row.append("<td style='display: none;'>" + venda.id_venda + "</td>");
                    row.append("<td>" + venda.nome_pro + "</td>");
                    row.append("<td>" + venda.valor_venda + "</td>");
                    row.append("<td>" + venda.quantidade + "</td>");
                    row.append("<td>" + venda.valor_total + "</td>");
                    row.append("<td>" + venda.nome_cliente + "</td>");
                    row.append("<td>" + venda.data_venda + "</td>");
                    row.append("<td>" + venda.data_pagamento + "</td>");
                    row.append("<td>" + venda.numero_fatura + "</td>");
                    row.append("<td>" + venda.status + "</td>");

                    var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
                    actions.append("<label style='cursor: pointer;' for='btnEditarVenda-" + venda.id_venda + "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnEditarVenda'  onclick='editarVenda(" + venda.id_venda + ", \"" + venda.nome_pro + "\", \"" + venda.valor_venda + "\", \"" + venda.valor_total + "\", \"" + venda.nome_cliente + "\", \"" + venda.data_venda + "\", \"" + venda.data_pagamento + "\", \"" + venda.numero_fatura + "\", \"" + venda.status + "\", \"" + venda.imagemSrc + "\", \"" + venda.forma_pagamento + "\", \"" + venda.quantidade + "\", \"" + venda.nome_usuario + "\")' id='btnEditarVenda-" + venda.id_venda + "'>");
                    actions.append("<label style='cursor: pointer;' for='btnDeletarVenda-" + venda.id_venda + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
                    actions.append("<input style='display: none;' type='button' class='btnDeletarvenda' onclick='deletarvenda(" + venda.id_venda + ")' id='btnDeletarvenda-" + venda.id_venda + "'>");

                    row.append(actions);
                    vendasTableBody.append(row);
                }
            console.log(vendas, response);
            $("#sampleTable").DataTable();
        },
        error: function() {
            alert("Ocorreu um erro ao obter as vendas.");
        },
    });
}