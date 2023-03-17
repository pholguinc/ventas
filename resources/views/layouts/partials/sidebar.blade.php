<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html"> <img alt="image" src="{{ url('storage/img/logo.png') }}" class="header-logo" /> <span
          class="logo-name">Otika</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="briefcase"></i><span>Administración</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="widget-chart.html">Roles</a></li>
          <li><a class="nav-link" href="widget-data.html">Usuarios</a></li>
        </ul>
      </li>
      <li class="menu-header">Módulos</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="box"></i><span>Cajas</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="chat.html">Lista de Cajas</a></li>
          <li><a class="nav-link" href="portfolio.html">Administrar Cajas</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Mantenimiento</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.categories') }}">Categorías</a></li>
          <li><a class="nav-link" href="{{ route('admin.customers') }}">Clientes</a></li>
          <li><a class="nav-link" href="{{ route('admin.brands') }}">Marcas</a></li>
          <li><a class="nav-link" href="{{ route('admin.products') }}">Productos</a></li>
          <li><a class="nav-link" href="{{ route('admin.providers') }}">Proveedores</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Taller</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="alert.html">Órdenes</a></li>
          <li><a class="nav-link" href="badge.html">Técnicos</a></li>
        </ul>
      </li>
      <li class="menu-header">POS</li>
      <li class="dropdown">
        <a href="#" class="nav-link"><i
            data-feather="calendar"></i><span>Inventario</span></a>
      </li>
      <li><a class="nav-link" href="blank.html"><i data-feather="activity"></i><span>Reportes</span></a></li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="truck"></i><span>Compras</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="basic-form.html">Nueva Compra</a></li>
          <li><a class="nav-link" href="forms-advanced-form.html">Historial de Compras</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Ventas</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="basic-table.html">Nueva Venta</a></li>
          <li><a class="nav-link" href="advance-table.html">Historial de Ventas</a></li>
        </ul>
      </li>
      <li class="menu-header">Sistema</li>
      <li class="dropdown">
        <a href="#" class="nav-link"><i
            data-feather="settings"></i><span>Configuración</span></a>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="database"></i><span>Base de Datos</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="icon-font-awesome.html">Copia de Seguridad</a></li>
          <li><a class="nav-link" href="icon-material.html">Restablecer BD</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link"><i
            data-feather="help-circle"></i><span>Información del Sistema</span></a>
      </li>
    </ul>
  </aside>
