$(document).ready(function() {
    obterSaidas();
  });
  
  function obterSaidas() {
    $.ajax({
      url: "../../controllers/ProdutoController.php",
      type: "POST",
      data: { action: "obterSaidas" },
      dataType: "json",
      success: function(response) {
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
            row.append("<td><img src='" + saida.imagemSrc + "' alt='Imagem do Produto' style='max-width: 30px;'>" + saida.nome_pro + "</td>");
            row.append("<td>" + saida.quantidade + "</td>");
            row.append("<td>" + saida.motivo_saida + "</td>");
            row.append("<td>" + saida.data_saida + "</td>");
  
            saidasTableBody.append(row);
          }
  
        // Inicializar a tabela DataTables
        $("#sampleTable").DataTable();
      },
      error: function() {
        alert("Ocorreu um erro ao obter as saídas.");
      },
    });
  }