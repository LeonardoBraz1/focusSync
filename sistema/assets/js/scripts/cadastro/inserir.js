//    Serviço     //

function btnInserirServico() {
  $("#modalInserirServico").modal("show");
}

function inserirServico() {
  var nome_servico = $("#novoServicoNome").val();
  var preco = $("#novoServicoPrec").val();
  var comissao = $("#novoServicoCom").val();
  var tempo = $("#novoServicoTemp").val();
  $.ajax({
    url: "../../controllers/ServicoController.php",
    type: "POST",
    data: {
      nome_servico: nome_servico,
      preco: preco,
      comissao: comissao,
      tempo: tempo,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Serviço inserido com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); // Recarrega a página
        });
      } else {
        $("#textErro").text("Não foi possível inserir esse serviço");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });

  // Fechar a modal de inserção de funcionário
  $("#modalInserirServico").modal("hide");
}




//    Cargo     //

function btnInserirCargo() {
  $("#modalInserirCargo").modal("show");
}

function inserirCargo() {
  var nome_nivel = $("#novoCargoNome").val();
  $.ajax({
    url: "../../controllers/CargoController.php",
    type: "POST",
    data: {
      nome_nivel: nome_nivel,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Cargo inserido com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); // Recarrega a página
        });
      } else {
        $("#textErro").text("Não foi possível inserir esse cargo");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });

  // Fechar a modal de inserção de funcionário
  $("#modalInserirCargo").modal("hide");
}





//    Produto     //

function btnInserirProduto() {
  $("#modalInserirProduto").modal("show");
}

function inserirProduto() {
  var nome_pro = $("#novoProdutoNome").val();
  var valor_compra = $("#novoProdutoComp").val();
  var valor_venda = $("#novoProdutoVend").val();
  var estoque = $("#novoProdutoEsto").val();
  var validade = $("#novoProdutoVali").val();
  var alerta_estoque = $("#novoProdutoAler").val();
  var descricao = $("#novoProdutoDesc").val();
  var imagem = $("#novoProdutoImg").attr("src");
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: {
      nome_pro: nome_pro,
      valor_compra: valor_compra,
      valor_venda: valor_venda,
      estoque: estoque,
      validade: validade,
      alerta_estoque: alerta_estoque,
      descricao: descricao,
      imagem: imagem,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Produto inserido com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); // Recarrega a página
        });
      } else {
        $("#textErro").text("Não foi possível inserir esse produto");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });

  // Fechar a modal de inserção de funcionário
  $("#modalInserirProduto").modal("hide");
}
