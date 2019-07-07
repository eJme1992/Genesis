@extends('layouts.app')
@section('title','Consignacion - '.config('app.name'))
@section('header','Consignacion')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Consignacion </li>
    </ol>
@endsection
@section('content')

@include('clientes.modals.createclientes') 
<!-- Formulario -->
<div class="row">
    <div class="col-lg-12">
        <div class="box box-danger box-solid">
            <div class="box-body">
                <form  id="form_create_consig">
                {{ csrf_field() }}

                    <div class="col-lg-12">
                        <h4 class="padding_1em bg-navy"> <i class="fa fa-list-alt"></i> Datos de la consignacion</h4>
                    </div>

                    @include("consignaciones.partials.formConsignacion")

                    <section id="section_guia" style="display:none;">
                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
                        </div>
                        @include("consignaciones.partials.formGuia")
                    </section> 

                    <div class="col-lg-12">
                        <h4 class="padding_1em bg-navy"> <i class="fa fa-list-alt"></i> Nota de Pedido</h4>
                    </div>

                    @include("notapedido.partials.campos_nota_pedido")
                    
                    <div class="col-lg-12">
                        <h4 class="padding_1em bg-navy"> <i class="fa fa-list-alt"></i> Datos de los Modelos</h4>
                    </div>

                    @include("consignaciones.partials.formModelo")


                    <div class="form-group text-right col-lg-12">
                        <hr><br><br>
                        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
                        <button class="btn bg-navy btn_save_consig" type="submit" onclick="return confirm('Desea consignar estos datos? ');">
                            <i class="fa fa-save"></i> Consignar
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

    var contar_det_guia = 2;

    $("#checkbox_guia").prop('checked', false);
    $(".btn_save_consig").prop("disabled", true);

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

    // Calcular monto y total
    function calcularMontoTotal(){
        total = 0; error = false;
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
            $(".btn_save_consig").prop("disabled", true);
            return false;
        }else{
            if (Number(total) || total > 0) {
                $(".btn_save_consig").removeAttr("disabled");
            }else{
                mensajes("Alerta!", "El total es incorrecto, verifique", "fa-remove", "red");
                $(".btn_save_consig").prop("disabled", true);
            }
        }

        $(".total_consig").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);
    }

    // añadir mas detalles a la guia
    $("#btn_añadir_detalle_guia").click(function(e){
        e.preventDefault();
        
        contar = contar_det_guia++;
        
        $("#section_replicar_detalle_guia").append("<section id='section_detalle_guia_"+contar+"'></section>");
        $("#section_detalle_guia_"+contar+"").html($("#section_detalle_guia_1").html());

        $("#section_detalle_guia_"+contar+"").append(
            "<div class='form-group col-lg-1'>"+
                "<label>---</label><br>"+
                "<button class='btn btn-danger' type='button' id='btn_delete_det_guia"+contar+"'>"+
                    "<i class='fa fa-remove'></i>"+
                "</button>"+
            "</div>");

        $('#btn_delete_det_guia'+contar+'').click(function(e){
          e.preventDefault();
          $('#section_detalle_guia_'+contar+'').remove();
          contar--;
        });
    });

    // busqueda de marcas en la coleccion
    $('#coleccion').change(function(event) {
        $(".btn_save_consig").prop("disabled", true);
        $("#data_modelos, #marcas, #name_modelos").empty();
        $.get("../marcasAll/"+event.target.value+"",function(response, dep){
            if (response.length > 0) {
                for (i = 0; i<response.length; i++) {
                    $("#marcas").append(
                        "<option value='"+response[i].marca.id+"'>"
                        +response[i].marca.name+' | '+response[i].marca.material.name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
            }
        });
    });

    // cargar modelos en la vista
    $("#btn_cargar_modelos").click(function(e) {
        e.preventDefault();
        var nombre_modelo, montura_modelo, precio_montura_modelo = "";
        $("#btn_cargar_modelos").attr('disabled', 'disabled');
        $(".total_consig").val("");
        $(".btn_save_consig").prop("disabled", true);
        if ($("#coleccion").val() && $("#marcas").val()) {
            $.get("../modelosAll/"+$("#coleccion").val()+"/"+$("#marcas").val()+"",function(response, dep){
                    $('.data-table').DataTable().destroy();
                    $("#data_modelos").empty().html(response.data);
                    $("#name_modelos").empty().html(response.model);
                    $('.data-table').DataTable();
            });
        }else{
            mensajes("Alerta!", "Nada para mostrar, debe llenar todos los campos", "fa-warning", "red");
        }
        $("#btn_cargar_modelos").removeAttr("disabled");
    });

    // copiar y pegar modelo en buscador de la tabla y aplicar la busqueda
    $(".div_tablas_modelos").on("click", ".btn_nm", function(e) {
        e.preventDefault();
        $("input[type='search']").empty().val($(this).val());
        $('.data-table').DataTable().search($(this).val()).draw();    
    });

    // guardar direccion
    $("#form_create_consig").on('submit', function(e) {
        e.preventDefault();
        btn = $(".btn_save_consig");
        btn.attr("disabled", 'disabled');
        var form = $(this);

        $.ajax({
            url: "{{ route('consignacion.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            if (data == 1) {
                mensajes('Alerta!', 'Serial de guia repetido, verifique', 'fa-warning', 'red');
                btn.removeAttr("disabled");
                return false;
            }else{
                mensajes('Listo!', 'Consignacion generada con exito, espere mientras es redireccionado...', 'fa-check', 'green');  
                form[0].reset();
                setTimeout(window.location = "../consignacion", 2000);
            }
        })
        .fail(function(data) {
            btn.removeAttr("disabled");
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });
    
</script>
@endsection