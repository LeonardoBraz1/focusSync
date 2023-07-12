//   status  //

function statusVenda(
    id_venda, status
  ) {
    $("#editStatusId").val(id_venda);
    $("#novoStatus1").val(status);
    $("#modalEditarStatus").modal("show");
  }
  
  function salvarEdicaoStatus() {
    var id_venda = $("#editStatusId").val();
    var status = $("#novoStatus1").val();
  
    $.ajax({
      url: "../../controllers/VendaController.php",
      type: "POST",
      data: {
        id_venda: id_venda,
        status: status,
        action: "editarStatus",
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Status editado com sucesso!");
          $("#modalSucesso").modal("show");
  
          
        } else {
          $("#textErro").text("Não foi possível editar esse status");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterVendas();
    $("#modalEditarStatus").modal("hide");
  }



//   status pagamento  //

function statusCompra(
    id_compra, status_pagamento
  ) {
    $("#editStatusPagaId").val(id_compra);
    $("#novoStatusPaga").val(status_pagamento);
    $("#modalEditarStatusPagamento").modal("show");
  }
  
  function salvarEdicaoStatusPaga() {
    var id_compra = $("#editStatusPagaId").val();
    var status_pagamento = $("#novoStatusPaga").val();
  
    $.ajax({
      url: "../../controllers/CompraController.php",
      type: "POST",
      data: {
        id_compra: id_compra,
        status_pagamento: status_pagamento,
        action: "editarStatus",
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Status editado com sucesso!");
          $("#modalSucesso").modal("show");
  
          
        } else {
          $("#textErro").text("Não foi possível editar esse status");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterCompras();
    $("#modalEditarStatusPagamento").modal("hide");
  }
  