
      $(document).ready(function() {
        obterVendas();
      });
      
      function obterVendas() {
      
        $.ajax({
          url: "../../controllers/VendaController.php",
          type: "POST",
          data: { action: "obterVendas" },
          dataType: "html",
          success: function(response) {
            $("#sampleTable").DataTable().destroy();
            $("#vendasTableBody").html(response);
      
            // Inicializar a tabela DataTables
            $("#sampleTable").DataTable();
          },
          error: function() {
            alert("Ocorreu um erro ao obter as vendas.");
          },
        });
      }
