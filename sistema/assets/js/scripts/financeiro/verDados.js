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
    $("#img_mostrar").attr("src", imagemSrc );
  
    $("#modalVerVenda").modal("show");
  }
  