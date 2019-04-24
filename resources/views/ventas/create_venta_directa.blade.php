@extends('layouts.app')
@section('title','Ventas - Directa '.config('app.name'))
@section('header','Nueva Venta')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Ventas / Venta directa </li>
    </ol>
@endsection
@section('content')

<div class="row">

    {{-- panel left - datos --}}
    <div class="col-lg-12">
        <div class="box box-danger box-solid">
            <div class="box-body">
                <h4 class="padding_1em bg-navy container-fluid">
                    <i class="fa fa-arrow-right"></i> Datos para la venta directa
                </h4>
                @include("ventas.partials.forms.form_venta_directa")
            </div>
        </div>
    </div>
           
</div>
@include('direcciones.modals.modal_create')    
@include('clientes.modals.createclientes') 
@endsection

@section("script")
<script>

    reiniciarMontoTotal();
    
    var total = 0; var error_cal = false;
    $("#checkbox_factura, #checkbox_guia, #checkbox_pago").prop('checked', false);
    $("#btn_guardar_all").attr('disabled', 'disabled');
    $("#select_coleccion").val('').prop('selected', true);

    $("#checkbox_pago").click(function(e) {
        var bool = this.checked;
        if(bool === true){
            $("#section_pago").animate({height: "toggle"}, 400);
            $("#checkbox_pago").val(1);
            $("#tipo_abono_id, #abono, #restante").prop('required', true);
        }else{
            $("#section_pago").animate({height: "toggle"}, 400);
            $("#checkbox_pago").val(0);
            $("#tipo_abono_id, #abono, #restante").prop('required', false);
        }
    });

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

    // escuchando el evento tipo de abono para letras
    $('#tipo_abono_id').change(function(event) {
        if ($('#tipo_abono_id').val() == 1) {
            $('#section_letra').show();
        }else{
            $('#section_letra').hide();
        }
    });


    // evitar el siguiente si se cambia cualquier valor en los modelos - consignacion
    $('#section_mostrar_datos_cargados').on("change", ".montura_modelo, .costo_modelo", function(e) {
        $("#btn_guardar_all").attr("disabled", "disabled");
    });

    // evitar el siguiente si se cambia cualquier valor en los modelos - venta directa
    $('#section_cargar_modelos').on("change", "#select_marca, #select_coleccion", function(e) {
        $("#btn_guardar_all").attr("disabled", "disabled");
        $("#data_modelos_venta_directa").empty();
        $("#span_select_estuche, #span_info_estuche").hide(400);
        $("#status_estuche").removeAttr('required').prop('name', '');
        reiniciarMontoTotal();
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

    //-----------------------------------------guardar nota de peido y factura -----------------------------------------------
    // guardar direccion
    $("#form_venta_directa").on('submit', function(e) {
        e.preventDefault();
        btn = $("#btn_guardar_all"); btn.attr("disabled", 'disabled');
        $("#icon-guardar-all").removeClass("fa-save").addClass('fa-spinner fa-pulse');
        var form = $(this);

        $.ajax({
            url: "{{ route('ventas.storeVentaDirecta') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
            if (data == 1) {
                mensajes('Listo!', 'Venta procesada, espere mientras es redireccionado...', 'fa-check', 'green');
                setTimeout(window.location = "ventas", 2000);
            }else if(data == 2){
                mensajes('Alerta!', "Este serial ya ha sido tomado, verifique", 'fa-warning', 'red');
            }else if (data == 0){
                mensajes('Alerta!', "Ocurrio un error en el servidor, recargue la pgina e intente de nuevo", 'fa-warning', 'red');
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