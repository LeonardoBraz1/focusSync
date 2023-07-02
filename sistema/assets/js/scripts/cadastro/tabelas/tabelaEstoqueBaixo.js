$(document).ready(function() {
    obterProdutosEstoqueBaixo();
  });
  
  function obterProdutosEstoqueBaixo() {
    $.ajax({
      url: "../../controllers/ProdutoController.php",
      type: "POST",
      data: { action: "obterProdutosEstoqueBaixo" },
      dataType: "json",
      success: function(response) {
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
            row.append("<td><img src='" + produto.imagemSrc + "' alt='Imagem do Produto' style='max-width: 30px;'>" + produto.nome_pro + "</td>");
            row.append("<td>R$ " + produto.valor_compra + "</td>");
            row.append("<td>R$ " + produto.valor_venda + "</td>");
            row.append("<td>" + produto.estoque + "</td>");
            row.append("<td>" + produto.validade + "</td>");
            row.append("<td>" + produto.alerta_estoque + "</td>");
            row.append("<td>" + produto.data_cadastro + "</td>");
  
            produtosEstoqueTableBody.append(row);
          }
  
        $("#sampleTable").DataTable();
      },
      error: function() {
        alert("Ocorreu um erro ao obter os produtos com estoque baixo.");
      },
    });
  }