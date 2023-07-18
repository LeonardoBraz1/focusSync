//    venda    //

function btnInserirVenda() {
  $("#modalInserirVenda").modal("show");
}

function inserirVenda() {
  var id_pro = $("#novaVendaPro").val();
  var id_user = $("#novaVendaUser").val();
  var id_cli = $("#novaVendaCliente").val();
  var quantidade = $("#novaVendaQuant").val();
  var venTotal = $("#novaVendaTota").val();
  var dataPaga = $("#novaVendaPaga").val();
  var formapaga = $("#novaVendaFpaga").val();
  $.ajax({
    url: "../../controllers/VendaController.php",
    type: "POST",
    data: {
      id_pro: id_pro,
      id_user: id_user,
      id_cli: id_cli,
      quantidade: quantidade,
      venTotal: venTotal,
      dataPaga: dataPaga,
      formapaga: formapaga,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Venda efetuada com sucesso!");
        $("#modalSucesso").modal("show");
      } else if (response.status === "estoque_insuficiente") {
        $("#textErro").text(
          "Produto com estoque abaixo da quantidade de venda"
        );
        $("#modalErro").modal("show");
      } else {
        $("#textErro").text("Não foi possível efetuar essa venda");
        $("#modalErro").modal("show");
      }
      obterVendas();
    },
    error: function (xhr, status, error) {
      console.log(xhr, status, error);
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterVendas();
  $("#modalInserirVenda").modal("hide");
}

//    compra   //

function btnInserirCompra() {
  $("#modalInserirCompra").modal("show");
}

function inserirCompra() {
  var id_pro = $("#novaCompraPro").val();
  var id_fornecedo = $("#novaCompraFor").val();
  var valor_unitario = $("#novaCompraUnit").val();
  var quantidade = $("#novaCompraQuant1").val();
  var venTotal = $("#novaCompraTota1").val();
  var dataPaga = $("#novaCompraPaga1").val();
  var formapaga = $("#novaCompraFpaga1").val();

  $.ajax({
    url: "../../controllers/CompraController.php",
    type: "POST",
    data: {
      id_pro: id_pro,
      id_fornecedo: id_fornecedo,
      valor_unitario: valor_unitario,
      quantidade: quantidade,
      venTotal: venTotal,
      dataPaga: dataPaga,
      formapaga: formapaga,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Compra efetuada com sucesso!");
        $("#modalSucesso").modal("show");
       
      } else {
        $("#textErro").text("Não foi possível efetuar essa Compra");
        $("#modalErro").modal("show");
      } 
      obterCompras();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterCompras();
  $("#modalInserirCompra").modal("hide");
}







//    conta a receber   //

function btnInserirContaAPagar() {
  $("#modalInserirContaAPagar").modal("show");
}

function inserirContaAPagar() {
  var descricao = $("#novaPagarDesc").val();
  var valor = $("#novaPagarValor").val();
  var dataPaga = $("#novaPagarPaga").val();
  var id_fornecedo = $("#novaPagarFor").val();
  var id_usuario = $("#novaPagarUser").val();

  $.ajax({
    url: "../../controllers/ContasAPagarController.php",
    type: "POST",
    data: {
      descricao: descricao,
      id_fornecedo: id_fornecedo,
      id_usuario: id_usuario,
      valor: valor,
      dataPaga: dataPaga,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Conta inserida com sucesso!");
        $("#modalSucesso").modal("show");
       
      } else {
        $("#textErro").text("Não foi possível inserir essa conta");
        $("#modalErro").modal("show");
      } 
      obterContas();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterContas();
  $("#modalInserirContaAPagar").modal("hide");
}




//    conta a receber   //

function btnInserirContaAReceber() {
  $("#modalInserirContaAReceber").modal("show");
}

function inserirContaAReceber() {
  var descricao = $("#novaReceberDesc").val();
  var id_cliente = $("#novaReceberClie").val();
  var valor = $("#novaReceberValor").val();
  var dataPaga = $("#novaReceberPaga").val();

  $.ajax({
    url: "../../controllers/ContasAReceberController.php",
    type: "POST",
    data: {
      descricao: descricao,
      id_cliente: id_cliente,
      valor: valor,
      dataPaga: dataPaga,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Conta inserida com sucesso!");
        $("#modalSucesso").modal("show");
       
      } else {
        $("#textErro").text("Não foi possível inserir essa conta");
        $("#modalErro").modal("show");
      } 
      obterContasReceber();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterContasReceber();
  $("#modalInserirContaAReceber").modal("hide");
}
