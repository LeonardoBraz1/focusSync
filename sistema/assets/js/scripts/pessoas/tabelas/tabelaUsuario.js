$(document).ready(function () {
  mostrarSpinner();
  obterUsuarios();
});

function obterUsuarios() {
  $.ajax({
    url: "../../controllers/UsuarioController.php",
    type: "POST",
    data: { action: "obterUsuarios" },
    dataType: "json",
    success: function (response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var usuarios = JSON.parse(response);
      var usuariosTableBody = $("#usuariosTableBody");

      usuariosTableBody.empty();

      for (var i = 0; i < usuarios.length; i++) {
        var usuario = usuarios[i];
        var row = $("<tr>");

        row.append("<td style='display: none;'>" + usuario.id + "</td>");
        row.append("<td>" + usuario.nome + "</td>");
        row.append("<td>" + usuario.email + "</td>");
        row.append("<td>" + usuario.cargo + "</td>");
        row.append("<td>" + usuario.ativo + "</td>");
        row.append("<td>" + usuario.senha + "</td>");

        var actions = $(
          "<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnEditarUsuario-" +
            usuario.id +
            "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='editarUsuario(" +
            usuario.id +
            ', "' +
            usuario.nome +
            '", "' +
            usuario.email +
            '", "' +
            usuario.id_nivel +
            '", "' +
            usuario.ativo +
            '", "' +
            usuario.senha +
            "\")' id='btnEditarUsuario-" +
            usuario.id +
            "'>"
        );
        actions.append(
          "<label style='cursor: pointer;' for='btnDeletarUsuario-" +
            usuario.id +
            "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>"
        );
        actions.append(
          "<input style='display: none;' type='button' onclick='deletarUsuario(" +
            usuario.id +
            ")' id='btnDeletarUsuario-" +
            usuario.id +
            "'>"
        );

        row.append(actions);
        usuariosTableBody.append(row);
      }

      $("#sampleTable").DataTable();
      ocultarSpinner();
    },
    error: function () {
      ocultarSpinner();
      alert("Ocorreu um erro ao obter os usuários.");
    },
  });
}

function mostrarSpinner() {
  $("#loadingIndicator8").show();
}

function ocultarSpinner() {
  $("#loadingIndicator8").hide();
}
