$(document).ready(function () {
  mostrarSpinner();
  obterProdutosEstoqueBaixo();
});

function obterProdutosEstoqueBaixo() {
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: { action: "obterProdutosEstoqueBaixo" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var produtos = JSON.parse(response);
      var produtosEstoqueTableBody = $("#produtosEstoqueTableBody");

      produtosEstoqueTableBody.empty();

      for (var i = 0; i < produtos.length; i++) {
        var produto = produtos[i];
        var row = $("<tr>");

        row.append("<td style='display: none;'>" + produto.id_pro + "</td>");
        row.append(
          "<td><img src='" +
            produto.imagemSrc +
            "' alt='Imagem do Produto' style='max-width: 30px;'>" +
            produto.nome_pro +
            "</td>"
        );
        row.append("<td>R$ " + produto.valor_compra + "</td>");
        row.append("<td>R$ " + produto.valor_venda + "</td>");
        row.append("<td>" + produto.estoque + "</td>");
        row.append("<td>" + produto.validade + "</td>");
        row.append("<td>" + produto.alerta_estoque + "</td>");
        row.append("<td>" + produto.data_cadastro + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnVerProdutoEsto-" +
            produto.id_pro +
            "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnVerProdutoEsto'  onclick='verProdutoEsto(" +
            produto.id_pro +
            ', "' +
            produto.nome_pro +
            '", "' +
            produto.data_cadastro +
            '", "' +
            produto.valor_compra +
            '", "' +
            produto.valor_venda +
            '", "' +
            produto.estoque +
            '", "' +
            produto.validade +
            '", "' +
            produto.alerta_estoque +
            '", "' +
            produto.imagemSrc +
            "\")' id='btnVerProdutoEsto-" +
            produto.id_pro +
            "'>"
        );

        row.append(actions);
        produtosEstoqueTableBody.append(row);
      }
      
      $("#sampleTable").DataTable();

      
      console.log("cheguei aqui");
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os produtos com estoque baixo.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator13").show();
}

function ocultarSpinner() {
  $("#loadingIndicator13").hide();
}
