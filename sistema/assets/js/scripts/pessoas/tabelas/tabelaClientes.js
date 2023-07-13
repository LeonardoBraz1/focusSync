$(document).ready(function () {
  mostrarSpinner();
  obterClientes();
});

function obterClientes() {
  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: { action: "obterClientes" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var clientes = JSON.parse(response);
      var clientesTableBody = $("#clientesTableBody");

      clientesTableBody.empty();

      for (var i = 0; i < clientes.length; i++) {
        var cliente = clientes[i];
        var row = $("<tr>");

        row.append(
          "<td style='display: none;'>" + cliente.id_cliente + "</td>"
        );
        row.append("<td>" + cliente.nome_cliente + "</td>");
        row.append("<td>" + cliente.email_cliente + "</td>");
        row.append("<td>" + cliente.telefone_cliente + "</td>");
        row.append("<td>" + cliente.cadastro + "</td>");
        row.append("<td>" + cliente.retorno + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnEditarClien-" +
            cliente.id_cliente +
            "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' class='btnEditarClien' onclick='editarCliente(" +
            cliente.id_cliente +
            ', "' +
            cliente.nome_cliente +
            '", "' +
            cliente.email_cliente +
            '", "' +
            cliente.telefone_cliente +
            '", "' +
            cliente.data_cadastro +
            '", "' +
            cliente.retorno +
            "\")' id='btnEditarClien-" +
            cliente.id_cliente +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDeletarClien-" +
            cliente.id_cliente +
            "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='deletarCliente(" +
            cliente.id_cliente +
            ")' id='btnDeletarClien-" +
            cliente.id_cliente +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnWhat-" +
            cliente.id_cliente +
            "'><a href='https://api.whatsapp.com/send?phone=" +
            cliente.telefone_formatado +
            "&text=" +
            encodeURIComponent(cliente.message) +
            "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" +
            cliente.id_cliente +
            ")' type='button' class='btnWhat' id='btnWhat-" +
            cliente.id_cliente +
            "' data-id='" +
            cliente.id_cliente +
            "'>"
        );

        row.append(actions);
        clientesTableBody.append(row);
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
  $("#loadingIndicator2").show();
}

function ocultarSpinner() {
  $("#loadingIndicator2").hide();
}
