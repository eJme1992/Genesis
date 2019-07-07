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

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/datatables.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ep.css')}}">

    <!-- Fileinput -->
    <link rel="stylesheet" href="{{ asset('plugins/fileinput/css/fileinput.min.css') }}">

    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{ asset('plugins/jquery_datepicker/jquery-ui.min.css') }}">

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
                <i class="fa fa-database"></i>
                <span>Inventario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('proveedores.index') }}"><i class="fa fa-circle-o"></i>Proveedores</a></li>
                <li><a href="{{ route('marcas.index') }}"><i class="fa fa-circle-o"></i>Marcas</a></li>
                <li><a href="{{ route('colecciones.index') }}"><i class="fa fa-circle-o"></i>Colecciones</a></li>
                <li><a href="{{ route('kardex.index') }}"><i class="fa fa-circle-o"></i>Kardex</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-archive-o"></i>
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
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nueva venta
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('create_venta_directa') }}"><i class="fa fa-circle-o"></i> Venta Oficina</a>
                    </li>
                    <li>
                        <a href="{{ route('create_venta_asignacion') }}"><i class="fa fa-circle-o"></i> Venta Productos Asignados</a>
                    </li>
                    <li>
                        <a href="{{ route('create_venta_consignacion') }}"><i class="fa fa-circle-o"></i> Venta Productos Consignados</a>
                    </li>
                  </ul>
                </li>
                <li><a href="{{ route('consignacion.index') }}"><i class="fa fa-circle-o"></i>Consignaciones</a></li>
                <li><a href="{{ route('pagos.index') }}"><i class="fa fa-circle-o"></i>Pagos</a></li>
                <li><a href="{{ route('devoluciones.index') }}"><i class="fa fa-circle-o"></i>Devoluciones</a></li>
                <li><a href="{{ route('clientes.index') }}"><i class="fa fa-circle-o"></i>Clientes</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-o"></i>
                <span>Documentos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('notapedido.index') }}"><i class="fa fa-circle-o"></i>Notas de pedido</a></li>
                <li><a href="{{ route('facturas.index') }}"><i class="fa fa-circle-o"></i>Facturas</a></li>
                <li><a href="{{ route('guiaRemision.index') }}"><i class="fa fa-circle-o"></i>Guias de Remision</a></li>
                <li><a href="{{ route('notacredito.index') }}"><i class="fa fa-circle-o"></i>Notas de credito</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Seguridad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Usuarios</a></li>
                <li><a href="{{ route('users.roles') }}"><i class="fa fa-circle-o"></i>Perfiles (roles)</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Permisos</a></li>
                <li><a href="{{ route('actividad') }}"><i class="fa fa-circle-o"></i>Actividad</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Auditoria</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Respaldo y Restauracion</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="{{ route('direcciones.index') }}">
                <i class="fa fa-circle-o"></i>Direcciones
              </a>
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
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>

    <!-- fileinput -->
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/fileinput/themes/explorer/theme.js') }}"></script>

    <!-- numeric -->
    <script src="{{ asset('plugins/numeric.js') }}"></script>

    <!-- number format -->
    <script src="{{ asset('plugins/numberformat/input-number-format.jquery.js') }}"></script>

    <!-- datapicker -->
    <script src="{{ asset('plugins/jquery_datepicker/jquery-ui.min.js') }}"></script>

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
              $("#add_cliente, #edit_cliente").empty().append(res);
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
            $("#motivo_guia").text(data.consig.guia.motivo_guia.nombre);
            $("#cliente_guia").text(data.consig.guia.cliente.nombre_full);
            $("#dir_salida").text(data.dir_salida);
            $("#dir_llegada").text(data.dir_llegada);
            $("#data_detalles_guia").empty().append(data.data_det_guia);
        }

        // calcular restante de la venta
        function calcularRestante(monto){
            valor = (monto.value < 0) ? monto.value = 0 : monto.value = monto.value;
            $("#restante").val((parseFloat($("#total_deuda").val()) - parseFloat(valor)));
        }

        // escuchando el evento tipo de abono para letras
        $('#tipo_abono_id').change(function(event) {
            if ($('#tipo_abono_id').val() == 1) {
                $('#section_letra').show();
                $("#estatus_id, #protesto_id, #numero_unico, #monto_inicial, #monto_final, #fecha_inicial, #fecha_final, #fecha_pago, #no_adeudado").prop('required', true);
            }else{
                $('#section_letra').hide();
                $("#estatus_id, #protesto_id, #numero_unico, #monto_inicial, #monto_final, #fecha_inicial, #fecha_final, #fecha_pago, #no_adeudado").prop('required', false);
            }
        });

        // calcular impuesto de factura
        function calcularImpuesto(porcentaje){
            subtotal = $("#subtotal").val();
            valor = (porcentaje.value < 0) ? porcentaje.value = 0 : porcentaje.value = porcentaje.value;
            calculo =  (parseFloat(subtotal) * parseFloat(valor)) / 100;
            $("#total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
        }

        // reiniciar el campos de venta, factura, pago, etc
        function reiniciarMontoTotal(){
            $(".total_venta, .subtotal, #abono, #restante, #monto_inicial, #monto_inicial, #fecha_inicial, #fecha_final, #fecha_pago").val('');
        }

    </script>
    
  </body>
</html>
