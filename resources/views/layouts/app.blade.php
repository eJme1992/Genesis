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
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/Responsive-2.2.2/css/responsive.bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ep.css')}}">

    <!-- Fileinput -->
    <link rel="stylesheet" href="{{ asset('plugins/fileinput/css/fileinput.min.css') }}">

    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{ asset('plugins/jquery_datepicker/jquery-ui.css') }}">

    <!-- confirm - jquery -->
    <link rel="stylesheet" href="{{ asset('plugins/confirm/jquery-confirm.min.css') }}">

    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />

  	<style type="text/css">
      body, html, div, section, label, span, h1, h2, h3, h4, table, tr, td, select, input, textarea, option{
        font-family: 'Abel', sans-serif;
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
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-arrows-h"></i>
                <span>Ubicaciones</span>
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
                <li><a href="{{ route('ventas.create') }}"><i class="fa fa-circle-o"></i>Nueva venta</a></li>
                <li><a href="{{ route('clientes.index') }}"><i class="fa fa-circle-o"></i>Clientes</a></li>
                <li><a href="{{ route('guiaRemision.index') }}"><i class="fa fa-circle-o"></i>Guias de Remision</a></li>
                <li><a href="{{ route('consignacion.index') }}"><i class="fa fa-circle-o"></i>Consignacion</a></li>
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
    <script src="{{ asset('plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap.js')}}"></script> 

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
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <!-- inicializacion de plugins -->
    <script src="{{ asset('js/propio.js') }}"></script>

    @yield('script')

    <!------------------------------------------------------ funciones para la logica ------------------------------------------------------>
    <script>
        // mensajes de alerta
        function mensajes(title, content, icon, type){
            $.alert({
                title: title,
                content: content,
                icon: "fa"+icon,
                theme: 'modern',
                type: type
            });
        }

        // manipular errores por json
        function eachErrors(data){
            msj = '';

            $.each(data.responseJSON.errors, function(index, val) {
                msj += "<li class='list-group-item list-group-item-danger'>"+ val +"</li>";
            });

            return msj;
        }

        // validacion para el campo estuche
        function addEstuches(contador){
            if (validarEstuche == 1) {
                $('#select_estuche, #select_estuche'+contador+'').removeAttr("disabled").attr('name', 'estuche[]').val(12);
            }else{
                $('#select_estuche, #select_estuche'+contador+'').attr("disabled", "disabled").removeAttr('name').val(0);
            }
        }

        // cargar clientes
        function viewCliente(){
          $.get("{{ route('viewClientes') }}", function(res){
              $("#add_cliente").empty().append(res);
          });
        }

        // cargar direcciones
        function allDir(){
            $.get('{{ route("allDireccion") }}', function(response, dir){
                    $(".dir_asig").empty().append(response);
            });
        }

        // guardar clientes
        $("#form_cliente_save").on("submit", function(e) {
            e.preventDefault();
            btn = $(".btn_create_cliente");
            btn.addClass("disabled");
            form = $(this);

            $.ajax({
                url: '{{ route("clientes.store") }}',
                headers: {'X-CSRF-TOKEN': $("#token").val()},
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
            })
            .done(function(data) {
                if ($("#data_clientes").length > 0) {
                    location.reload(400);
                }
                viewCliente();
                form[0].reset();
                btn.text("Guardar").removeClass("disabled");
                $("#create_cliente").modal('toggle');
                mensajes('Listo!', "Cliente agregado", 'fa-check', 'green');
            })
            .fail(function(data) {
                btn.removeClass("disabled");
                mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        // guardar direccion
        $(".form_create_direccion").on('submit', function(e) {
            e.preventDefault();
            btn = $(".btn_create_direccion");
            btn.attr("disabled", 'disabled');
            var form = $(this);

            $.ajax({
                url: "{{ route('direcciones.store') }}",
                headers: {'X-CSRF-TOKEN': $("#token").val()},
                type: 'POST',
                dataType: 'JSON',
                data: form.serialize(),
            })
            .done(function(data) {
                allDir();
                if (data == 1) {
                    mensajes('Alerta!', 'Direccion ya existente, verifique', 'fa-warning', 'red');
                    btn.text("Guardar").removeAttr("disabled");
                }else{
                    if ($("#data_dir").length > 0) {
                        location.reload(400);
                    }
                    mensajes('Listo!', 'Agregado con exito', 'fa-check', 'green');  
                    form[0].reset();
                    $(".modal_create_direccion").modal('toggle');
                    btn.text("Guardar").removeAttr("disabled");
                }
            })
            .fail(function(data) {
                btn.text("Guardar").removeAttr("disabled");
                mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        // busqueda de provincias
        $('.dep').change(function(e) {
            $(".prov, .dist").empty();
            $(".prov").append("<option value=''>...</option>");
            ruta = "{{ route('allProv', 'e.target.value') }}";
            ruta = ruta.replace('e.target.value', e.target.value);
            $.get(ruta,function(response){
                $(".prov").append(response);
            });
        });

        // busqueda de distritos
        $('.prov').change(function(e) {
            ruta = "{{ route('allDist', 'e.target.value') }}";
            ruta = ruta.replace('e.target.value', e.target.value);
            $.get(ruta,function(response){
                $(".dist").empty().append(response);
            });
        });

        // cargar datos de la consigncaion y modelos
        function cargarDataConsignacionYModelos(data){
            $("#id_consig").val(data.consig.id);
            $("#cliente").text(data.consig.cliente.nombre_full);
            $("#fecha_envio").text(data.consig.fecha_envio);
            $("#data_modelos").empty().append(data.data);
            $(".cliente_id").val(data.consig.cliente_id);
        }

        // cargar data de la guia
        function cargarGuia(data){
            $("#id_guia").val(data.consig.guia.id);
            $("#serie").text(data.consig.guia.serial);
            $("#dir_salida").text(data.dir_salida);
            $("#dir_llegada").text(data.dir_llegada);
            $("#ref_item_id").text(data.consig.guia.detalle_guia.item.nombre);
            $("#cantidad").text(data.consig.guia.detalle_guia.cantidad);
            $("#peso").text(data.consig.guia.detalle_guia.peso);
            $("#descripcion").text(data.consig.guia.detalle_guia.descripcion);
        }

    </script>
    
  </body>
</html>
