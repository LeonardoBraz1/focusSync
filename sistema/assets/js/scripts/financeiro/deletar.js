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
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterCompras();
    $("#modalDeletarCompra").modal("hide");
  }