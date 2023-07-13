$(document).ready(function () {
  mostrarSpinner();
  obterClientes();
});

function obterClientes() {
  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: {
      action: "obterClientesRetorno",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var clientesRetornos = JSON.parse(response);
      var clientesRetornosTableBody = $("#clientesRetornosTableBody");

      clientesRetornosTableBody.empty();

      for (var i = 0; i < clientesRetornos.length; i++) {
        var clientesRetorno = clientesRetornos[i];
        var row = $("<tr>");

        row.append(
          "<td style='display: none;'>" + clientesRetorno.id_cliente + "</td>"
        );
        row.append("<td>" + clientesRetorno.nome_cliente + "</td>");
        row.append("<td>" + clientesRetorno.telefone_cliente + "</td>");
        row.append("<td>" + clientesRetorno.cadastro + "</td>");
        row.append("<td>" + clientesRetorno.ultimo_servico + "</td>");
        row.append("<td>" + clientesRetorno.retorno + "</td>");
        row.append("<td>" + clientesRetorno.dias_sem_retorno + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnWhat2-" +
            clientesRetorno.id_cliente +
            "'><a href='https://api.whatsapp.com/send?phone=" +
            clientesRetorno.telefone_formatado +
            "&text=" +
            encodeURIComponent(clientesRetorno.message) +
            "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" +
            clientesRetorno.id_cliente +
            ")' type='button' class='btnWhat' id='btnWhat2-" +
            clientesRetorno.id_cliente +
            "' data-id='" +
            clientesRetorno.id_cliente +
            "'>"
        );

        row.append(actions);
        clientesRetornosTableBody.append(row);
      }

      $("#sampleTable").DataTable();
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os clientes.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator12").show();
}

function ocultarSpinner() {
  $("#loadingIndicator12").hide();
}
