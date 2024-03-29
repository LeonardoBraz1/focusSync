//    Serviço     //

function btnInserirServico() {
  $("#modalInserirServico").modal("show");
}

function inserirServico() {
  var nome_servico = $("#novoServicoNome").val();
  var preco = $("#novoServicoPrec").val();
  var tempo = $("#novoServicoTemp").val();
  var imagem = $("#novoServicoImg").attr("src");
  $.ajax({
    url: "../../controllers/ServicoController.php",
    type: "POST",
    data: {
      nome_servico: nome_servico,
      preco: preco,
      tempo: tempo,
      imagem: imagem,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Serviço inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse serviço");
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
      } else {
        $("#textErro").text("Não foi possível inserir esse cargo");
        $("#modalErro").modal("show");
      }
      obterCargos();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });

  obterCargos();
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
  var comissao = $("#novoProdutoComi").val();
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
      comissao: comissao,
      descricao: descricao,
      imagem: imagem,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Produto inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse produto");
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
  $("#modalInserirProduto").modal("hide");
}

//   Saida Produto     //

function SaidaProduto(id_pro, nome_pro) {
  window.saidaId = id_pro;
  document.getElementById("modalNovoSaidaLabel").innerHTML = nome_pro;
  $("#modalInserirSaida").modal("show");
}

function inserirSaida() {
  var quantidade = $("#novoSaidaQuant").val();
  var motivo = $("#novoSaidaMoti").val();

  var id_pro = window.saidaId;
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: {
      quantidade: quantidade,
      motivo: motivo,
      id_pro: id_pro,
      action: "inserirSaida",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Saida de Produto com sucesso!");
        $("#modalSucesso").modal("show");
      } else if (response.status === "estoque_insuficiente") {
        $("#textErro").text(
          "Produto com estoque abaixo da quantidade de saída"
        );
        $("#modalErro").modal("show");
      } else {
        $("#textErro").text("Não foi possível fazer a saída desse produto");
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
  $("#modalInserirSaida").modal("hide");
}

//   Entrada Produto     //

function entradaProduto(id_pro, nome_pro) {
  window.entradaId = id_pro;
  document.getElementById("modalNovoEntradaLabel").innerHTML = nome_pro;
  $("#modalInserirEntrada").modal("show");
}

function inserirEntrada() {
  var quantidade = $("#novoEntradaQuant").val();
  var motivo = $("#novoEntradaMoti").val();

  var id_pro = window.entradaId;
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: {
      quantidade: quantidade,
      motivo: motivo,
      id_pro: id_pro,
      action: "inserirEntrada",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Entrada de Produto com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível fazer a Entrada desse produto");
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
  $("#modalInserirEntrada").modal("hide");
}
