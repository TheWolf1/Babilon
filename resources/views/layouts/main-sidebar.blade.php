<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/dist/img/Logo-04.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>BABILON</b> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{ !Route::is('home') ?: 'active'}}">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview  {{ !Route::is('correos') ?: 'menu-open'}}  {{ !Route::is('todos_correos') ?: 'menu-open'}}">
            <a href="#" class="nav-link {{ !Route::is('correos') ?: 'active'}} {{ !Route::is('todos_correos') ?: 'active'}}">
              <i class="nav-icon fas fa-mail-bulk"></i>
              <p>
                Correos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('correos')}}" class="nav-link {{ !Route::is('correos') ?: 'active'}}">
                  <i class="fas fa-envelope nav-icon"></i>
                  <p>Correos libres</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('todos_correos')}}" class="nav-link {{ !Route::is('todos_correos') ?: 'active'}}">
                  <i class="fas fa-envelope-open nav-icon"></i>
                  <p>Todos los correos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('clientes')}}" class="nav-link {{ !Route::is('clientes') ?: 'active'}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('pxp')}}" class="nav-link {{ !Route::is('pxp') ?: 'active'}}">
              <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Precio por producto
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('servicios')}}" class="nav-link {{ !Route::is('servicios') ?: 'active'}}">
              <i class="nav-icon fas fa-award"></i>
              <p>
                Servicios
              </p>
            </a>
          </li>
          @if (Auth::user()->rol_id == '1')
          <li class="nav-item">
            <a href="{{route('ingresos')}}" class="nav-link {{ !Route::is('ingresos') ?: 'active'}}">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Ingresos
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('user')}}" class="nav-link {{ !Route::is('user') ?: 'active'}}">
              <i class="nav-icon fa fa-user-plus"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>