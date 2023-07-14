$(document).ready(function () {
  mostrarSpinner();
  obterFornecedores();
});

function obterFornecedores() {
  $.ajax({
    url: "../../controllers/FornecedorController.php",
    type: "POST",
    data: { action: "obterFornecedores" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var fornecedores = JSON.parse(response);
      var fornecedoresTableBody = $("#fornecedoresTableBody");

      fornecedoresTableBody.empty();

      for (var i = 0; i < fornecedores.length; i++) {
        var fornecedor = fornecedores[i];
        var row = $("<tr>");

        row.append(
          "<td style='display: none;'>" + fornecedor.id_fornecedo + "</td>"
        );
        row.append("<td>" + fornecedor.nome_fornecedo + "</td>");
        row.append("<td>" + fornecedor.email_fornecedo + "</td>");
        row.append("<td>" + fornecedor.telefone_fornecedo + "</td>");
        row.append("<td>" + fornecedor.pontuacao_fornecedo + "</td>");
        row.append("<td>" + fornecedor.data_cadastro + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnEditarForne-" +
            fornecedor.id_fornecedo +
            "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnEditarForne'  onclick='editarFornecedor(" +
            fornecedor.id_fornecedo +
            ', "' +
            fornecedor.nome_fornecedo +
            '", "' +
            fornecedor.email_fornecedo +
            '", "' +
            fornecedor.telefone_fornecedo +
            '", "' +
            fornecedor.pontuacao_fornecedo +
            '", "' +
            fornecedor.endereco_fornecedo +
            '", "' +
            fornecedor.cidade_fornecedo +
            '", "' +
            fornecedor.site_fornecedo +
            "\")' id='btnEditarForne-" +
            fornecedor.id_fornecedo +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnVerForne-" +
            fornecedor.id_fornecedo +
            "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnVerForne'  onclick='verFornecedor(" +
            fornecedor.id_fornecedo +
            ', "' +
            fornecedor.nome_fornecedo +
            '", "' +
            fornecedor.email_fornecedo +
            '", "' +
            fornecedor.telefone_fornecedo +
            '", "' +
            fornecedor.pontuacao_fornecedo +
            '", "' +
            fornecedor.endereco_fornecedo +
            '", "' +
            fornecedor.cidade_fornecedo +
            '", "' +
            fornecedor.site_fornecedo +
            '", "' +
            fornecedor.data_cadastro +
            "\")' id='btnVerForne-" +
            fornecedor.id_fornecedo +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDeletarForne-" +
            fornecedor.id_fornecedo +
            "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='deletarFornecedor(" +
            fornecedor.id_fornecedo +
            ")' id='btnDeletarForne-" +
            fornecedor.id_fornecedo +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnWhat1-" +
            fornecedor.id_fornecedo +
            "'><a href='https://api.whatsapp.com/send?phone=" +
            fornecedor.telefone_fornecedo +
            "&text=" +
            encodeURIComponent(fornecedor.message) +
            "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" +
            fornecedor.id_fornecedo +
            ")' type='button' class='btnWhat' id='btnWhat-" +
            fornecedor.id_fornecedo +
            "' data-id='" +
            fornecedor.id_fornecedo +
            "'>"
        );

        row.append(actions);
        fornecedoresTableBody.append(row);
      }

      $("#sampleTable").DataTable();
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os fornecedores.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator10").show();
}

function ocultarSpinner() {
  $("#loadingIndicator10").hide();
}
