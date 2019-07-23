@extends('layouts.app')
@section('title','Ventas - Asignacion '.config('app.name'))
@section('header','Nueva Venta')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Ventas / Venta de productos asignados </li>
    </ol>
@endsection
@section('content')

<div class="row">

    {{-- panel left - datos --}}
    <div class="col-lg-12">
        <div class="box box-danger box-solid">
            <div class="box-body">
                @include("ventas.partials.forms.form_asig")
            </div>
        </div>
    </div>
           
</div>
@include('direcciones.modals.modal_create')    
@include('clientes.modals.createclientes') 
@endsection

@section("script")
<script>
    
    var total = 0; var error_cal = false;
    $("#btn_guardar_all").attr('disabled', 'disabled');
    $(".total_venta").val('');

    // evitar el siguiente si se cambia cualquier valor en los modelos - consignacion
    $('#section_mostrar_datos_cargados').on("change", ".montura_modelo, .costo_modelo, .check_model", function(e) {
        $("#btn_guardar_all").attr("disabled", "disabled");
    });

    // copiar y pegar modelo en buscador de la tabla y aplicar la busqueda
    $(".div_tablas_modelos").on("click", ".btn_nm", function(e) {
        e.preventDefault();
        $("table.data-table.ok input[type='search']").empty().val($(this).val());
        $('table.data-table.ok').DataTable().search($(this).val()).draw();    
    });

    // evitar el siguiente si se cambia cualquier valor en los modelos - venta directa
    $('#section_vendedor').on("change", "#user_id", function(e) {
        $("#btn_guardar_all").attr("disabled", "disabled");
        $("#data_modelos_venta_directa").empty();
        $("#span_select_estuche, #span_info_estuche").hide(400);
        $("#status_estuche").removeAttr('required').prop('name', '');
        reiniciarMontoTotal();
    });

    // buscar y cargar modelos dependiendo de los usuarios
    function buscarModelos(){
        $("#btn_cargar_modelos, #btn_guardar_all").attr('disabled', 'disabled');
        $("#icon-cargar-modelos").show();
        
        $.getJSON('cargarAsigModelosToUser/'+$("#user_id").val()+'', function(json, textStatus) {    
            $('.data-table').DataTable().destroy();
            $("#data_modelos_venta_directa").empty().html(json);
            $('.data-table').DataTable({responsive: true});
            $("#btn_cargar_modelos").removeAttr("disabled");
            $("#icon-cargar-modelos").hide();
            validarEstuche();
        });
    }

    // validar los estuches para ser cargados
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
        if (comprobarCheckModelo() === true) {
            $.each($(".table > tbody > tr"), function(index, val) {
                montura = parseInt($(this).find('.montura_modelo').val());
                precio  = parseFloat($(this).find('.costo_modelo').val());
                check   = $(this).find('.hidden_model').val();

                if (check == 1) {
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
                }else{
                    $(this).find('.preciototal').val('');
                }
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

            $(".total_venta").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);
        }
    }

    //-----------------------------------------guardar nota de peido y factura -----------------------------------------------
    // guardar venta por asignacion
    $("#form_venta_directa").on('submit', function(e) {
        e.preventDefault();
        btn = $("#btn_guardar_all"); 
          btn.attr("disabled", 'disabled');
        $("#icon-guardar-all").removeClass("fa-save").addClass('fa-spinner fa-pulse');
        var form = $(this);

        if (comprobarCheckModelo() === true) {
            $.ajax({
                url: "{{ route('ventas.storeVentaAsignacion') }}",
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
        }else{
            btn.removeAttr("disabled");
            $("#icon-guardar-all").removeClass("fa-spinner fa-pulse").addClass('fa-save');
        }        
    });
</script>
@endsection