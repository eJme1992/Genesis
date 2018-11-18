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

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ep.css')}}">

    <!-- Fileinput -->
    <link rel="stylesheet" href="{{ asset('plugins/fileinput/css/fileinput.min.css') }}">

    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('plugins/jquery_datepicker/jquery-ui.css')}}">

  	<style type="text/css">
	    .perfil{
			  position: relative;
			  background: #fff;
			  border: 1px solid #f4f4f4;
			  padding: 20px;
			  margin: 10px 25px;
			}
      body, html, div, section, label, span, h1, h2, h3, h4, table, tr, td, select, input, textarea, option{
        font-family: calibri light, calibri, arial;
      }
	  </style>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
            <img class="img-responsive" src="{{ asset('img/genesis2.png') }}" alt="Logo" style="height:40px">
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Distribuidora G.</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ Auth::user()->usuario }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      DESCRIPCCION
                      <small></small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                  	<div class="pull-left">
                  		<a href="{{route('perfil')}}" class="btn btn-flat btn-default"><i class="fa fa-user-circle" aria-hidden="true"></i> Perfil</a>
                  	</div>

                   	<div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-flat btn-default" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
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
                <!-- <li><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i>Agregar usuario</a></li> -->
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
                <li><a href="{{ route('clientes.index') }}"><i class="fa fa-circle-o"></i>Clientes</a></li>
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
                <li><a href="{{ route('guiaRemision.index') }}"><i class="fa fa-circle-o"></i>Guias de Remision</a></li>
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
                <li><a href="{{ route('ventas.index') }}"><i class="fa fa-circle-o"></i>Ver Ventas</a></li>
              </ul>
            </li>


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>
            @yield('header')
          </h1>
          @yield('breadcrumb')
        </section>
        <!-- Main content -->
        <section class="content">
        	@yield('content')
        </section>
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <strong>Copyright &copy; 2016 - {{ date('Y') }}</strong> All rights reserved.
      </footer>
    </div><!-- .wrapper -->
    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{asset('js/app.min.js')}}"></script>
    
    <!-- Data table -->
    <script type="text/javascript" src="{{asset('plugins/datatables/datatables.js')}}"></script>

    <script type="text/javascript" src="{{ asset('plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap.js')}}"></script>

    <!-- fileinput -->
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/themes/explorer/theme.js') }}"></script>

    <!-- numeric -->
    <script src="{{ asset('plugins/numeric.js') }}"></script>

    <!-- number format -->
    <script src="{{ asset('plugins/numberformat/input-number-format.jquery.js') }}"></script>

    <!-- datapicker -->
    <script src="{{ asset('plugins/jquery_datepicker/jquery-ui.js') }}"></script>

    <script type="text/javascript">

      $(document).ready(function(){
      	//Eliminar alertas que no contengan la clase alert-important luego de 7seg
      	// $('div.alert').not('.alert-important').delay(7000).slideUp(300);

      	//activar Datatable
        $('.data-table').DataTable({
          responsive: true,
          language: {
          	url:'{{asset("plugins/datatables/spanish.json")}}'
          }
        });

        // file input para imagenes
        $("#file_input").fileinput({
          'showUpload': false,
          'previewFileType':'any',
          'allowedFileTypes': ["image"],
          'allowedFileExtensions': ["jpg", "gif", "png"],
          'elErrorContainer': "#errorBlock",
          'maxFilePreviewSize': 5000,
          'browseClass': "btn btn-primary btn-block"
        });

        // datapicker español
        $.datepicker.regional['es'] = {
         closeText: 'Cerrar',
         prevText: '< Ant',
         nextText: 'Sig >',
         currentText: 'Hoy',
         monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
         dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
         dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
         dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
         weekHeader: 'Sm',
         dateFormat: 'dd/mm/yy',
         firstDay: 1,
         isRTL: false,
         showMonthAfterYear: false,
         yearSuffix: ''
         };

        $.datepicker.setDefaults($.datepicker.regional['es']);

        // datapicker
        $(".fecha").datepicker();
        
        // numeric
        $('.numero').numeric();
        $(".int").numeric({ 
          decimal: false, 
          negative: false 
        }, function() { 
          alert("Ingrese solo numeros"); 
          this.value = ""; 
          this.focus(); 
        });

        // number format
        $('.nf').inputNumberFormat({
          'decimal': 2,
          'decimalAuto': 2,
          'separator': '.',
          'separatorAuthorized': ['.']
        });
      });
    </script>

    @yield('script')
  </body>
</html>
