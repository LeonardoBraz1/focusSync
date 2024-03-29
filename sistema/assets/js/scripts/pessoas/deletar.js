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
    url: "../../controllers/UsuarioController.php",
    type: "POST",
    data: { id: id, action: "deletar" },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Usuário deletado com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possivel deletar esse Usuário");
        $("#modalErro").modal("show");
      }
      obterUsuarios();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterUsuarios();
  $("#modalDeletar").modal("hide");
}

function deletarFuncionario(id) {
  window.deletarFuncionarioId = id;

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
  var id = window.deletarFuncionarioId;

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: { id: id, action: "deletar" },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Funcionário deletado com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possivel deletar esse funcionário");
        $("#modalErro").modal("show");
      }
      obterFuncionarios();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterFuncionarios();
  $("#modalDeletarFun").modal("hide");
}

function deletarFornecedor(id_fornecedo) {
  window.deletarFornecedorId = id_fornecedo;

  $(".modal-titleForn").text("Deletar Fornecedor");
  $("#textDeletarForn").text(
    "Você tem certeza de que deseja deletar este fornecedor?"
  );
  $("#textDeletarForn1").text(
    "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
  );
  $("#modalDeletarForn").modal("show");
}

function btnDeletarFornecedor() {
  var id_fornecedo = window.deletarFornecedorId;

  $.ajax({
    url: "../../controllers/FornecedorController.php",
    type: "POST",
    data: { id_fornecedo: id_fornecedo, action: "deletar" },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Fornecedor deletado com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possivel deletar esse Fornecedor");
        $("#modalErro").modal("show");
      }
      obterFornecedores();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterFornecedores();
  $("#modalDeletarForn").modal("hide");
}

function deletarCliente(id_cliente) {
  window.deletarClienteId = id_cliente;

  $(".modal-titleClien").text("Deletar Cliente");
  $("#textDeletarClien").text(
    "Você tem certeza de que deseja deletar este cliente?"
  );
  $("#textDeletarClien1").text(
    "Esta ação não poderá ser desfeita e todos os dados associados a ele serão permanentemente removidos."
  );
  $("#modalDeletarClien").modal("show");
}

function btnDeletarCliente() {
  var id_cliente = window.deletarClienteId;

  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: { id_cliente: id_cliente, action: "deletar" },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Cliente deletado com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possivel deletar esse cliente");
        $("#modalErro").modal("show");
      }
      obterClientes();
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  obterClientes();
  $("#modalDeletarClien").modal("hide");
}
