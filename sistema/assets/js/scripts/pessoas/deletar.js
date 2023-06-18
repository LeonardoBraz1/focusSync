function deletarUsuario(id) {
  window.deletarUsuarioId = id;

  $(".modal-title1").text("Deletar Usuário");
  $("#textDeletar").text(
    "Você tem certeza de que deseja deletar este usuário?"
  );
  $("#textDeletar1").text(
    "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
  );
  $("#modalDeletar").modal("show");
}

function btnDeletarUsuario() {

  var id = window.deletarUsuarioId;

  $.ajax({
    url: "../controllers/UsuarioController.php",
    type: "POST",
    data: { id: id, action: 'deletar' },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Usuário deletado com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); 
        });
      } else {
        $("#textErro").text("Não foi possivel deletar esse Usuário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalDeletar").modal("hide");
}




function deletarFuncionario(id) {
  window.deletarUsuarioId = id;

  $(".modal-titleF").text("Deletar funcionario");
  $("#textDeletarF").text(
    "Você tem certeza de que deseja deletar este funcionário?"
  );
  $("#textDeletarF1").text(
    "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
  );
  $("#modalDeletarFun").modal("show");
}

function btnDeletarFuncionario() {

  var id = window.deletarUsuarioId;

  $.ajax({
    url: "../controllers/FuncionarioController.php",
    type: "POST",
    data: { id: id, action: 'deletar' },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Usuário deletado com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); 
        });
      } else {
        $("#textErro").text("Não foi possivel deletar esse Usuário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalDeletarFun").modal("hide");
}
