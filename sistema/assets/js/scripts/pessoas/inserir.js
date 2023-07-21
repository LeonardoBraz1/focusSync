// Código do usuário
function btnInserirUsuario() {
  $("#modalInserirUsuario").modal("show");
}

$(document).ready(function () {
  var submitButton = $("#submit-button-user");

  // Monitorar alterações no campo de email do usuário
  $(".email-input-user").on("input", function () {
    var email = $(this).val();
    var emailErrorElement = $(this).siblings(".error-message-user");

    // Limpar o conteúdo da mensagem de erro antes de fazer a validação
    emailErrorElement.text("");

    $.ajax({
      url: "../../controllers/UsuarioController.php",
      type: "POST",
      data: { email: email, action: "validarEmail" },
      success: function (response) {
        var parsedResponse = handleAjaxResponseUser(response);
        if (parsedResponse && parsedResponse.status === "existe") {
          // Exibe uma mensagem de erro informando que o email já está em uso
          emailErrorElement.text("Email já está em uso");
        } else {
          // O email é válido, não exibe a mensagem de erro
          emailErrorElement.text("");
        }
        updateSubmitButtonStateUser();
      },
      error: function (xhr, status, error) {
        // Trate os erros da chamada AJAX
        console.log("Erro na chamada AJAX:", error);
        updateSubmitButtonStateUser();
      },
    });
  });

  // Monitorar alterações no campo de nome do usuário
  $(".nome-input-user").on("input", function () {
    var nome = $(this).val();
    var nomeErrorElement = $(this).siblings(".error-message-user");

    // Limpar o conteúdo da mensagem de erro antes de fazer a validação
    nomeErrorElement.text("");

    $.ajax({
      url: "../../controllers/UsuarioController.php",
      type: "POST",
      data: { nome: nome, action: "validarNome" },
      success: function (response) {
        var parsedResponse = handleAjaxResponseUser(response);
        if (parsedResponse && parsedResponse.status === "existe") {
          nomeErrorElement.text("Nome já está em uso");
        } else {
          // O nome é válido, não exibe a mensagem de erro
          nomeErrorElement.text("");
        }
        updateSubmitButtonStateUser();
      },
      error: function (xhr, status, error) {
        // Trate os erros da chamada AJAX
        console.log("Erro na chamada AJAX:", error);
        updateSubmitButtonStateUser();
      },
    });
  });

  // Função para atualizar o estado do botão de envio do usuário
  function updateSubmitButtonStateUser() {
    var errorMessages = $(".error-message-user");
    var hasErrors = false;

    errorMessages.each(function () {
      if ($(this).text() !== "") {
        hasErrors = true;
        return false;
      }
    });

    if (hasErrors) {
      submitButton.attr("disabled", "disabled");
    } else {
      submitButton.removeAttr("disabled");
    }
  }

  function handleAjaxResponseUser(response) {
    var parsedResponse;
    try {
      parsedResponse = JSON.parse(response);
    } catch (error) {
      console.log("Erro ao analisar a resposta do servidor:", error);
      return null;
    }
    return parsedResponse;
  }
});

function inserirUsuario() {
  // Obter os dados da modal de usuário
  var email = $("#novoUsuarioEmail").val();
  var nome = $("#novoUsuarioNome").val();
  var id_nivel = $("#novoUsuarioNivel").val();
  var ativo = $("#novoUsuarioAti").val();
  var senha = $("#novoUsuarioSenha").val();
  var imagem = $("#novoUsuarioImg").attr("src");

  $.ajax({
    url: "../../controllers/UsuarioController.php",
    type: "POST",
    data: {
      email: email,
      nome: nome,
      id_nivel: id_nivel,
      ativo: ativo,
      senha: senha,
      imagem: imagem,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Usuário inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse usuário");
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
  // Fechar a modal de inserção de usuário
  $("#modalInserirUsuario").modal("hide");
}

// Código do funcionário
function btnInserirFuncionario() {
  $("#modalInserirFuncionario").modal("show");
}

$(document).ready(function () {
  var submitButton = $("#submit-button-funcionario");

  $(".email-input-funcionario").on("input", function () {
    var email = $(this).val();
    var emailErrorElement = $(this).siblings(".error-message-funcionario");

    // Limpar o conteúdo da mensagem de erro antes de fazer a validação
    emailErrorElement.text("");

    $.ajax({
      url: "../../controllers/FuncionarioController.php",
      type: "POST",
      data: { email: email, action: "validarEmail" },
      success: function (response) {
        var parsedResponse = handleAjaxResponseFuncionario(response);
        if (parsedResponse && parsedResponse.status === "existe") {
          emailErrorElement.text("Email já está em uso");
        } else {
          // O email é válido, não exibe a mensagem de erro
          emailErrorElement.text("");
        }
        updateSubmitButtonStateFuncionario();
      },
      error: function (xhr, status, error) {
        // Trate os erros da chamada AJAX
        console.log("Erro na chamada AJAX:", error);
        updateSubmitButtonStateFuncionario();
      },
    });
  });

  // Monitorar alterações no campo de nome do funcionário
  $(".nome-input-funcionario").on("input", function () {
    var nome = $(this).val();
    var nomeErrorElement = $(this).siblings(".error-message-funcionario");

    // Limpar o conteúdo da mensagem de erro antes de fazer a validação
    nomeErrorElement.text("");

    $.ajax({
      url: "../../controllers/FuncionarioController.php",
      type: "POST",
      data: { nome: nome, action: "validarNome" },
      success: function (response) {
        var parsedResponse = handleAjaxResponseFuncionario(response);
        if (parsedResponse && parsedResponse.status === "existe") {
          nomeErrorElement.text("Nome já está em uso");
        } else {
          nomeErrorElement.text("");
        }
        updateSubmitButtonStateFuncionario();
      },
      error: function (xhr, status, error) {
        // Trate os erros da chamada AJAX
        console.log("Erro na chamada AJAX:", error);
        updateSubmitButtonStateFuncionario();
      },
    });
  });

  // Função para atualizar o estado do botão de envio do funcionário
  function updateSubmitButtonStateFuncionario() {
    var errorMessages = $(".error-message-funcionario");
    var hasErrors = false;

    // Verifica se existem mensagens de erro
    errorMessages.each(function () {
      if ($(this).text() !== "") {
        hasErrors = true;
        return false;
      }
    });

    if (hasErrors) {
      submitButton.attr("disabled", "disabled");
    } else {
      submitButton.removeAttr("disabled");
    }
  }

  // Função para tratar o retorno da chamada AJAX como JSON
  function handleAjaxResponseFuncionario(response) {
    var parsedResponse;
    try {
      parsedResponse = JSON.parse(response);
    } catch (error) {
      console.log("Erro ao analisar a resposta do servidor:", error);
      return null;
    }
    return parsedResponse;
  }
});

function inserirFuncionario() {
  // Obter os dados da modal de funcionário
  var email = $("#novoFuncionarioEmail").val();
  var nome = $("#novoFuncionarioNome").val();
  var id_nivel = $("#novoFuncionarioNivel").val();
  var cpf = $("#novoFuncionarioCpf").val();
  var comissao = $("#novoFuncionarioCom").val();
  var atendimento = $("#novoFuncionarioAten").val();
  var endereco = $("#novoFuncionarioEnd").val();
  var cidade = $("#novoFuncionarioCid").val();
  var tipoPix = $("#novoFuncionarioTipo").val();
  var pix = $("#novoFuncionarioPix").val();
  var imagem = $("#novoFuncionarioImg").attr("src");

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      email: email,
      nome: nome,
      id_nivel: id_nivel,
      cpf: cpf,
      comissao: comissao,
      atendimento: atendimento,
      endereco: endereco,
      cidade: cidade,
      tipoPix: tipoPix,
      pix: pix,
      imagem: imagem,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Funcionário inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse funcionário");
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
  // Fechar a modal de inserção de funcionário
  $("#modalInserirFuncionario").modal("hide");
}

// dia semana//

var idFuncionario;
var diaSemana;
// Código do dia da semana
function btnInserirDiaSemana(id) {
  $("#modalInserirDiaSemana").modal("show");
  idFuncionario = id;
  diaSemana = $("#novoDiaSemana").val();

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: { id: id, action: "obterHorarios" },
    success: function (response) {
      // Limpar a tabela antes de carregar os dados
      $("#tabelaDiaSemana tbody").empty();

      // Adicionar os horários à tabela
      $("#tabelaDiaSemana tbody").append(response);
    },
    error: function () {
      alert("Ocorreu um erro ao obter os horários dos usuários.");
    },
  });
}

function inserirDiaSemana() {
  var id = idFuncionario;
  var diaSemana = $("#novoDiaSemana").val();

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id: id,
      diaSemana: diaSemana,
      action: "inserirDia",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        atualizarTabela(id);
      } else {
        $("#textErro").text("Não foi possível inserir esse funcionário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Erro ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
}

function deletarDiaSemana1(id_dia) {
  var id = idFuncionario;

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id_dia: id_dia,
      action: "deletarDiaSemana",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        atualizarTabela(id);
      } else {
        $("#textErro").text("Não foi possível inserir esse funcionário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
}

function atualizarTabela(id) {
  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id: id,
      action: "obterHorarios",
    },
    success: function (response) {
      // Atualizar a tabela com os novos dados
      $("#tabelaDiaSemana tbody").html(response);
    },
    error: function () {
      alert("Ocorreu um erro ao obter os horários dos usuários.");
    },
  });
}

// serviços //

var idServ;
var serv;
// Código do Serviços
function btnInserirServ(id) {
  $("#modalInserirServ").modal("show");
  idServ = id;
  serv = $("#novoServ").val();

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: { id: id, action: "obterServ" },
    success: function (response) {
      // Limpar a tabela antes de carregar os dados
      $("#tabelaServ tbody").empty();

      // Adicionar os horários à tabela
      $("#tabelaServ tbody").append(response);
    },
    error: function () {
      alert("Ocorreu um erro ao obter os horários dos usuários.");
    },
  });
}

function inserirServ() {
  var id = idServ;
  var serv = $("#novoServ").val();

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id: id,
      serv: serv,
      action: "inserirServ",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        atualizarTabelaServ(id);
      } else {
        $("#textErro").text("Não foi possível inserir esse funcionário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Erro ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
}

function deletarServ1(id_servico) {
  var id = idServ;

  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id_servico: id_servico,
      action: "deletarServ",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        atualizarTabelaServ(id);
      } else {
        $("#textErro").text("Não foi possível inserir esse funcionário");
        $("#modalErro").modal("show");
      }
    },
    error: function (xhr, status, error) {
      $("#textErro").text("Ao enviar os dados");
      $("#modalErro").modal("show");
    },
  });
}

function atualizarTabelaServ(id) {
  $.ajax({
    url: "../../controllers/FuncionarioController.php",
    type: "POST",
    data: {
      id: id,
      action: "obterServ",
    },
    success: function (response) {
      // Atualizar a tabela com os novos dados
      $("#tabelaServ tbody").html(response);
    },
    error: function () {
      alert("Ocorreu um erro ao obter os horários dos usuários.");
    },
  });
}

//    FORNECEDOR     //

function btnInserirFornecedor() {
  $("#modalInserirFornecedor").modal("show");
}

function inserirFornecedor() {
  var nome_fornecedo = $("#novoFornecedorNome").val();
  var email_fornecedo = $("#novoFornecedorEmail").val();
  var telefone_fornecedo = $("#novoFornecedorTel").val();
  var pontuacao_fornecedo = $("#novoFornecedorPont").val();
  var endereco_fornecedo = $("#novoFornecedorEnd").val();
  var cidade_fornecedo = $("#novoFornecedorCid").val();
  var site_fornecedo = $("#novoFornecedorSit").val();
  $.ajax({
    url: "../../controllers/FornecedorController.php",
    type: "POST",
    data: {
      nome_fornecedo: nome_fornecedo,
      email_fornecedo: email_fornecedo,
      telefone_fornecedo: telefone_fornecedo,
      pontuacao_fornecedo: pontuacao_fornecedo,
      endereco_fornecedo: endereco_fornecedo,
      cidade_fornecedo: cidade_fornecedo,
      site_fornecedo: site_fornecedo,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Fornecedor inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse fornecedor");
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
  $("#modalInserirFornecedor").modal("hide");
}

//    cliente     //

function btnInserirCliente() {
  $("#modalInserirCliente").modal("show");
}

function inserirCliente() {
  var nome_cliente = $("#novoClienteNome").val();
  var email_cliente = $("#novoClienteEmail").val();
  var telefone_cliente = $("#novoClienteTel").val();

  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: {
      nome_cliente: nome_cliente,
      email_cliente: email_cliente,
      telefone_cliente: telefone_cliente,
      action: "inserir",
    },
    dataType: "json",
    success: function (response) {
      if (response.status === "sucesso") {
        $("#textSucesso").text("Cliente inserido com sucesso!");
        $("#modalSucesso").modal("show");
      } else {
        $("#textErro").text("Não foi possível inserir esse cliente");
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
  // Fechar a modal de inserção de funcionário
  $("#modalInserirCliente").modal("hide");
}
