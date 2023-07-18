$(document).ready(function () {
  mostrarSpinner();
  obterEntradas();
});
function obterEntradas() {
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: {
      action: "obterEntradas",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }

      $("#sampleTable").DataTable().destroy();
      var entradas = JSON.parse(response);
      var entradasTableBody = $("#entradasTableBody");

      entradasTableBody.empty();

      for (var i = 0; i < entradas.length; i++) {
        var entrada = entradas[i];
        var row = $("<tr>");

        row.append(
          "<td style='display: none;'>" + entrada.id_entrada + "</td>"
        );
        row.append(
          "<td><img src='" +
            entrada.imagemSrc +
            "' alt='Imagem do Produto' style='max-width: 30px;'>" +
            entrada.nome_produto +
            "</td>"
        );
        row.append("<td>" + entrada.quantidade + "</td>");
        row.append("<td>" + entrada.motivo_entrada + "</td>");
        row.append("<td>" + entrada.data_entrada + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnVerEntrada-" +
            entrada.id_entrada +
            "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnVerEntrada'  onclick='verEntrada(" +
            entrada.id_entrada +
            ', "' +
            entrada.nome_produto +
            '", "' +
            entrada.quantidade +
            '", "' +
            entrada.motivo_entrada +
            '", "' +
            entrada.data_entrada +
            '", "' +
            entrada.imagemSrc +
            "\")' id='btnVerEntrada-" +
            entrada.id_entrada +
            "'>"
        );

        row.append(actions);
        entradasTableBody.append(row);
      }

      $("#sampleTable").DataTable();
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter as entradas.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator7").show();
}

function ocultarSpinner() {
  $("#loadingIndicator7").hide();
}
