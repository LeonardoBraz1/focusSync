//  Venda   //

function deletarVenda(id_venda) {
    window.deletarVendaId = id_venda;
  
    $(".modal-titleVenda").text("Deletar Venda");
    $("#textDeletarVenda").text(
      "Você tem certeza de que deseja deletar esta venda?"
    );
    $("#textDeletarVenda1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados serão permanentemente removidos."
    );
    $("#modalDeletarVenda").modal("show");
  }
  
  function btnDeletarVenda() {
  
    var id_venda = window.deletarVendaId;
  
    $.ajax({
      url: "../../controllers/VendaController.php",
      type: "POST",
      data: { id_venda: id_venda, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Venda deletado com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse venda");
          $("#modalErro").modal("show");
        }
        obterVendas();
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterVendas();
    $("#modalDeletarVenda").modal("hide");
  }





//  compra  //

function deletarCompra(id_compra) {
    window.deletarCompraId = id_compra;
  
    $(".modal-titleCompra").text("Deletar Compra");
    $("#textDeletarCompra").text(
      "Você tem certeza de que deseja deletar esta compra?"
    );
    $("#textDeletarCompra1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados serão permanentemente removidos."
    );
    $("#modalDeletarCompra").modal("show");
  }
  
  function btnDeletarCompra() {
  
    var id_compra = window.deletarCompraId;
  
    $.ajax({
      url: "../../controllers/CompraController.php",
      type: "POST",
      data: { id_compra: id_compra, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Compra deletado com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse compra");
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
    $("#modalDeletarCompra").modal("hide");
  }






//  contas a pagar  //

function deletarContaPagar(id_conta) {
    window.deletarContaId = id_conta;
  
    $(".modal-titlePagar").text("Deletar Conta");
    $("#textDeletarPagar").text(
      "Você tem certeza de que deseja deletar esta conta?"
    );
    $("#textDeletarPagar1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados serão permanentemente removidos."
    );
    $("#modalDeletarContaAPagar").modal("show");
  }
  
  function btnDeletarContaAPagar() {
  
    var id_conta = window.deletarContaId;
  
    $.ajax({
      url: "../../controllers/ContasAPagarController.php",
      type: "POST",
      data: { id_conta: id_conta, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Conta deletada com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse conta");
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
    $("#modalDeletarContaAPagar").modal("hide");
  }







//  contas a receber  //

function deletarContaReceber(id_receber) {
    window.deletarReceberId = id_receber;
  
    $(".modal-titleReceber").text("Deletar Conta");
    $("#textDeletarReceber").text(
      "Você tem certeza de que deseja deletar esta conta?"
    );
    $("#textDeletarReceber1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados serão permanentemente removidos."
    );
    $("#modalDeletarContaAReceber").modal("show");
  }
  
  function btnDeletarReceber() {
  
    var id_receber = window.deletarCompraId;
  
    $.ajax({
      url: "../../controllers/ContasAReceberController.php",
      type: "POST",
      data: { id_receber: id_receber, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Conta deletada com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse conta");
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
    $("#modalDeletarContaAReceber").modal("hide");
  }