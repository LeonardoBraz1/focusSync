function verProduto(
  id_pro,
  nome_pro,
  data_cadastro,
  valor_compra,
  valor_venda,
  estoque,
  validade,
  alerta_estoque,
  descricao,
  imagem,
  id_fornecedo
  ) {
    $("#verProdutoId").text(id_pro);
    $("#verProdutoNome").text(nome_pro);
    $("#verProdutoCadas").text(data_cadastro);
    $("#verProdutoComp").text("R$ " + valor_compra);
    $("#verProdutoVend").text("R$ " + valor_venda);
    $("#verProdutoEsto").text(estoque);
    $("#verProdutoVali").text(validade);
    $("#verProdutoAler").text(alerta_estoque);
    $("#verProdutoDesc").text(descricao);
    $("#verProdutoForne").text(id_fornecedo);
    $("#verProdutoImg").attr("src", imagem);

    $("#modalVerProduto").modal("show");
  }



  function verServico(id_servico, nome_servico, data, preco, comissao, tempo
    ) {
      $("#verServicoId").text(id_servico);
      $("#verServicoNome").text(nome_servico);
      $("#verServicData").text(data);
      $("#verServicoPrec").text("R$ " + preco);
      $("#verServicoCom").text(comissao);
      $("#verServicoTemp").text(tempo + " Minutos");

      $("#modalVerServico").modal("show");
    }


    function verSaida(
      id_pro,
      nome_pro,
      quantidade,
      motivo_saida,
      data_saida,
      imagem
      ) {
        $("#verSaidaId").text(id_pro);
        $("#verSaidaNome").text(nome_pro);
        $("#verSaidaQuant").text(quantidade);
        $("#verSaidaMoti").text(motivo_saida);
        $("#verSaidaDataS").text(data_saida);
        $("#verSaidaImg").attr("src", imagem);
    
        $("#modalVerSaida").modal("show");
      }



      function verProdutoEsto(
        id_pro,
        nome_pro,
        data_cadastro,
        valor_compra,
        valor_venda,
        estoque,
        validade,
        alerta_estoque,
        imagem
        ) {
          $("#verProdutoIdEsto").text(id_pro);
          $("#verProdutoNomeEsto").text(nome_pro);
          $("#verProdutoCadasEsto").text(data_cadastro);
          $("#verProdutoCompEsto").text("R$ " + valor_compra);
          $("#verProdutoVendEsto").text("R$ " + valor_venda);
          $("#verProdutoEstoEsto").text(estoque);
          $("#verProdutoValiEsto").text(validade);
          $("#verProdutoAlerEsto").text(alerta_estoque);
          $("#verProdutoImgEsto").attr("src", imagem);
      
          $("#modalVerProduto").modal("show");
        }