 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div style="background-color: #333644; padding: 30px 5px; margin-top: -20px;" class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="width: 40px;" src="../../assets/images/avatar.png" alt="User Image">
        <div >
          <p class="app-sidebar__user-name"><?php echo $_SESSION["user_nome"]; ?></p>
          <p class="app-sidebar__user-designation"><?php echo $_SESSION["user_nivel_nome"]; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li class="menu" id="menuDashboard" data-permissao="permissao_menuDashboard"><a class="app-menu__item" href="../dashboard/dashboard.php"><i style="margin-right: 13px;" class="app-menu__icon fa fa-dashboard fa-lg"></i><span class="app-menu__label"> Dashboard</span></a></li>
        <li id="menuPessoas" data-permissao="permissao_menuPessoas" class="treeview menu"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 13px;" class="app-menu__icon icon fa fa-users fa-lg"></i><span class="app-menu__label"> Pessoas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li class="submenu" id="submenuUsuários" data-permissao="permissao_submenuUsuários"><a class="treeview-item" href="../pessoas/usuario.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Usuários</a></li>
            <li class="submenu" id="submenuFuncionários" data-permissao="permissao_submenuFuncionários"><a class="treeview-item" href="../pessoas/funcionario.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Funcionários</a></li>
            <li class="submenu" id="submenuFornecedores" data-permissao="permissao_submenuFornecedores"><a class="treeview-item" href="../pessoas/fornecedores.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Fornecedores</a></li>
            <li class="submenu" id="submenuClientes" data-permissao="permissao_submenuClientes"><a class="treeview-item" href="../pessoas/clientes.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Clientes</a></li>
            <li class="submenu" id="submenuClientesRetorno" data-permissao="permissao_submenuClientesRetorno"><a class="treeview-item" href="../pessoas/clienteRetorno.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Clientes Retorno</a></li>
          </ul>
        </li>
        <li id="menucadastro" data-permissao="permissao_menucadastro" class="treeview menu"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 23px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i><span class="app-menu__label"> Cadastros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li class="submenu" id="submenuServico" data-permissao="permissao_submenuServico"><a class="treeview-item" href="../cadastro/servicos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Serviços</a></li>
            <li class="submenu" id="submenuCargo" data-permissao="permissao_submenuCargo"><a class="treeview-item" href="../cadastro/Cargos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Cargos</a></li>
            <li class="submenu" id="submenuProduto" data-permissao="permissao_submenuProduto"><a class="treeview-item" href="../cadastro/produtos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Produtos</a></li>
            <li class="submenu" id="submenuSaida" data-permissao="permissao_submenuSaida"><a class="treeview-item" href="../cadastro/saidas.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Saída de Produtos</a></li>
            <li class="submenu" id="submenuEntrada" data-permissao="permissao_submenuEntrada"><a class="treeview-item" href="../cadastro/entradas.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Entrada de Produtos</a></li>
            <li class="submenu" id="submenuEstoqueBaixo" data-permissao="permissao_submenuEstoqueBaixo"><a class="treeview-item" href="../cadastro/estoqueBaixo.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Estoque Baixo</a></li>
          </ul>
        </li>
        <li id="menuFinanceiro" data-permissao="permissao_menuFinanceiro" class="treeview menu"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 23px;" class="fa fa-bar-chart fa-sm" style="color: #ffffff;"></i><span class="app-menu__label"> Financeiro</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li class="submenu" id="submenuVendas" data-permissao="permissao_submenuVendas"><a class="treeview-item" href="../financeiro/vendas.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Vendas</a></li>
            <li class="submenu" id="submenuCompras" data-permissao="permissao_submenuCompras"><a class="treeview-item" href="../financeiro/compras.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Compras</a></li>
            <li class="submenu" id="submenuContasAPagar" data-permissao="permissao_submenuContasAPagar"><a class="treeview-item" href="../financeiro/contasAPagar.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Contas à Pagar</a></li>
            <li class="submenu" id="submenuContasAReceber" data-permissao="permissao_submenuContasAReceber"><a class="treeview-item" href="../financeiro/contasAReceber.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Contas à Receber</a></li>
            <li class="submenu" id="submenuComissao" data-permissao="permissao_submenuComissao"><a class="treeview-item" href="../financeiro/comissao.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Comissões</a></li>
          </ul>
        </li>
        <li id="menuAgendamento" data-permissao="permissao_menuAgendamento" class="treeview menu"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 23px;" class="fa fa-bar-chart fa-sm" style="color: #ffffff;"></i><span class="app-menu__label"> Agendamentos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li class="submenu" id="submenuVendas" data-permissao="permissao_submenuVendas"><a class="treeview-item" href="../agendamento/agenda.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Ver Agenda</a></li>
            <li class="submenu" id="submenuCargo" data-permissao="permissao_submenuCargo"><a class="treeview-item" href="../agendamento/agendamento.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Agendar</a></li>
          </ul>
        </li>
      </ul>
    </aside>