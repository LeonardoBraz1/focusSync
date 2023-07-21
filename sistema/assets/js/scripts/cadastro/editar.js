function editarServico(id_servico, nome_servico, preco, tempo, imagem) {
 
  $("#editServicoId").val(id_servico);
  $("#editServicoNome").val(nome_servico);
  $("#editServicoPrec").val(preco);
  $("#editServicoTemp").val(tempo);
  $("#editServicoImg").attr("src", imagem);

  $("#modalEditarServico").modal("show");
}

function salvarEdicaoServico() {
  var id_servico = $("#editServicoId").val();
  var nome_servico = $("#editServicoNome").val();
  var preco = $("#editServicoPrec").val();
  var tempo = $("#editServicoTemp").val();
  var imagem = $("#editServicoImg").attr("src");

  $.ajax({
    url: "../../controllers/ServicoController.php",
    type: "POST",
    data: {
      id_servico: id_servico,
      nome_servico: nome_servico,
      preco: preco,
      tempo: tempo,
      imagem: imagem,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Serviço editado com sucesso!");
        $("#modalSucesso").modal("show");

      } else {
        $("#textErro").text("Não foi possivel editar esse serviço");
        $("#modalErro").modal("show");
      }
      obterServicos();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterServicos();
  $("#modalEditarServico").modal("hide");
}

//   Produto   //

function editarProduto(
  id_pro,
  nome_pro,
  valor_compra,
  valor_venda,
  estoque,
  validade,
  alerta_estoque,
  comissao,
  descricao,
  imagem
) {
  $("#editProdutoId").val(id_pro);
  $("#editProdutoNome").val(nome_pro);
  $("#editProdutoComp").val(valor_compra);
  $("#editProdutoVend").val(valor_venda);
  $("#editProdutoEsto").val(estoque);
  $("#editProdutoVali").val(validade);
  $("#editProdutoAler").val(alerta_estoque);
  $("#editProdutoComissao").val(comissao);
  $("#editProdutoDesc").val(descricao);
  $("#editProdutoImg").attr("src", imagem);

  $("#modalEditarProduto").modal("show");
}

function salvarEdicaoProduto() {
  var id_pro = $("#editProdutoId").val();
  var nome_pro = $("#editProdutoNome").val();
  var valor_compra = $("#editProdutoComp").val();
  var valor_venda = $("#editProdutoVend").val();
  var estoque = $("#editProdutoEsto").val();
  var validade = $("#editProdutoVali").val();
  var alerta_estoque = $("#editProdutoAler").val();
  var comissao = $("#editProdutoComi").val();
  var descricao = $("#editProdutoDesc").val();
  var imagem = $("#editProdutoImg").attr("src");

  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: {
      id_pro: id_pro,
      nome_pro: nome_pro,
      valor_compra: valor_compra,
      valor_venda: valor_venda,
      estoque: estoque,
      validade: validade,
      alerta_estoque: alerta_estoque,
      comissao: comissao,
      descricao: descricao,
      imagem: imagem,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Produto editado com sucesso!");
        $("#modalSucesso").modal("show");

        
      } else {
        $("#textErro").text("Não foi possível editar esse produto");
        $("#modalErro").modal("show");
      }
      obterProdutos();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterProdutos();
  $("#modalEditarProduto").modal("hide");
}

