@extends('layouts.app')
@section('title','Notas de Pedido - '.config('app.name'))
@section('header','Notas de Pedido')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Notas de Pedido </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-right"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Notas de Pedido</span>
              <span class="info-box-number">{{ count($notapedidos) }}</span>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Notas de Pedido</h3>
                    <span class="pull-right">
                        <span data-toggle="tooltip" title="Realizar Nota de pedido">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#create_notapedido">
                                    <i class="fa fa-plus"></i> Nueva
                            </button>
                        </span>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover text-center">
                        <thead class="label-danger">
                            <tr>
                                <th>Codigo</th>
                                <th>Nº Pedido</th>
                                <th>Motivo</th>
                                <th>Cliente</th>
                                <th>Direccion</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th class="bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notapedidos as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->n_pedido }}</td>
                                    <td>{{ $d->motivo->nombre }}</td>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ $d->direccion->full_dir() }}</td>
                                    <td>{{ $d->total }}</td>
                                    <td>{{ $d->createF() }}</td>
                                    <td>
                                        {{-- editar nota de pedido --}}
                                        <span data-toggle="modal" data-target="#editar_notapedido">
                                            <button type="button" class="btn bg-orange btn-xs benp" data-toggle="tooltip" title="Editar nota" data-id="{{ $d->id }}" data-npedido="{{ $d->n_pedido }}" data-motivo="{{ $d->motivo_nota_id }}" data-cliente="{{ $d->cliente_id }}" data-direccion="{{ $d->direccion_id }}"  data-total="{{ $d->total }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </span>

                                        {{-- ver modelos pedido --}}
                                        <span data-toggle="modal" data-target="#show_modelos_{{ $d->id }}">
                                            <button type="button" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Ver modelos">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($notapedidos as $d)
        @include("notapedido.modals.show_modelos")
    @endforeach
    @include("notapedido.modals.edit_notapedido")
    @include("notapedido.modals.create_notapedido")
    @include('direcciones.modals.modal_create')    
    @include('clientes.modals.createclientes') 
@endsection
@section("script")
<script>

    var saveNotaPedido = $(".btn_save_np").attr("disabled", "disabled");

    $("#select_coleccion").val('').prop('selected', true);

    $(".div_tablas_modelos").on('click', '.check_model', function(e) {
        var check = $(this).val();
    });

    $("#check_all_model").click(function(e) {
        var bool = $(".check_model").checked;
        if (bool.length) {
            if (bool === false) {
                bool.checked;
            }else{
                bool.checked == false;
            }
        }
    });
    
    // cargar modelos en la tabla para calcular
    function cargarModelos(){
        $("#btn_cargar_modelos").attr('disabled', 'disabled');
        $("#icon-cargar-modelos").show();
        if ($("#select_coleccion").val() && $("#select_marca").val()) {
            $.get("cargarTabla/"+$("#select_coleccion").val()+"/"+$("#select_marca").val()+"",function(response, dep){
                $('.data-table').DataTable().destroy();
                $("#data_modelos_venta_directa").empty().html(response);
                $('.data-table').DataTable({responsive: true});

                $("#btn_cargar_modelos").removeAttr("disabled");
                $("#icon-cargar-modelos").hide();
                validarEstuche();
            });
        }else{
            mensajes("Alerta!", "Nada para mostrar, debe llenar todos los campos", "fa-warning", "red");
            $("#btn_cargar_modelos").removeAttr("disabled");
            $("#icon-cargar-modelos").hide();
        }
    }

    function validarEstuche(){
        if ($(".estuches").length > 0 ) {
            if ($(".estuches").val() != '') {
                $("#span_select_estuche").show(400);
                $("#span_info_estuche").hide(400);
                $("#status_estuche").attr({
                    required: 'required',
                    name: 'status_estuche'
                });
            }else{
                $("#span_select_estuche").hide(400);
                $("#span_info_estuche").show(400);
                $("#status_estuche").removeAttr('required').prop('name', '');
            }
        }else{
            $("#span_select_estuche, #span_info_estuche").hide(400);
            $("#status_estuche").removeAttr('required').prop('name', '');
        }
    }

        // Calcular monto y total
    function calcularMontoTotal(){
        total = 0; error = false;
        $.each($(".table > tbody > tr"), function(index, val) {
            montura = parseInt($(this).find('.montura_modelo').val());
            precio  = parseFloat($(this).find('.costo_modelo').val());

            if (!Number(montura)) {
                costo = 0;
                $(this).find('.costo_modelo').val(0);
                $(this).find('.preciototal').val(0);
            }else{
                costo = montura * precio;
                if (!Number(costo)) { 
                    error = true;
                }else{
                    $(this).find('.preciototal').val(costo);
                }
            }
            total += costo;
        });

        if (error) {
            mensajes("Alerta!", "El precio o la montura es incorrecta, deben ser solo numeros, verifique", "fa-remove", "red");
            saveNotaPedido.prop("disabled", true);
            return false;
        }else{
            if (Number(total) || total > 0) {
                saveNotaPedido.removeAttr("disabled");
            }else{
                mensajes("Alerta!", "El total es incorrecto, verifique", "fa-remove", "red");
                saveNotaPedido.prop("disabled", true);
            }
        }

        $(".total_venta").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);
    }

    // busqueda de marcas en la coleccion
    $('#select_coleccion').change(function(event) {
        $("#select_marca").empty();
        $.get("marcasAll/"+event.target.value+"",function(response, dep){
            if (response.length > 0) {
                for (i = 0; i<response.length; i++) {
                    $("#select_marca").append(
                        "<option value='"+response[i].marca.id+"'>"
                        +response[i].marca.material.name+' | '+response[i].marca.name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
            }
            $("#data_modelos_venta_directa").empty();
        });
    });

    // evitar el siguiente si se cambia cualquier valor en la carga de modelos
    $('#select_coleccion').change(function(e) {
        reiniciarMontoTotal();
        saveNotaPedido.prop("disabled", true);
    });

    // copiar y pegar modelo en buscador de la tabla y aplicar la busqueda
    $(".div_tablas_modelos").on("click", ".btn_nm", function(e) {
        e.preventDefault();
        $("table.data-table.ok input[type='search']").empty().val($(this).val());
        $('table.data-table.ok').DataTable().search($(this).val()).draw();    
    });

    $(".benp").click(function(e) {
        ruta = '{{ route("notapedido.update",":value") }}';
        $("#form_edit_notapedido").attr("action", ruta.replace(':value', $(this).data("id")));

        $("#n_pedido, #motivo_nota_id, #cliente_id, #direccion_id, #total").val("");

        $("#n_pedido").val($(this).data("npedido"));
        $("#motivo_nota_id").val($(this).data("motivo")).attr("selected",true);
        $("#cliente_id").val($(this).data("cliente")).attr("selected",true);
        $("#direccion_edit").val($(this).data("direccion")).attr("selected",true);
        $("#total").val($(this).data("total"));
    });

    $("#form_create_notapedido").submit(function(e){
        if ($('.total_venta').val() == 'NaN' || $('.total_venta').val() < 0) {
            mensajes("Alerta!", "El total no puede ser negativo ni pueden ser letras, verifique", "fa-warning", "red");
            return false;
        }

        e.preventDefault();
        saveNotaPedido.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('notapedido.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Nota de pedido procesada, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "notapedido", 3000);
        })
        .fail(function(data) {
            saveNotaPedido.removeAttr("disabled");
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>
@endsection