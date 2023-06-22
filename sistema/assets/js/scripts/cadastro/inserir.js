

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