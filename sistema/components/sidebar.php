 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="width: 30px;" src="../../assets/images/avatar.png" alt="User Image">
        <div>
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
        <li id="menucadastro" data-permissao="permissao_menucadastro" class="treeview menu"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 23px;" class="icon fa fa-plus fa-lg" style="color: #fafcff;"></i><span class="app-menu__label"> Cadastro</span><i class="treeview-indicator fa fa-angle-right"></i></a>
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
            <li class="submenu" id="submenuServico" data-permissao="permissao_submenuServico"><a class="treeview-item" href="../cadastro/servicos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Serviços</a></li>
            <li class="submenu" id="submenuCargo" data-permissao="permissao_submenuCargo"><a class="treeview-item" href="../cadastro/Cargos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Cargos</a></li>
            <li class="submenu" id="submenuProduto" data-permissao="permissao_submenuProduto"><a class="treeview-item" href="../cadastro/produtos.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Produtos</a></li>
            <li class="submenu" id="submenuSaida" data-permissao="permissao_submenuSaida"><a class="treeview-item" href="../cadastro/saidas.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Saída de Produtos</a></li>
            <li class="submenu" id="submenuEntrada" data-permissao="permissao_submenuEntrada"><a class="treeview-item" href="../cadastro/entradas.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Entrada de Produtos</a></li>
            <li class="submenu" id="submenuEstoqueBaixo" data-permissao="permissao_submenuEstoqueBaixo"><a class="treeview-item" href="../cadastro/estoqueBaixo.php"><i style="margin-right: 10px;" class="icon fa fa-angle-right"></i> Estoque Baixo</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i style="margin-right: 13px;" class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="form-components.html"><i class="icon fa fa-circle-o"></i> Form Components</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Custom Components</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Form Samples</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Form Notifications</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Basic Tables</a></li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon fa fa-circle-o"></i> Data Tables</a></li>
          </ul>
        </li>
      </ul>
    </aside>