$(document).ready(function () {
  var currentDate = new Date();
  var startDate = new Date(currentDate);
  startDate.setDate(startDate.getDate() - 3);

  $('input[type="date"]').eq(0).val(formatDate(startDate));
  $('input[type="date"]').eq(1).val(formatDate(currentDate));

  $('input[type="date"]').change(function () {
    var startDateValue = $('input[type="date"]').eq(0).val();
    var endDateValue = $('input[type="date"]').eq(1).val();

    if (startDateValue && endDateValue) {
      mostrarSpinner();

      obterVendas();
    }
  });
});

function obterVendas() {
  var startDate = $('input[type="date"]').eq(0).val();
  var endDate = $('input[type="date"]').eq(1).val();

  $.ajax({
    url: "../../controllers/VendaController.php",
    type: "POST",
    data: { action: "obterVendas", startDate: startDate, endDate: endDate },
    dataType: "html",
    success: function (response) {
      $("#sampleTable").DataTable().destroy();
      $("#vendasTableBody").html(response);

      $("#sampleTable").DataTable();

      ocultarSpinner();
    },
    error: function () {
      alert("Ocorreu um erro ao obter as vendas.");
      ocultarSpinner();
    },
  });
}

// Função para formatar a data no formato "YYYY-MM-DD"
function formatDate(date) {
  var year = date.getFullYear();
  var month = ("0" + (date.getMonth() + 1)).slice(-2);
  var day = ("0" + date.getDate()).slice(-2);
  return year + "-" + month + "-" + day;
}

function mostrarSpinner() {
  $("#loadingIndicator").show();
  $("#loadingIndicator1").show();
}

function ocultarSpinner() {
  $("#loadingIndicator").hide();
  $("#loadingIndicator1").hide();
}
