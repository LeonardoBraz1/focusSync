$(document).ready(function () {
  mostrarSpinner();
  obterFuncionarios();
});

function obterFuncionarios() {
  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: { action: "obterFuncionarios" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var funcionarios = JSON.parse(response);
      var funcionariosTableBody = $("#funcionariosTableBody");

      funcionariosTableBody.empty();

      for (var i = 0; i < funcionarios.length; i++) {
        var funcionario = funcionarios[i];
        var row = $("<tr>");

        row.append("<td style='display: none;'>" + funcionario.id + "</td>");
        row.append("<td>" + funcionario.nome + "</td>");
        row.append("<td>" + funcionario.email + "</td>");
        row.append("<td>" + funcionario.cargo + "</td>");
        row.append("<td>" + funcionario.cpf + "</td>");
        row.append("<td>" + funcionario.cadastro + "</td>");
        row.append("<td>" + funcionario.comissao + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnEditarFunc-" +
            funcionario.id +
            "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='editarFuncionario(" +
            funcionario.id +
            ', "' +
            funcionario.nome +
            '", "' +
            funcionario.email +
            '", "' +
            funcionario.id_nivel +
            '", "' +
            funcionario.cpf +
            '", "' +
            funcionario.comissao +
            '", "' +
            funcionario.atendimento +
            '", "' +
            funcionario.endereco +
            '", "' +
            funcionario.cidade +
            '", "' +
            funcionario.tipoPix +
            '", "' +
            funcionario.pix +
            "\")' id='btnEditarFunc-" +
            funcionario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnVerFunc-" +
            funcionario.id +
            "'><i title='Ver Dados' class='icon fa fa-eye fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='verFuncionario(" +
            funcionario.id +
            ', "' +
            funcionario.nome +
            '", "' +
            funcionario.email +
            '", "' +
            funcionario.id_nivel +
            '", "' +
            funcionario.cpf +
            '", "' +
            funcionario.comissao +
            '", "' +
            funcionario.atendimento +
            '", "' +
            funcionario.endereco +
            '", "' +
            funcionario.cidade +
            '", "' +
            funcionario.tipoPix +
            '", "' +
            funcionario.pix +
            '", "' +
            funcionario.cadastro +
            "\")' id='btnVerFunc-" +
            funcionario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDeletarFunc-" +
            funcionario.id +
            "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='deletarFuncionario(" +
            funcionario.id +
            ")' id='btnDeletarFunc-" +
            funcionario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDiaFunc-" +
            funcionario.id +
            "'><i class='fa fa-solid fa-calendar fa-lg' style='color: #6a81a9;'></i></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' type='button' onclick='btnInserirDiaSemana(" +
            funcionario.id +
            ")' class='btnDiaFunc1' id='btnDiaFunc-" +
            funcionario.id +
            "' data-id='" +
            funcionario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnServFunc-" +
            funcionario.id +
            "'><a href='https://api.whatsapp.com/send?phone=" +
            funcionario.telefone +
            "&text=" +
            encodeURIComponent(funcionario.message) +
            "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" +
            funcionario.id +
            ")' type='button' class='btnWhat' id='btnWhat-" +
            funcionario.id +
            "' data-id='" +
            funcionario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnServFunc-" +
            funcionario.id +
            "'><i class='fa fa-solid fa-briefcase fa-lg' style='color: #334a70;'></i></label>"
        );
        actions.append(
          "<input style='display: none; pointer-events: none; opacity: 0;' onclick='btnInserirServ(" +
            funcionario.id +
            ")' type='button' class='btnServFunc1' id='btnServFunc-" +
            funcionario.id +
            "' data-id='" +
            funcionario.id +
            "'>"
        );

        row.append(actions);
        funcionariosTableBody.append(row);
      }

      $("#sampleTable").DataTable();
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os funcionários.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator9").show();
}

function ocultarSpinner() {
  $("#loadingIndicator9").hide();
}
