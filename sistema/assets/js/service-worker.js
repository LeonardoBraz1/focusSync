// Defina os recursos estáticos que deseja armazenar em cache
var CACHE_NAME = "my-cache";
var urlsToCache = [
  "/",
  "../../assets/css/style.css",
  "../../assets/css/login.css",
  "../../assets/css/main.css",
  "../../assets/css/erro.css",
  "../../assets/css/material-dashboard.css",
  "../../assets/js/main.js",
  "../../assets/js/bootstrap.min.js",
  "../../assets/js/jquery-3.3.1.min.js",
  "../../assets/js/scripts/cadastro/deletar.js",
  "../../assets/js/scripts/cadastro/editar.js",
  "../../assets/js/scripts/cadastro/inserir.js",
  "../../assets/js/scripts/cadastro/verDados.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaCargos.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaEntradas.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaEstoqueBaixo.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaProdutos.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaSaidas.js",
  "../../assets/js/scripts/cadastro/tabelas/tabelaServico.js",
  "../../assets/js/scripts/pessoas/deletar.js",
  "../../assets/js/scripts/pessoas/editar.js",
  "../../assets/js/scripts/pessoas/inserir.js",
  "../../assets/js/scripts/pessoas/verDados.js",
  "../../assets/js/scripts/pessoas/tabelas/tabelaClientes.js",
  "../../assets/js/scripts/pessoas/tabelas/tabelaClientesRetorno.js",
  "../../assets/js/scripts/pessoas/tabelas/tabelaFornecedor.js",
  "../../assets/js/scripts/pessoas/tabelas/tabelaFuncionarios.js",
  "../../assets/js/scripts/pessoas/tabelas/tabelaUsuario.js",
  "../../assets/js/scripts/financeiro/deletar.js",
  "../../assets/js/scripts/financeiro/editar.js",
  "../../assets/js/scripts/financeiro/inserir.js",
  "../../assets/js/scripts/financeiro/tabelas",
  "../../assets/js/scripts/financeiro/verDados.js",
  "../../assets/js/scripts/financeiro/tabelas/tabelaCompras.js",
  "../../assets/js/scripts/financeiro/tabelas/tabelaVendas.js",
  "../../assets/js/plugins/apexcharts.min.js",
  "../../assets/js/plugins/bootstrap-datepicker.min.js",
  "../../assets/js/plugins/bootstrap-notify.min.js",
  "../../assets/js/plugins/chart.js",
  "../../assets/js/plugins/dashboard-main.js",
  "../../assets/js/plugins/dataTables.bootstrap.min.js",
  "../../assets/js/plugins/dropzone.js",
  "../../assets/js/plugins/fullcalendar.min.js",
  "../../assets/js/plugins/jquery-ui.custom.min.js",
  "../../assets/js/plugins/jquery.dataTables.min.js",
  "../../assets/js/plugins/jquery.vmap.min.js",
  "../../assets/js/plugins/jquery.vmap.sampledata.js",
  "../../assets/js/plugins/jquery.vmap.world.js",
  "../../assets/js/plugins/moment.min.js",
  "../../assets/js/plugins/pace.min.js",
  "../../assets/js/plugins/select2.min.js",
  "../../assets/js/plugins/sweetalert.min.js",
  "../../assets/images/icons/icon_cargo.png",
  "../../assets/images/icons/icon_cliente.png",
  "../../assets/images/icons/icon_compra.png",
  "../../assets/images/icons/icon_fornecedor.png",
  "../../assets/images/icons/icon_funcionario.png",
  "../../assets/images/icons/icon_pro.png",
  "../../assets/images/icons/icon_servico.png",
  "../../assets/images/icons/icon_usuario.png",
  "../../assets/images/icons/icon_venda.png",
  "../../assets/images/avatar.png",
  "../../assets/images/contas.png",
  "../../assets/images/estoque-baixo.png",
  "../../assets/images/faturamento.png",
  "../../assets/images/favicon1.ico",
  "../../assets/images/sem-foto.jpg",
];

// Instalação do Service Worker
self.addEventListener("install", function (event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      console.log("Cache aberto");
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", function (event) {
    event.respondWith(
      caches.open(CACHE_NAME).then(function (cache) {
        return cache.match(event.request).then(function (response) {
          // Retorne a resposta do cache se estiver disponível
          if (response) {
            return response;
          }
  
          // Caso contrário, busque o recurso na rede
          return fetch(event.request).then(function (networkResponse) {
            // Adicione a resposta ao cache para uso futuro
            cache.put(event.request, networkResponse.clone());
  
            // Retorne a resposta buscada na rede
            return networkResponse;
          });
        });
      })
    );
  });
