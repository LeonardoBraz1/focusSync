function verUsuario(id, nome, email, nome_nivel, ativo, senha, imagem) {
  $("#verUsuarioId").text(id);
  $("#verUsuarioEmail").text(email);
  $("#verUsuarioNome").text(nome);
  $("#verUsuarioNivel").text(nome_nivel);
  $("#verUsuarioAti").text(ativo);
  $("#verUsuarioSenha").text(senha);
  $("#verUsuarioImg").attr("src", imagem);

  $("#modalVerUsuario").modal("show");
}



function verFuncionario(id, nome, email, id_nivel, cpf, comissao, atendimento, endereco, cidade, tipoPix, pix, cadastro, imagem) {
  $("#verFuncionarioId").text(id);
  $("#verFuncionarioNome").text(nome);
  $("#verFuncionarioEmail").text(email);
  $("#verFuncionarioNivel").text(id_nivel);
  $("#verFuncionarioCpf").text(cpf);
  $("#verFuncionarioCom").text(comissao);
  $("#verFuncionarioAten").text(atendimento);
  $("#verFuncionarioEnd").text(endereco);
  $("#verFuncionarioCid").text(cidade);
  $("#verFuncionarioTipo").text(tipoPix);
  $("#verFuncionarioPix").text(pix);
  $("#verFuncionarioCadas").text(cadastro);
  $("#verUsuarioImg").attr("src", imagem);

  $("#modalVerFuncionario").modal("show");
}



function verFornecedor(id_fornecedo, nome_fornecedo, email_fornecedo, telefone_fornecedo, pontuacao_fornecedo, endereco_fornecedo, cidade_fornecedo, site_fornecedo, cadastro) {
  $("#verFornecedorId").text(id_fornecedo);
  $("#verFornecedorNome").text(nome_fornecedo);
  $("#verFornecedorEmail").text(email_fornecedo);
  $("#verFornecedorTel").text(telefone_fornecedo);
  $("#verFornecedorPont").text(pontuacao_fornecedo);
  $("#verFornecedorEnd").text(endereco_fornecedo);
  $("#verFornecedorCid").text(cidade_fornecedo);
  $("#verFornecedorSit").text(site_fornecedo);
  $("#verFornecedorCadas").text(cadastro);

  $("#modalVerFornecedor").modal("show");
}





function verCliente(id_cliente, nome_cliente, email_cliente, telefone_cliente, cadastro, retorno) {
  $("#verClienteId").text(id_cliente);
  $("#verClienteNome").text(nome_cliente);
  $("#verClienteEmail").text(email_cliente);
  $("#verClienteTel").text(telefone_cliente);
  $("#verClienteCadas").text(cadastro);
  $("#verClienteRetor").text(retorno);

  $("#modalVerCliente").modal("show");
}
