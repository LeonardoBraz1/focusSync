
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
    url: "../../controllers/UsuarioController.php",
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

          obterUsuarios();
        
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
    url: "../../controllers/FuncionarioController.php",
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

        obterFuncionarios();
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






function editarFornecedor(id_fornecedo, nome_fornecedo, email_fornecedo, telefone_fornecedo, pontuacao_fornecedo, endereco_fornecedo, cidade_fornecedo, site_fornecedo) {
  // Preencher campos da modal
  $("#editFornecedorId").val(id_fornecedo);
  $("#editFornecedorNome").val(nome_fornecedo);
  $("#editFornecedorEmail").val(email_fornecedo);
  $("#editFornecedorTel").val(telefone_fornecedo);
  $("#editFornecedorPont").val(pontuacao_fornecedo);
  $("#editFornecedorEnd").val(endereco_fornecedo);
  $("#editFornecedorCid").val(cidade_fornecedo);
  $("#editFornecedorSit").val(site_fornecedo);

  // Abrir modal de edição
  $("#modalEditarFornecedor").modal("show");
}

function salvarEdicaoFornecedor() {
  // Obter os dados da modal
  var id_fornecedo = $("#editFornecedorId").val();
  var nome_fornecedo = $("#editFornecedorNome").val();
  var email_fornecedo = $("#editFornecedorEmail").val();
  var telefone_fornecedo = $("#editFornecedorTel").val();
  var pontuacao_fornecedo = $("#editFornecedorPont").val();
  var endereco_fornecedo = $("#editFornecedorEnd").val();
  var cidade_fornecedo = $("#editFornecedorCid").val();
  var site_fornecedo = $("#editFornecedorSit").val();

  // Código AJAX para enviar os dados para o servidor
  $.ajax({
    url: "../../controllers/FornecedorController.php",
    type: "POST",
    data: {
      id_fornecedo: id_fornecedo,
      nome_fornecedo: nome_fornecedo,
      email_fornecedo: email_fornecedo,
      telefone_fornecedo: telefone_fornecedo,
      pontuacao_fornecedo: pontuacao_fornecedo,
      endereco_fornecedo: endereco_fornecedo,
      cidade_fornecedo: cidade_fornecedo,
      site_fornecedo: site_fornecedo,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Fornecedor editado com sucesso!");
        $("#modalSucesso").modal("show");

        obterFornecedores();
      } else {
        $("#textErro").text("Não foi possivel editar esse Fornecedor");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalEditarFornecedor").modal("hide");
}




function editarCliente(id_cliente, nome_cliente, email_cliente, telefone_cliente) {
  // Preencher campos da modal
  $("#editClienteId").val(id_cliente);
  $("#editClienteNome").val(nome_cliente);
  $("#editClienteEmail").val(email_cliente);
  $("#editClienteTel").val(telefone_cliente);

  // Abrir modal de edição
  $("#modalEditarCliente").modal("show");
}

function salvarEdicaoCliente() {
  // Obter os dados da modal
  var id_cliente = $("#editClienteId").val();
  var nome_cliente = $("#editClienteNome").val();
  var email_cliente = $("#editClienteEmail").val();
  var telefone_cliente = $("#editClienteTel").val();

  // Código AJAX para enviar os dados para o servidor
  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: {
      id_cliente: id_cliente,
      nome_cliente: nome_cliente,
      email_cliente: email_cliente,
      telefone_cliente: telefone_cliente,
      action: "editar",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Cliente editado com sucesso!");
        $("#modalSucesso").modal("show");

        obterClientes();
      } else {
        $("#textErro").text("Não foi possivel editar esse Cliente");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
  $("#modalEditarCliente").modal("hide");
}

