$(document).ready(function() {
  obterServicos();
});

function obterServicos() {
  $.ajax({
    url: "../../controllers/ServicoController.php",
    type: "POST",
    data: { action: "obterServicos" },
    dataType: "json",
    success: function(response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }

      $("#sampleTable").DataTable().destroy();
      var servicos = JSON.parse(response);
      var servicosTableBody = $("#servicosTableBody");

      servicosTableBody.empty();

        for (var i = 0; i < servicos.length; i++) {
          var servico = servicos[i];
          var row = $("<tr>");

          row.append("<td style='display: none;'>" + servico.id_servico + "</td>");
          row.append("<td>" + servico.nome_servico + "</td>");
          row.append("<td>R$ " + servico.preco + "</td>");
          row.append("<td>" + servico.comissao + "</td>");
          row.append("<td>" + servico.tempo + " Minutos</td>");
          row.append("<td>" + servico.data + "</td>");

          var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
          actions.append("<label style='cursor: pointer;' for='btnEditarServico-" + servico.id_servico + "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>");
          actions.append("<input style='display: none;' type='button' class='btnEditarServico1'  onclick='editarServico(" + servico.id_servico + ", \"" + servico.nome_servico + "\", \"" + servico.preco + "\", \"" + servico.comissao + "\", \"" + servico.tempo + "\")' id='btnEditarServico-" + servico.id_servico + "'>");
          actions.append("<label style='cursor: pointer;' for='btnDeletarServico-" + servico.id_servico + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
          actions.append("<input style='display: none;' type='button' onclick='deletarServico(" + servico.id_servico + ")' id='btnDeletarServico-" + servico.id_servico + "'>");

          row.append(actions);
          servicosTableBody.append(row);
        }

      // Inicializar a tabela DataTables
      $("#sampleTable").DataTable();
    },
    error: function() {
      alert("Ocorreu um erro ao obter os serviços da barbearia.");
    },
  });
}