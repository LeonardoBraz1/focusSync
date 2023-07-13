$(document).ready(function () {
  mostrarSpinner();
  obterCompras();
});

function obterCompras() {
  $.ajax({
    url: "../../controllers/CompraController.php",
    type: "POST",
    data: { action: "obterCompras" },
    dataType: "html",
    success: function (response) {
      $("#sampleTable").DataTable().destroy();
      $("#comprasTableBody").html(response);

      $("#sampleTable").DataTable();

      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter as compras.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator2").show();
}

function ocultarSpinner() {
  $("#loadingIndicator2").hide();
}
