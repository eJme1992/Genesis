@extends('layouts.app')
@section('title','Devolucion - '.config('app.name'))
@section('header','Nueva Devolucion')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Devolucion / Nueva </li>
    </ol>
@endsection
@section('content')

<div class="row">

    {{-- panel - datos --}}
    <div class="col-lg-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><i class="fa fa-arrow-right"></i> Ventas</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Codigo + Fecha venta</label>
                    <select name="venta_id" class="form-control select2" id="venta">
                        @foreach($ventas as $v)
                        <option value="{{ $v->id }}">{{ 'Codigo ['.$v->id.'] - Fecha ['.$v->fecha.']' }}</option>
                        @endforeach
                    </select><hr>

                    <span class="pull-right">
                        <button type="button" class="btn btn-success" id="btn_buscar_venta">
                            <i class="fa fa-spinner fa-pulse" id="icon-buscar-venta" style="display: none"></i> Buscar
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><i class="fa fa-arrow-right"></i> Datos</h3>
            </div>
            <div class="panel-body">
                <form id="form_save_devolucion">
                    <section id="section_venta">
                        <h3 class="padding_05em bg-green col-lg-12"><i class="fa fa-arrow-right"></i> Datos de la venta</h3>
                        @include("devoluciones.partials.section_venta")
                        @include("devoluciones.partials.tabla_modelos_venta")

                        <div class="form-group col-lg-3">
                            <label>Total a facturar</label>
                            <input type="number" name="total_facturar" class="form-control" readonly="" id="total_facturar" step='0.01' max='999999999999' min='1'>
                        </div>
                    </section>
                    
                    <section id="section_coleccion_marca">
                        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Cargar modelos a facturar</h3>
                        @include("ventas.partials.sections_venta_directa.section_cargar_modelos")
                        @include("ventas.partials.sections_venta_directa.section_mostrar_datos_cargados") 
                    </section>

                    <section id="section_devolucion">
                        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Nota de credito</h3>
                        @include("devoluciones.partials.section_devolucion")
                    </section>
                    
                    <section id="section_factura">
                        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Factura</h3>
                        @include("ventas.partials.sections.section_factura")
                    </section>

                    <div class="form-group col-lg-12 text-uppercase">
                        <label for="">Guia de remision</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="checkbox_guia" value="0" id="checkbox_guia">
                                Enviar con guia?
                            </label>
                        </div>
                    </div>

                    {{-- GUIA DE REMISION --}}
                    <section id="section_guia" class="container-fluid" style="display: none;">
                        <h4 class="padding_1em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
                        @include("consignaciones.partials.formGuia")
                    </section>

                    <div class="form-group col-lg-12"><hr>
                        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
                        <button type="submit" class="btn btn-success btn-flat" id="btn_guardar_all" disabled="disabled">
                            <i class="fa fa-save" id="icon-guardar-all"></i> Procesar Venta
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
           
</div>
@include('direcciones.modals.modal_create')
@endsection
@section("script")
<script>

    var totalFacturar = 0, btnGuardarTodo = $("#btn_guardar_all");
    $("#select_coleccion").val('').prop('selected', true);
    $("#checkbox_guia").prop('checked', false);
    $(".total_venta, .subtotal, #abono, #restante, #total_facturar, #user_id, #cliente_id, #direccion_id").val('');


    $("#checkbox_guia").click(function(e) {
        var bool = this.checked;
        if(bool === true){
            $("#section_guia").animate({height: "toggle"}, 400);
            $("#checkbox_guia").val(1);
            $("#serial, #guia, #dir_salida, #dir_llegada, #item, #cantidad, #peso").prop('required', true);
        }else{
            $("#section_guia").animate({height: "toggle"}, 400);
            $("#checkbox_guia").val(0);
            $("#serial, #guia, #dir_salida, #dir_llegada, #item, #cantidad, #peso").prop('required', false);
        }
    });

    // buscar y cargar la venta
    $("#btn_buscar_venta").click(function(e){

        if ($("#venta").val() == null) {
            mensajes("Alerta!", "El campo de seleccion esta vacio, seleccione un codigo", "fa-remove", "red");
        }else{
            $("#icon-buscar-venta").show();
            $("#btn_buscar_venta").attr("disabled", "disabled");

            $.get('../cargarTablaVenta/'+$("#venta").val()+'', function(data) {

                $('.data-table').DataTable().destroy();

                $("#data_modelos_venta").empty().append(data.data);
                $("#user_id").val(data.user.name+' '+data.user.ape);
                $("#user").val(data.user.id);
                $("#cliente_id").val(data.cliente.nombre_full);
                $("#cliente").val(data.cliente.id);
                $("#direccion_id").val(data.dir);
                $("#direccion").val(data.direccion);
                $("#venta_id").val($("#venta").val());
                $("#total_facturar").val(0);
                
                $('.data-table').DataTable({responsive: true});
                
                $("#icon-buscar-venta").hide();
                $("#btn_buscar_venta").removeAttr('disabled');
            }); 
        }
    });

    // busqueda de marcas en la coleccion
    $('#select_coleccion').change(function(event) {
        $("#select_marca").empty();
        $.get("../marcasAll/"+event.target.value+"",function(response, dep){
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

    // escuchar el evento cuando cambie la monturas
    $('#section_venta').on("change", ".venta_montura_modelo", function(e) {
        montura         = parseInt($(this).parents("tr").find('.venta_montura_modelo').val());
        precio_montura  = parseFloat($(this).parents("tr").find('.venta_precio_montura').val());
        precio_total    = parseFloat($(this).parents("tr").find('.venta_preciototal').val());

        if (!Number(montura)) {
            totalFacturar = parseFloat($("#total_facturar").val()) + precio_total;
            $(this).parents("tr").find('.venta_preciototal').val(0);
        }else{
            totalFacturar = parseFloat($("#total_facturar").val()) + (precio_total - (montura * precio_montura));
            parseFloat($(this).parents("tr").find('.venta_preciototal').val(montura * precio_montura));
        }

        if (!Number(totalFacturar) || !totalFacturar > 0) {
            mensajes("Alerta!", "El total a facturar es incorrecto, verifique", "fa-remove", "red");
            btnGuardarTodo.prop("disabled", true);
        }else{
            btnGuardarTodo.removeAttr("disabled");
        }

        $("#total_facturar").val(totalFacturar).animate({opacity: "0.2"}, 400).animate({opacity: "1"}, 800);
    });

    // evitar el siguiente si se cambia cualquier valor en la carga de modelos
    $('#section_coleccion_marca').on("change", "#select_marca, #select_coleccion", function(e) {
        btnGuardarTodo.attr("disabled", "disabled");
        $("#data_modelos_venta_directa").empty();
        reiniciarMontoTotal();
    });

    //--------------------------------------------------------funciones ---------------------------------------------------------------------

    // cargar modelos en la tabla para calcular
    function cargarModelos(){
        $("#btn_cargar_modelos").attr('disabled', 'disabled');
        $("#icon-cargar-modelos").show();
        if ($("#select_coleccion").val() && $("#select_marca").val()) {
            $.get("../cargarTabla/"+$("#select_coleccion").val()+"/"+$("#select_marca").val()+"",function(response, dep){

                $('.data-table').DataTable().destroy();
                $("#data_modelos_venta_directa").empty().html(response);
                $('.data-table').DataTable({responsive: true});

                $("#btn_cargar_modelos").removeAttr("disabled");
                $("#icon-cargar-modelos").hide();
            });
        }else{
            mensajes("Alerta!", "Nada para mostrar, debe llenar todos los campos", "fa-warning", "red");
            $("#btn_cargar_modelos").removeAttr("disabled");
            $("#icon-cargar-modelos").hide();
        }
    }

    // Calcular monto y total
    function calcularMontoTotal(){
        total = 0; error = false;
        $.each($("#data_modelos_venta_directa > tr"), function(index, val) {
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
            $("#btn_guardar_all").prop("disabled", true);
            return false;
        }else{
            if (Number(total) || total > 0) {
                $("#btn_guardar_all").removeAttr("disabled");
            }else{
                mensajes("Alerta!", "El total es incorrecto, verifique", "fa-remove", "red");
                $("#btn_guardar_all").prop("disabled", true);
            }
        }

        $(".total_venta, .subtotal").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);
    }

    // guardar direccion
    $("#form_save_devolucion").on('submit', function(e) {
        
        if ($('#total_facturar').val() <= 0) {
            mensajes("Alerta!", "El total a facturar debe ser mayor a 0, verifique", "fa-warning", "red");
            return false;
        }

        e.preventDefault();
        btnGuardarTodo.attr("disabled", 'disabled');
        $("#icon-guardar-all").removeClass("fa-save").addClass('fa-spinner fa-pulse');
        var form = $(this);

        $.ajax({
            url: "{{ route('devoluciones.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
            if (data == 1) {
                mensajes('Listo!', 'Venta procesada, espere mientras es redireccionado...', 'fa-check', 'green');
                setTimeout(window.location = "../facturas", 2000);
            }else if(data == 2){
                mensajes('Alerta!', 'Serial de la guia repetido, verifique', 'fa-warning', 'red');
            }
        })
        .fail(function(data) {
            btnGuardarTodo.removeAttr("disabled");
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>
@endsection