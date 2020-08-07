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