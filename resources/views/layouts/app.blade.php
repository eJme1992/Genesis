<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title',config('app.name'))</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Icon 16x16 -->
    <link rel="icon" type="image/png" sizes="240x240" href="{{asset('img/genesis2.png')}}">
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/datatables.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/Responsive-2.2.2/css/responsive.bootstrap.css')}}"> -->

    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ep.css')}}">

    <!-- Fileinput -->
    <link rel="stylesheet" href="{{ asset('plugins/fileinput/css/fileinput.min.css') }}">

    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{ asset('plugins/jquery_datepicker/jquery-ui.css') }}">

    <!-- confirm - jquery -->
    <link rel="stylesheet" href="{{ asset('plugins/confirm/jquery-confirm.min.css') }}">

    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select/css/bootstrap-select.min.css') }}" />

  	<style type="text/css">
      body, html, div, section, label, span, h1, h2, h3, h4, table, tr, td, select, input, textarea, option{
        font-family: calibri light, calibri, arial;
      }
	  </style>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="{{route('dashboard')}}" class="logo">
          <span class="logo-mini">
            DG
          </span>
          <span class="logo-lg"><b>Distribuidora G.</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs text-uppercase">{{ Auth::user()->usuario }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <p>
                      <i class="fa fa-user-o fa-5x"></i>
                    </p>
                    <p><cite>Bienvenido</cite></p>
                  </li>

                  <li class="user-footer">
                  	<div class="pull-left">
                  		<a href="{{route('perfil')}}" class="btn btn-flat btn-default">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Perfil
                      </a>
                  	</div>

                   	<div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-flat btn-default" type="submit">
                          <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                        </button>
                      </form>
                    </div>
                  </li>

                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Usuarios</a></li>
                <li><a href="{{ route('users.roles') }}"><i class="fa fa-circle-o"></i>Roles (perfiles)</a></li>
                <li><a href="{{ route('actividad') }}"><i class="fa fa-circle-o"></i>Actividad</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i>
                <span>Inventario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('proveedores.index') }}"><i class="fa fa-circle-o"></i>Proveedores</a></li>
                <li><a href="{{ route('marcas.index') }}"><i class="fa fa-circle-o"></i>Marcas</a></li>
                <li><a href="{{ route('colecciones.index') }}"><i class="fa fa-circle-o"></i>Colecciones</a></li>
                <li><a href="{{ route('productos.index') }}"><i class="fa fa-circle-o"></i>Consultas y Modelos</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-arrows-h"></i>
                <span>Rutas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('direcciones.index') }}"><i class="fa fa-circle-o"></i>Direcciones</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i>
                <span>Asignaciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('asignaciones.index') }}"><i class="fa fa-circle-o"></i>Modelos</a></li>
                <li><a href="{{ route('indexrutas') }}"><i class="fa fa-circle-o"></i>Rutas</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('ventas.index') }}"><i class="fa fa-circle-o"></i>Ventas</a></li>
                <li><a href="{{ route('clientes.index') }}"><i class="fa fa-circle-o"></i>Clientes</a></li>
                <li><a href="{{ route('guiaRemision.index') }}"><i class="fa fa-circle-o"></i>Guias de Remision</a></li>
              </ul>
            </li>

          </ul>
        </section>
      </aside>

      <div class="content-wrapper">
        <section class="content-header" style="background-color: #FFFFFF; padding: 1em; border-bottom: solid 1px #198F56;">
          <h1> @yield('header')</h1>
          @yield('breadcrumb')
        </section>
        <section class="content">@yield('content')</section>
      </div>

      <footer class="main-footer">
        <!-- Desarrollado por @luisb0992 -->
        <strong>Copyright &copy; 2016 - {{ date('Y') }}</strong> All rights reserved.
      </footer>
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
    <!-- Data table -->
    <script src="{{ asset('plugins/datatables/datatables.js') }}"></script>
    <!-- <script src="{{ asset('plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap.js')}}"></script> -->

    <!-- fileinput -->
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/themes/explorer/theme.js') }}"></script>

    <!-- numeric -->
    <script src="{{ asset('plugins/numeric.js') }}"></script>

    <!-- number format -->
    <script src="{{ asset('plugins/numberformat/input-number-format.jquery.js') }}"></script>

    <!-- datapicker -->
    <script src="{{ asset('plugins/jquery_datepicker/jquery-ui.js') }}"></script>

    <!-- confirm - jquery -->
    <script src="{{ asset('plugins/confirm/jquery-confirm.min.js') }}"></script>

    <!-- select2 -->
    <script src="{{ asset('plugins/select/js/bootstrap-select.min.js') }}"></script>

    <!-- propio script -->
    <script src="{{ asset('js/propio.js') }}"></script>

    @yield('script')
  </body>
</html>
