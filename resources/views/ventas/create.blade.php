@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Nueva Venta')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas / Crear </li>
	</ol>
@endsection
@section('content')

<div class="row">

    {{-- panel left - botonera --}}
  	<div class="col-lg-3">
    	<div class="box box-danger box-solid">
    		<div class="box-body">
                <div class="col-lg-12">
                    @include("ventas.partials.panel_left")
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="box box-danger box-solid">
            <div class="box-body">
                <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> <span id="span_header_2">Datos</span></h4>
                <form id="form_venta_factura">
                {{ csrf_field() }}

                    {{-- NOTA DE PEDIDO --}}
                    <section id="section_nota_pedido" style="display: none;">
                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Nota de Pedido</h4>
                            @include("ventas.partials.sections.section_nota_pedido")
                        </div>
                    </section>

                    {{-- SELECT DE CONSIGNACION --}}
                    <section id="section_select_consig" style="display: none;">
                        @include("ventas.partials.sections.section_buscar_consig")
                    </section>

                    {{-- GUIA DE REMISION --}}
                    <section id="section_guia" style="display: none;">
                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
                            @include("ventas.partials.sections.section_guia")
                        </div>
                    </section>

                    {{-- DETALLES DE LA CONSIGNACION - MODELOS --}}
                    <section id="section_detalle_consig" style="display: none;">
                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Detalles - Modelos</h4>
                            @include("ventas.partials.sections.section_consig")
                            <hr>

                            <button type="button" class="btn btn-flat btn-success" id="btn_procesar_venta" onclick="return confirm('Seguro desea procesar la venta?');" data-toggle="tooltip" title="Guardar los cambios y completar la venta">
                                <i class="fa fa-arrow-right" id="icon-procesar-venta"></i> Siguiente
                            </button>
                            <br><br>
                        </div>
                    </section>
                    
                    {{-- SECCION FACTURA --}}
                    <section style="display: none;" id="section_factura">
                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Factura</h4>
                            @include("ventas.partials.sections.section_factura")
                        </div>
                    </section>

                    <div class="form-group col-lg-12" id="btn_guardar_nota_pedido" style="display: none;">
                        <hr>
                        <button type="submit" class="btn btn-success btn-lg btn-flat" id="btn_guardar_all">
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

    reiniciarMontoTotal();
    
    var total = 0; var error_cal = false;
    
    // venta de consignacion
    $("#btn_nueva_consignacion").click(function(e){
        $(this).attr("disabled", "disabled");
        $("#section_select_consig").animate({height: "toggle"}, 400);
    });

    // Calcular monto y total
    $("#btn_calcular_total_venta").click(function(e){
        total = 0; error = error_cal;
        $.each($("#data_modelos > tr"), function(index, val) {
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
            $("#btn_procesar_venta").attr("disabled", "disabled");
            return false;
        }else{
            $("#btn_procesar_venta").removeAttr("disabled");
        }

        $("#total_venta, #subtotal").val(total).animate({opacity: "0.4"}, 400).animate({opacity: "1"}, 400);
    });

    // buscar y cargar consignacion
    $("#btn_buscar_consignacion").click(function(e){
        reiniciarMontoTotal();
        $("#btn_procesar_venta").attr("disabled", "disabled");
        valor = $("#id_consignacion").val();

        if (valor == null) {
            mensajes("Alerta!", "El campo de seleccion esta vacio, seleccione un codigo", "fa-remove", "red");
        }else{
            $("#icon-buscar-consig").show();
            $("#btn_buscar_consignacion").attr("disabled", "disabled");
            $.get('../detalleConsig/'+valor+'', function(data) {
                $("#section_detalle_consig").fadeIn(400);

                $('.data-table').DataTable().destroy();
                cargarDataConsignacionYModelos(data);
                $('.data-table').DataTable({responsive: true});

                if (data.consig.guia == null) {
                    $("#section_guia").fadeOut(400);
                    $("#guia").empty().append("<i class='fa fa-remove text-danger'></i> Guia de remision");
                }else{
                    $("#section_guia").fadeIn(400);
                    $("#guia").empty().append("<i class='fa fa-check text-success'></i> Guia de remision");
                    cargarGuia(data);
                }
                
                $("#icon-buscar-consig").hide();
                $("#btn_buscar_consignacion").removeAttr('disabled');
            }); 
        }
    });

    // procesar venta por consignacion y pasar a la factura
    $("#btn_procesar_venta").click(function(e){
        $("#cliente_form").val($("#cliente").text());
        $("#btn_procesar_venta, #btn_nueva_venta, #btn_nueva_consignacion").attr("disabled", "disabled");
        $(".montura_modelo, .costo_modelo").attr("readonly", "readonly");
        $("#section_select_consig, #section_guia, #section_detalle_consig").fadeOut(400);
        $("#section_nota_pedido, #section_factura, #btn_guardar_nota_pedido").fadeIn(400);
    });

    // reiniciar el campo total venta
    function reiniciarMontoTotal(){
        $("#total_venta, #subtotal").val('');
    }

    // calcular impuesto
    function calcularImpuesto(porcentaje){
        subtotal = $("#subtotal").val();
        calculo =  (parseFloat(subtotal) * parseFloat(porcentaje.value)) / 100;
        $("#total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
    }

    //-----------------------------------------guardar nota de peido y factura -----------------------------------------------
    // guardar direccion
    $("#form_venta_factura").on('submit', function(e) {
        e.preventDefault();
        btn = $("#btn_guardar_all");
        btn.attr("disabled", 'disabled');
        $("#icon-guardar-all").removeClass("fa-save").addClass('fa-spinner fa-pulse');
        var form = $(this);

        $.ajax({
            url: "{{ route('ventas.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            btn.removeAttr("disabled");
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
            mensajes('Listo!', 'Nota y Factura creadas, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout("location.reload(true);", 3000);
        })
        .fail(function(data) {
            btn.removeAttr("disabled");
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>
@endsection