$(document).ready(function () {
  mostrarSpinner();
  obterSaidas();
});

function obterSaidas() {
  $.ajax({
    url: "../../controllers/ProdutoController.php",
    type: "POST",
    data: { action: "obterSaidas" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var saidas = JSON.parse(response);
      var saidasTableBody = $("#saidasTableBody");

      saidasTableBody.empty();

      for (var i = 0; i < saidas.length; i++) {
        var saida = saidas[i];
        var row = $("<tr>");

        row.append("<td style='display: none;'>" + saida.id_saida + "</td>");
        row.append(
          "<td><img src='" +
            saida.imagemSrc +
            "' alt='Imagem do Produto' style='max-width: 30px;'>" +
            saida.nome_pro +
            "</td>"
        );
        row.append("<td>" + saida.quantidade + "</td>");
        row.append("<td>" + saida.motivo_saida + "</td>");
        row.append("<td>" + saida.data_saida + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnVerSaida-" +
            saida.id_saida +
            "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnVerSaida'  onclick='verSaida(" +
           saida.id_saida +
            ', "' +
           saida.nome_pro +
            '", "' +
           saida.quantidade +
            '", "' +
           saida.data_saida +
            '", "' +
           saida.motivo_saida +
            '", "' +
            saida.imagemSrc +
            "\")' id='btnVerSaida-" +
           saida.id_saida +
            "'>"
        );

        row.append(actions);
        saidasTableBody.append(row);
      }

      // Inicializar a tabela DataTables
      $("#sampleTable").DataTable();

      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter as saídas.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator5").show();
}

function ocultarSpinner() {
  $("#loadingIndicator5").hide();
}
