@extends('layouts.app')
@section('title','Ventas - Consignacion '.config('app.name'))
@section('header','Nueva Venta')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Ventas / Venta de consignacion </li>
    </ol>
@endsection
@section('content')

<div class="row">

    {{-- panel - datos --}}
    <div class="col-lg-12">
        <div class="box box-danger box-solid">
            <div class="box-body">
                <h4 class="padding_1em bg-navy container-fluid">
                    <i class="fa fa-arrow-right"></i> Datos asociados a la consignacion
                </h4>
                @include("ventas.partials.forms.form_consig")
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
    $("#checkbox_factura").prop('checked', false);

    $("#checkbox_factura").click(function(e) {
        var bool = this.checked;
        if(bool === true){
            $("#section_factura").animate({height: "toggle"}, 400);
            $("#checkbox_factura").val(1);
            $("#num_factura, #item, #status_av, #subtotal, #impuesto, #total_neto").prop('required', true);
        }else{
            $("#section_factura").animate({height: "toggle"}, 400);
            $("#checkbox_factura").val(0);
            $("#num_factura, #item, #status_av, #subtotal, #impuesto, #total_neto").prop('required', false);
        }
    });

    // buscar y cargar consignacion
    $("#btn_buscar_consignacion").click(function(e){
        reiniciarMontoTotal();
        $(".btn_siguiente").attr("disabled", "disabled");
        valor = $("#id_consignacion").val();

        if (valor == null) {
            mensajes("Alerta!", "El campo de seleccion esta vacio, seleccione un codigo", "fa-remove", "red");
        }else{
            $("#icon-buscar-consig").show();
            $("#btn_buscar_consignacion").attr("disabled", "disabled");
            $.get('detalleConsig/'+valor+'', function(data) {
                $("#section_detalle_consig").fadeIn(400);

                $('.data-table').DataTable().destroy();
                cargarDataConsignacionYModelos(data);
                $('.data-table').DataTable({responsive: true});

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

                if (data.consig.guia == null) {
                    $("#section_guia").hide(400);
                    $("#guia, #span_guia").empty().append("<i class='fa fa-remove text-danger'></i> Guia de remision N/A");
                }else{
                    $("#section_guia").show(400);
                    $("#guia, #span_guia").empty().append("<i class='fa fa-check text-success'></i> Guia de remision");
                    cargarGuia(data);
                }
                
                $("#icon-buscar-consig").hide();
                $("#btn_buscar_consignacion").removeAttr('disabled');
            }); 
        }
    });

    // evitar el siguiente si se cambia cualquier valor en los modelos - consignacion
    $('#section_detalle_consig').on("change", ".montura_modelo, .costo_modelo", function(e) {
        $(".btn_siguiente").attr("disabled", "disabled");
    });

    // procesar venta por consignacion y pasar a la factura
    $(".btn_siguiente").click(function(e){
        $("#cliente_form").val($("#cliente").text());
        $(".montura_modelo, .costo_modelo").attr("readonly", "readonly");
        $("#section_select_consig, #section_guia, #section_detalle_consig").hide(400);
        $("#section_nota_pedido, #btn_guardar_nota_pedido").show(400);
    });

    // ir a atras
    $("#btn_volver").click(function(e){
        $(".montura_modelo, .costo_modelo").removeAttr("readonly", "readonly");
        $("#section_select_consig, #section_detalle_consig").show(400);
        $("#section_nota_pedido, #btn_guardar_nota_pedido, #section_factura").hide(400);
        $("#checkbox_factura").prop('checked', false);
        $("#total_neto").val('');
    });


    //-------------------------------------------- funciones ---------------------------------------------------------
    
    // reiniciar el campo total venta
    function reiniciarMontoTotal(){
        $(".total_venta, .subtotal").val('');
    }

    // calcular impuesto
    function calcularImpuesto(porcentaje){
        subtotal = $("#subtotal").val();
        calculo =  (parseFloat(subtotal) * parseFloat(porcentaje.value)) / 100;
        $("#total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
    }

    // Calcular monto y total
    function calcularMontoTotal(){
        total = 0; error = error_cal;
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
            $(".btn_siguiente").attr("disabled", "disabled");
            return false;
        }else{
            $(".btn_siguiente").removeAttr("disabled");
        }

        $(".total_venta, .subtotal").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);
    }

    //-----------------------------------------guardar nota de peido y factura -----------------------------------------------
    // guardar direccion
    $("#form_venta_factura").on('submit', function(e) {
        e.preventDefault();
        btn = $("#btn_guardar_all"); btn.attr("disabled", 'disabled');
        $("#icon-guardar-all").removeClass("fa-save").addClass('fa-spinner fa-pulse');
        var form = $(this);

        $.ajax({
            url: "{{ route('ventas.storeVentaConsignacion') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            if (data == 1) {
                $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
                mensajes('Listo!', 'Venta procesada, espere mientras es redireccionado...', 'fa-check', 'green');
                setTimeout("location.reload(true);", 2000);
            }else{
                mensajes('Alerta!', "ocurrio un error en el servidor, recargue la pagina e intente de nuevo", 'fa-warning', 'red');
            }
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