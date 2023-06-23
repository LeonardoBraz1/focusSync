
function editarServico(id_servico, nome_servico, preco, comissao, tempo) {
    // Preencher campos da modal
    $("#editServicoId").val(id_servico);
    $("#editServicoNome").val(nome_servico);
    $("#editServicoPrec").val(preco);
    $("#editServicoCom").val(comissao);
    $("#editServicoTemp").val(tempo);
  
    // Abrir modal de edição
    $("#modalEditarServico").modal("show");
  }
  
  function salvarEdicaoServico() {
    // Obter os dados da modal
    var id_servico = $("#editServicoId").val();
    var nome_servico = $("#editServicoNome").val();
    var preco = $("#editServicoPrec").val();
    var comissao = $("#editServicoCom").val();
    var tempo = $("#editServicoTemp").val();
  
    // Código AJAX para enviar os dados para o servidor
    $.ajax({
      url: "../../controllers/ServicoController.php",
      type: "POST",
      data: {
        id_servico: id_servico,
        nome_servico: nome_servico,
        preco: preco,
        comissao: comissao,
        tempo: tempo,
        action: "editar",
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "sucesso") {
          $("#textSucesso").text("Serviço editado com sucesso!");
          $("#modalSucesso").modal("show");
  
          $("#modalSucesso").on("hidden.bs.modal", function () {
            location.reload(); // Recarrega a página
          });
        } else {
          $("#textErro").text("Não foi possivel editar esse serviço");
          $("#modalErro").modal("show");
        }
      },
      error: function (xhr, status, error) {
        $("#textErro").text("Ao enviar os dados");
        $("#modalErro").modal("show");
      },
    });
    $("#modalEditarServico").modal("hide");
  }


  