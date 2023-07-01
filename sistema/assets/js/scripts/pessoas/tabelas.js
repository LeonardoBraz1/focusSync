$(document).ready(function () {
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
      if (Array.isArray(usuarios) && usuarios.length > 0) {
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
      } else {
        // Nenhum usuário encontrado, exibir mensagem
        $("#usuariosTableBody").html(
          "<tr><td align='center' colspan='7'>Nenhum usuário encontrado</td></tr>"
        );
      }
      $("#sampleTable").DataTable();
    },
    error: function () {
      alert("Ocorreu um erro ao obter os usuários.");
    },
  });
}

$(document).ready(function () {
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

      if (Array.isArray(funcionarios) && funcionarios.length > 0) {
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
      } else {
        // Nenhum funcionário encontrado, exibir mensagem
        $("#funcionariosTableBody").html(
          "<tr><td align='center' colspan='8'>Nenhum funcionário encontrado</td></tr>"
        );
      }
      $("#sampleTable").DataTable();
    },
    error: function () {
      alert("Ocorreu um erro ao obter os funcionários.");
    },
  });

}





$(document).ready(function() {
  obterFornecedores();
});

function obterFornecedores() {
  $.ajax({
    url: "../../controllers/FornecedorController.php",
    type: "POST",
    data: { action: "obterFornecedores" },
    dataType: "json",
    success: function(response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var fornecedores = JSON.parse(response);
      var fornecedoresTableBody = $("#fornecedoresTableBody");

      fornecedoresTableBody.empty();

      if (Array.isArray(fornecedores) && fornecedores.length > 0) {
        for (var i = 0; i < fornecedores.length; i++) {
          var fornecedor = fornecedores[i];
          var row = $("<tr>");

          row.append("<td style='display: none;'>" + fornecedor.id_fornecedo + "</td>");
          row.append("<td>" + fornecedor.nome_fornecedo + "</td>");
          row.append("<td>" + fornecedor.email_fornecedo + "</td>");
          row.append("<td>" + fornecedor.telefone_fornecedo + "</td>");
          row.append("<td>" + fornecedor.pontuacao_fornecedo + "</td>");
          row.append("<td>" + fornecedor.data_cadastro + "</td>");

          var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
          actions.append("<label style='cursor: pointer;' for='btnEditarForne-" + fornecedor.id_fornecedo + "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>");
          actions.append("<input style='display: none;' type='button' class='btnEditarForne'  onclick='editarFornecedor(" + fornecedor.id_fornecedo + ", \"" + fornecedor.nome_fornecedo + "\", \"" + fornecedor.email_fornecedo + "\", \"" + fornecedor.telefone_fornecedo + "\", \"" + fornecedor.pontuacao_fornecedo + "\", \"" + fornecedor.endereco_fornecedo + "\", \"" + fornecedor.cidade_fornecedo + "\", \"" + fornecedor.site_fornecedo + "\")' id='btnEditarForne-" + fornecedor.id_fornecedo + "'>");
          actions.append("<label style='cursor: pointer;' for='btnDeletarForne-" + fornecedor.id_fornecedo + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
          actions.append("<input style='display: none;' type='button' onclick='deletarFornecedor(" + fornecedor.id_fornecedo + ")' id='btnDeletarForne-" + fornecedor.id_fornecedo + "'>");
          actions.append("<label style='cursor: pointer;' for='btnWhat1-" + fornecedor.id_fornecedo + "'><a href='https://api.whatsapp.com/send?phone=" +
          fornecedor.telefone_fornecedo +
          "&text=" +
          encodeURIComponent(fornecedor.message) +
          "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>");
          actions.append("<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" + fornecedor.id_fornecedo + ")' type='button' class='btnWhat' id='btnWhat-" + fornecedor.id_fornecedo + "' data-id='" + fornecedor.id_fornecedo + "'>");

          row.append(actions);
          fornecedoresTableBody.append(row);
        }
      } else {
        // Nenhum fornecedor encontrado, exibir mensagem
        $("#fornecedoresTableBody").html("<tr><td align='center' colspan='7'>Nenhum fornecedor encontrado</td></tr>");
      }

      $("#sampleTable").DataTable();
    },
    error: function() {
      alert("Ocorreu um erro ao obter os fornecedores.");
    },
  });
}







$(document).ready(function() {
  obterClientes();
});

function obterClientes() {
  $.ajax({
    url: "../../controllers/ClienteController.php",
    type: "POST",
    data: { action: "obterClientes" },
    dataType: "json",
    success: function(response) {
      if (response.status === "erro") {
        alert(response.message);
        return;
      }
      $("#sampleTable").DataTable().destroy();
      var clientes = JSON.parse(response);
      var clientesTableBody = $("#clientesTableBody");

      clientesTableBody.empty();

      if (Array.isArray(clientes) && clientes.length > 0) {
        for (var i = 0; i < clientes.length; i++) {
          var cliente = clientes[i];
          var row = $("<tr>");

          row.append("<td style='display: none;'>" + cliente.id_cliente + "</td>");
          row.append("<td>" + cliente.nome_cliente + "</td>");
          row.append("<td>" + cliente.email_cliente + "</td>");
          row.append("<td>" + cliente.telefone_cliente + "</td>");
          row.append("<td>" + cliente.cadastro + "</td>");
          row.append("<td>" + cliente.retorno + "</td>");

          var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
          actions.append("<label style='cursor: pointer;' for='btnEditarClien-" + cliente.id_cliente + "'><i title='Editar' class='icon fa fa-solid fa-edit fa-lg' style='color: #023ea7;'></i></label>");
          actions.append("<input style='display: none;' type='button' class='btnEditarClien' onclick='editarCliente(" + cliente.id_cliente + ", \"" + cliente.nome_cliente + "\", \"" + cliente.email_cliente + "\", \"" + cliente.telefone_cliente + "\", \"" + cliente.data_cadastro + "\", \"" + cliente.retorno + "\")' id='btnEditarClien-" + cliente.id_cliente + "'>");
          actions.append("<label style='cursor: pointer;' for='btnDeletarClien-" + cliente.id_cliente + "'><i title='Deletar' class='fa fa-solid fa-trash fa-lg' style='color: #bd0000;'></i></label>");
          actions.append("<input style='display: none;' type='button' onclick='deletarCliente(" + cliente.id_cliente + ")' id='btnDeletarClien-" + cliente.id_cliente + "'>");
          actions.append("<label style='cursor: pointer;' for='btnWhat-" + cliente.id_cliente + "'><a href='https://api.whatsapp.com/send?phone=" +
          cliente.telefone_formatado +
          "&text=" +
          encodeURIComponent(cliente.message) +
          "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>");
          actions.append("<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" + cliente.id_cliente + ")' type='button' class='btnWhat' id='btnWhat-" + cliente.id_cliente + "' data-id='" + cliente.id_cliente + "'>");

          row.append(actions);
          clientesTableBody.append(row);
        }
      } else {
      
        $("#clientesTableBody").html("<tr><td align='center' colspan='7'>Nenhum cliente encontrado</td></tr>");
      }

      $("#sampleTable").DataTable();
    },
    error: function() {
      alert("Ocorreu um erro ao obter os clientes.");
    },
  });
}


$(document).ready(function() {
  obterClientes();
});

function obterClientes() {
  $.ajax({
      url: "../../controllers/ClienteController.php",
      type: "POST",
      data: {
          action: "obterClientesRetorno"
      },
      dataType: "json",
      success: function(response) {
          if (response.status === "erro") {
              alert(response.message);
              return;
          }
          $("#sampleTable").DataTable().destroy();
          var clientesRetornos = JSON.parse(response);
          var clientesRetornosTableBody = $("#clientesRetornosTableBody");

          clientesRetornosTableBody.empty();

          if (Array.isArray(clientesRetornos) && clientesRetornos.length > 0) {
              for (var i = 0; i < clientesRetornos.length; i++) {
                  var clientesRetorno = clientesRetornos[i];
                  var row = $("<tr>");

                  row.append("<td style='display: none;'>" + clientesRetorno.id_cliente + "</td>");
                  row.append("<td>" + clientesRetorno.nome_cliente + "</td>");
                  row.append("<td>" + clientesRetorno.telefone_cliente + "</td>");
                  row.append("<td>" + clientesRetorno.cadastro + "</td>");
                  row.append("<td>" + clientesRetorno.ultimo_servico + "</td>");
                  row.append("<td>" + clientesRetorno.retorno + "</td>");
                  row.append("<td>" + clientesRetorno.dias_sem_retorno + "</td>");

                  var actions = $("<td style='display: flex; justify-content: center; align-items: center; gap: 7px;'>");
                  actions.append("<label style='cursor: pointer;' for='btnWhat2-" + clientesRetorno.id_cliente + "'><a href='https://api.whatsapp.com/send?phone=" +
                  clientesRetorno.telefone_formatado +
                  "&text=" +
                  encodeURIComponent(clientesRetorno.message) +
                  "' target='_blank'><i class='fa fa-brands fa-whatsapp fa-lg' style='color: #7dd90d;'></i></a></label>");
                  actions.append("<input style='display: none; pointer-events: none; opacity: 0;' onclick='redirectToWhatsApp(" + clientesRetorno.id_cliente + ")' type='button' class='btnWhat' id='btnWhat2-" + clientesRetorno.id_cliente + "' data-id='" + clientesRetorno.id_cliente + "'>");

                  row.append(actions);
                  clientesRetornosTableBody.append(row);
              }
          } else {
              $("#clientesRetornoTableBody").html("<tr><td align='center' colspan='8'>Nenhum cliente encontrado</td></tr>");
          }

          $("#sampleTable").DataTable();
      },
      error: function() {
          alert("Ocorreu um erro ao obter os clientes.");
      },
  });
}