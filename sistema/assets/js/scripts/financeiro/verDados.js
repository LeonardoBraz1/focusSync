function verVenda(
  id_venda,
  nome_pro,
  nome_cliente,
  valor_venda,
  quantidade,
  valor_total,
  data_venda,
  data_pagamento,
  numero_fatura,
  nome,
  forma_pagamento,
  status,
  imagemSrc
) {
  // Preencher campos da modal
  $("#vendaId").text(id_venda);
  $("#nome_dados").text(nome_pro);
  $("#nomeCli_dados").text(nome_cliente);
  $("#venda_dados").text(valor_venda);
  $("#quantidade_dados").text(quantidade);
  $("#total_dados").text(valor_total);
  $("#data_venda_dados").text(data_venda);
  $("#data_pag_dados").text(data_pagamento);
  $("#nFatura_dados").text(numero_fatura);
  $("#nomeUser_dados").text(nome);
  $("#forPag_dados").text(forma_pagamento);
  $("#status_dados").text(status);
  $("#img_mostrar").attr("src", imagemSrc);

  $("#modalVerVenda").modal("show");

  var status2 = $("#status_dados").text().trim();
  var statusMessage = $("#status_message");

  if (status2 === "Pendente") {
    statusMessage.removeClass("d-none");
  } else {
    statusMessage.addClass("d-none");
  }
}

function verCompra(
  id_compra,
  nome_pro,
  valor_unitario,
  quantidade,
  valor_total,
  nome_fornecedo,
  data_compra,
  data_pagamento,
  forma_pagamento,
  status_pagamento,
  imagemSrc
) {
  // Preencher campos da modal
  $("#compraId").text(id_compra);
  $("#nome1_dados").text(nome_pro);
  $("#valorUnit_dados").text(valor_unitario);
  $("#quantidade1_dados").text(quantidade);
  $("#total1_dados").text(valor_total);
  $("#fornecedor_dados").text(nome_fornecedo);
  $("#data_compra_dados").text(data_compra);
  $("#data_pag1_dados").text(data_pagamento);
  $("#forPag1_dados").text(forma_pagamento);
  $("#status1_dados").text(status_pagamento);
  $("#img1_mostrar").attr("src", imagemSrc);

  $("#modalVerCompra").modal("show");

  var status3 = $("#status1_dados").text().trim();
  var statusMessage1 = $("#status_messageCompra");

  if (status3 === "Pendente") {
    statusMessage1.removeClass("d-none");
  } else {
    statusMessage1.addClass("d-none");
  }
}

function verContasAReceber(
  id_receber,
  descricao,
  valor,
  data_pagamento,
  nome_cliente,
  data_cadastro,
  status
) {
  // Preencher campos da modal
  $("#verContasRId").text(id_receber);
  $("#verContasRNome").text(descricao);
  $("#verContasRValor").text(valor);
  $("#verContasRDataP").text(data_pagamento);
  $("#verContasRNomeClie").text(nome_cliente);
  $("#verContasRDataCadas").text(data_cadastro);
  $("#verContasRStatus").text(status);

  $("#modalVerContasR").modal("show");

  var status3 = $("#verContasRStatus").text().trim();
  var statusMessage1 = $("#status_messageReceber");

  if (status3 === "Pendente") {
    statusMessage1.removeClass("d-none");
  } else {
    statusMessage1.addClass("d-none");
  }
}

function verContasAPagar(
  id_conta,
  descricao,
  valor,
  data_pagamento,
  nome_fornecedo,
  nome_usuario,
  data_conta,
  status
) {
  $("#verContasPId").text(id_conta);
  $("#verContasPNome").text(descricao);
  $("#verContasPValor").text(valor);
  $("#verContasPDataP").text(data_pagamento);
  $("#verContasPNomeFor").text(nome_fornecedo);
  $("#verContasPNomeUser").text(nome_usuario);
  $("#verContasPDataCadas").text(data_conta);
  $("#verContasPStatus").text(status);

  $("#modalVerContasP").modal("show");

  var status3 = $("#verContasPStatus").text().trim();
  var statusMessage1 = $("#status_messagePagar");

  if (status3 === "Pendente") {
    statusMessage1.removeClass("d-none");
  } else {
    statusMessage1.addClass("d-none");
  }
}
