function editarUsuario(id, nome, email, id_nivel, ativo, senha) {
  // Preencher campos da modal
  $("#editUsuarioId").val(id);
  $("#editUsuarioEmail").val(email);
  $("#editUsuarioNome").val(nome);
  $("#editUsuarioNivel").val(id_nivel);
  $("#editUsuarioAti").val(ativo);
  $("#editUsuarioSenha").val(senha);

  // Abrir modal de edição
  $("#modalEditarUsuario").modal("show");
}

function salvarEdicaoUsuario() {
  // Obter os dados da modal
  var id = $("#editUsuarioId").val();
  var email = $("#editUsuarioEmail").val();
  var nome = $("#editUsuarioNome").val();
  var id_nivel = $("#editUsuarioNivel").val();
  var ativo = $("#editUsuarioAti").val();
  var senha = $("#editUsuarioSenha").val();

  // Código AJAX para enviar os dados para o servidor
  $.ajax({
    url: "../controllers/UsuarioController.php",
    type: "POST",
    data: {
      id: id,
      email: email,
      nome: nome,
      id_nivel: id_nivel,
      ativo: ativo,
      senha: senha,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Usuário editado com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); // Recarrega a página
        });
      } else {
        $("#textErro").text("Não foi possivel editar esse Usuário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalEditarUsuario").modal("hide");
}

function editarFuncionario(id, nome, email, id_nivel, cpf, comissao, atendimento, endereco, cidade, tipoPix, pix) {
  // Preencher campos da modal
  $("#editFuncionarioId").val(id);
  $("#editFuncionarioNome").val(nome);
  $("#editFuncionarioEmail").val(email);
  $("#editFuncionarioNivel").val(id_nivel);
  $("#editFuncionarioCpf").val(cpf);
  $("#editFuncionarioCom").val(comissao);
  $("#editFuncionarioAten").val(atendimento);
  $("#editFuncionarioEnd").val(endereco);
  $("#editFuncionarioCid").val(cidade);
  $("#editFuncionarioTipo").val(tipoPix);
  $("#editFuncionarioPix").val(pix);

  // Abrir modal de edição
  $("#modalEditarFuncionario").modal("show");
}

function salvarEdicaoFuncionario() {
  // Obter os dados da modal
  var id = $("#editFuncionarioId").val();
  var nome = $("#editFuncionarioNome").val();
  var email = $("#editFuncionarioEmail").val();
  var id_nivel = $("#editFuncionarioNivel").val();
  var cpf = $("#editFuncionarioCpf").val();
  var comissao = $("#editFuncionarioCom").val();
  var atendimento = $("#editFuncionarioAten").val();
  var endereco = $("#editFuncionarioEnd").val();
  var cidade = $("#editFuncionarioCid").val();
  var tipoPix = $("#editFuncionarioTipo").val();
  var pix = $("#editFuncionarioPix").val();

  // Código AJAX para enviar os dados para o servidor
  $.ajax({
    url: "../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id: id,
      nome: nome,
      email: email,
      id_nivel: id_nivel,
      cpf: cpf,
      comissao: comissao,
      atendimento: atendimento,
      endereco: endereco,
      cidade: cidade,
      tipoPix: tipoPix,
      pix: pix,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Funcionário editado com sucesso!");
        $("#modalSucesso").modal("show");

        $("#modalSucesso").on("hidden.bs.modal", function () {
          location.reload(); // Recarrega a página
        });
      } else {
        $("#textErro").text("Não foi possivel editar esse Funcionário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalEditarFuncionario").modal("hide");
}
