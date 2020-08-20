<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">       
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header"></li>
        <li id="mEscritorio">
        <a href="/">
          <i class="fa fa-tasks"></i> <span>Escritorio</span>
        </a>
      </li>
      @if(Auth::user()->tipo_usuario_id == 1)
      <li id="mAlmacen" class="treeview">
        <a href="#">
          <i class="fa fa-cog"></i>
          <span>Configuración</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="lanio"><a href="{{ route('aniosView') }}"><i class="fa fa-circle-o"></i> Años</a></li>
        </ul>
        <ul class="treeview-menu">
          <li id="lcotas"><a href="{{ route('cuotasView') }}"><i class="fa fa-circle-o"></i> Cuotas</a></li>
        </ul>
        <ul class="treeview-menu">
          <li id="lub"><a href="{{ route('ubicacionesView') }}"><i class="fa fa-circle-o"></i> Ubicaciones</a></li>
        </ul>
        <ul class="treeview-menu">
          <li id="lub"><a href="{{ route('clientesView') }}"><i class="fa fa-circle-o"></i> Clientes</a></li>
        </ul>
      </li>
      @endif

      @if(Auth::user()->tipo_usuario_id == 1)
        <li id="mAcceso" class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Acceso</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li id="lUsuarios"><a href="{{ route('usersView') }}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li id="ltipoUsuario"><a href="{{ route('tipoUsuariosView') }}"><i class="fa fa-circle-o"></i> Tipo Usuarios</a></li>
            
          </ul>
        </li>        
      @endif
      
      <li>
        <a href="#">
          <i class="fa fa-plus-square"></i> <span>Ayuda</span>
          <small class="label pull-right bg-red">PDF</small>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
          <small class="label pull-right bg-yellow">SICOB</small>
        </a>
      </li>
                  
    </ul>
  </section>
        <!-- /.sidebar -->
      </aside>