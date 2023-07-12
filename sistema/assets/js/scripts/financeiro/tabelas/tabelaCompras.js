$(document).ready(function () {
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
      },
      error: function () {
        alert("Ocorreu um erro ao obter as compras.");
      },
    });
  }
  