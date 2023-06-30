$(document).ready(function() {
    obterUsuarios();
});

function obterUsuarios() {
    $.ajax({
      url: "../../controllers/UsuarioController.php",
      type: "POST",
      data: { action: "obterUsuarios" },
      success: function (response) {
        // Limpar a tabela antes de carregar os dados
        $(".tabelaUsuarios tbody").empty();
  
        // Adicionar os usuários à tabela
        var usuarios = JSON.parse(response);
        for (var i = 0; i < usuarios.length; i++) {
          var usuario = usuarios[i];
          var row = `<tr>
            <td style="display: none;">${usuario.id}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.email}</td>
            <td>${usuario.cargo}</td>
            <td>${usuario.ativo}</td>
            <td style="display: flex; justify-content: center; align-items: center; gap: 7px;">
              <label style="cursor: pointer;" for="btnEditarUsuario-${usuario.id}"><i title="Editar" class="fa fa-solid fa-pencil fa-lg" style="color: #007bff;"></i></label>
              <input style="display: none;" type="button" onclick="editarUsuario(${usuario.id})" id="btnEditarUsuario-${usuario.id}">
              <label style="cursor: pointer;" for="btnDeletarUsuario-${usuario.id}"><i title="Deletar" class="fa fa-solid fa-trash fa-lg" style="color: #bd0000;"></i></label>
              <input style="display: none;" type="button" onclick="deletarUsuario(${usuario.id})" id="btnDeletarUsuario-${usuario.id}">
            </td>
          </tr>`;
          $(".tabelaUsuarios tbody").append(row);
        }

        console.log(usuario);
      },
      error: function () {
        alert("Ocorreu um erro ao obter os usuários.");
      },
    });
  }
