<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title><!--parte cambiante con yield-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/css/darkmode.css">
  <link rel="stylesheet" href="/css/imagenfondo.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  {{--libreria sweetalert2--}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  {{--JQUERY--}}
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  
  {{--para datatables--}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap5.css">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class=" wrapper  ">
  <!-- Navbar -->
  <nav id="navprincipal" class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav col-10">
      <li class="nav-item ">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ">
        <a href="#" class="nav-link">Contact</a>
      </li>
      
    </ul>
    <div class="col-1 modo" id="modo">
      <i class="fas fa-toggle-on"></i>
    </div>
    <ul class="navbar-nav ml-auto">

      <li>
        <form action="{{route('logout')}}" method="post" class="col-2">
          @csrf<!-- crea un token de seguridad-->
          <button class="btn btn-light" type="submit">
            <i class="fa fa-power-off"></i> Salir</button>
            
        </form>
        
      </li>
    </ul>
    
    {{--<form action="route('logout')" method="post" class="col-1">
      @csrf<!-- crea un token de seguridad-->
      <button class="btn btn-info btn-block" type="submit">
        <i class="fa fa-power-off"></i> Salir</button>
        
    </form>--}}

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="{{route('home')}}" style="text-decoration:none;" class="brand-link">
      <img src="/img/logo.png" alt="KAMIL" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
        <div class="image">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
           <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info usuario">
          <a href=""  class="d-block" style="text-decoration:none;">Usuario: {{auth()->user()->name}}</a>
          <a class="d-block" style="text-decoration:none;"></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ request()->is('usuario*') || request()->is('permiso*') || request()->is('rol*') ? 'menu-open' : '' }}" >
            <a href="{{--route('prestamo.index')--}}" class="nav-link {{ request()->is('usuario*') || request()->is('permisos*') || request()->is('roles*') ? 'active' : '' }}" >
              <i class="fas fa-shield-alt"></i>
              <p>
                SEGURIDAD
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @can('permiso.index')
              <li class="nav-item">
                <a href="{{route('permiso.index')}}" class="nav-link {{ request()->is('permiso*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permisos</p>
                </a>
              @endcan
              </li>
              @can('role.index')
              <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link {{ request()->is('rol*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              @endcan
              </li>
              <li class="nav-item">
                <a href="{{route('usuario.index')}}" class="nav-link {{request()->is('usuario*') ? 'active' : ''}}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuario</p>
                </a>
                
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Gestion Abastecimiento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('listado')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedor</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('listadoB')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bibliotecario</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('listadoL')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libros</p> 
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('listadoP')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('listadoDP')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detalle Pedido</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{--route('graficoA')--}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          {{-- @if(auth()->user()->roles->Descripcionrol == 'ROLE_USER')
              <h2>Eres un cliente</h2>
          @endif --}}
          
          <li class="nav-item">
            <a href="{{--route('tienda')--}}" class="nav-link">
              <i class="fas fa-store    "></i>
              {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
              <p>
                Tienda
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{--route('comprobante.index')--}}" class="nav-link">
              <i class="fas fa-receipt    "></i>
              {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
              <p>
                Comprobantes-Tienda
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{--route('perfil.index')--}}" class="nav-link">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
              <p>
                Mi Perfil
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            
          </li>
          
          <li class="nav-item">
            <a href="{{--route('usuario.index')--}}" class="nav-link">
             <i class="fa fa-users" aria-hidden="true"></i>
              {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
              <p>
                Usuarios
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{--route('rol.index')--}}" class="nav-link">
              <i class="fa fa-align-justify" aria-hidden="true"></i>
              {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
              <p>
                Roles
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">
        @yield('contenido')<!--PARA cambiar este contenido en otra vista-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>
<script src="/js/dark.js"></script>
@yield('script')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

{{--para datables--}}
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap5.js"></script>
</html>
