$(document).ready(function () {
  var currentDate1 = new Date();
  var startDate1 = new Date(currentDate1);
  startDate1.setDate(startDate1.getDate() - 3);

  $('input[type="date"]').eq(0).val(formatDate(startDate1));
  $('input[type="date"]').eq(1).val(formatDate(currentDate1));

  $('input[type="date"]').change(function () {
    var startDateValue1 = $('input[type="date"]').eq(0).val();
    var endDateValue1 = $('input[type="date"]').eq(1).val();

    if (startDateValue1 && endDateValue1) {
      mostrarSpinner();

      obterContas();
    }
  });
});

function obterContas() {
  var startDate1 = $('input[type="date"]').eq(0).val();
  var endDate1 = $('input[type="date"]').eq(1).val();

  $.ajax({
    url: "../../controllers/ContasAPagarController.php",
    type: "POST",
    data: { action: "obterContas", startDate1: startDate1, endDate1: endDate1 },
    dataType: "html",
    success: function (response) {
      $("#sampleTable").DataTable().destroy();
      $("#ContasAPagarTableBody").html(response);

      $("#sampleTable").DataTable();

      ocultarSpinner();
    },
    error: function () {
      alert("Ocorreu um erro ao obter as contas.");
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
  $("#loadingIndicator14").show();
}

function ocultarSpinner() {
  $("#loadingIndicator14").hide();
}
