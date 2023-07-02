// Serviço //

function deletarServico(id_servico) {
    window.deletarServicoId = id_servico;
  
    $(".modal-titleServico").text("Deletar Serviço");
    $("#textDeletarServico").text(
      "Você tem certeza de que deseja deletar este serviço?"
    );
    $("#textDeletarServico1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
    );
    $("#modalDeletarServico").modal("show");
  }
  
  function btnDeletarServico() {
  
    var id_servico = window.deletarServicoId;
  
    $.ajax({
      url: "../../controllers/ServicoController.php",
      type: "POST",
      data: { id_servico: id_servico, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Serviço deletado com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse serviço");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterServicos();
    $("#modalDeletarServico").modal("hide");
  }


// Cargos //



function deletarCargo(id_nivel) {
    window.deletarCargoId = id_nivel;
  
    $(".modal-titleCargo").text("Deletar cargo");
    $("#textDeletarCargo").text(
      "Você tem certeza de que deseja deletar este cargo?"
    );
    $("#textDeletarCargo1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
    );
    $("#modalDeletarCargo").modal("show");
  }
  
  function btnDeletarCargo() {
  
    var id_nivel = window.deletarCargoId;
  
    $.ajax({
      url: "../../controllers/CargoController.php",
      type: "POST",
      data: { id_nivel: id_nivel, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Cargo deletado com sucesso!");
          $("#modalSucesso").modal("show");
  
          
        } else {
          $("#textErro").text("Não foi possivel deletar esse cargo");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterCargos();
    $("#modalDeletarCargo").modal("hide");
  }


  //  Produto   //


  function deletarProduto(id_pro) {
    window.deletarProdutoId = id_pro;
  
    $(".modal-titleProduto").text("Deletar Produto");
    $("#textDeletarProduto").text(
      "Você tem certeza de que deseja deletar este produto?"
    );
    $("#textDeletarProduto1").text(
      "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
    );
    $("#modalDeletarProduto").modal("show");
  }
  
  function btnDeletarProduto() {
  
    var id_pro = window.deletarProdutoId;
  
    $.ajax({
      url: "../../controllers/ProdutoController.php",
      type: "POST",
      data: { id_pro: id_pro, action: 'deletar' },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Produto deletado com sucesso!");
          $("#modalSucesso").modal("show");
  
        } else {
          $("#textErro").text("Não foi possivel deletar esse produto");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    obterProdutos();
    $("#modalDeletarProduto").modal("hide");
  }