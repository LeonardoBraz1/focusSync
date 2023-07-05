//  Venda   //


function deletarVenda(id_venda) {
    window.deletarVendaId = id_venda;
  
    $(".modal-titleVenda").text("Deletar Venda");
    $("#textDeletarVenda").text(
      "Você tem certeza de que deseja deletar este venda?"
    );
    $("#textDeletarVenda1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
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