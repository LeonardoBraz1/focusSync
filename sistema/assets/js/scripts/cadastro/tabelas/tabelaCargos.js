$(document).ready(function () {
  mostrarSpinner();
  obterCargos();
});

function obterCargos() {
  $.ajax({
    url: "../../controllers/CargoController.php",
    type: "POST",
    data: {
      action: "obterCargos",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var cargos = JSON.parse(response);
      var cargosTableBody = $("#cargosTableBody");

      cargosTableBody.empty();

      for (var i = 0; i < cargos.length; i++) {
        var cargo = cargos[i];
        var row = $("<tr>");

        row.append("<td style='display: none;'>" + cargo.id_nivel + "</td>");
        row.append("<td>" + cargo.nome_nivel + "</td>");
        row.append("<td>" + cargo.data + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDeletarCargo-" +
            cargo.id_nivel +
            "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnDeletarCargo' onclick='deletarCargo(" +
            cargo.id_nivel +
            ")' id='btnDeletarCargo-" +
            cargo.id_nivel +
            "'>"
        );

        row.append(actions);
        cargosTableBody.append(row);
      }

      $("#sampleTable").DataTable();

      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os cargos.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator4").show();
}

function ocultarSpinner() {
  $("#loadingIndicator4").hide();
}
