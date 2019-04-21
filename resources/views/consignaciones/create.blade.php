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
                        @include("consignaciones.partials.formGuia")
                    </section> 

                    <div class="col-lg-12">
                        <h4 class="padding_1em bg-navy"> <i class="fa fa-list-alt"></i> Datos de los modelos</h4>
                    </div>

                    @include("consignaciones.partials.formModelo")

                    <div class="form-group text-right col-lg-12">
                        <hr><br><br>
                        <span class="bg-info pull-left padding_1em">
                            <i class="fa fa-info-circle"></i> Seleccione solo las monturas de los modelos que desea consignar
                        </span>
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
@include('clientes.modals.createclientes')        
@endsection

@section("script")
<script>
    contar_modelos = 1;
    $("#checkbox_guia").prop('checked', false);

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

    // busqueda de marcas en la coleccion
    $('#coleccion').change(function(event) {
        $.get("../marcasAll/"+event.target.value+"",function(response, dep){
            $("#marcas").empty();
            if (response.length > 0) {
                for (i = 0; i<response.length; i++) {
                    $("#marcas").append(
                        "<option value='"+response[i].marca.id+"'>"
                        +response[i].marca.material.name+' | '+response[i].marca.name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
            }
            $("#data_modelos").empty();
        });
    });

    // cargar modelos en la vista
    $("#btn_cargar_modelos").click(function(e) {
        e.preventDefault();
        var nombre_modelo, montura_modelo, precio_montura_modelo = "";
        $("#btn_cargar_modelos").attr('disabled', 'disabled');
        if ($("#coleccion").val() && $("#marcas").val()) {
            $.get("../modelosAll/"+$("#coleccion").val()+"/"+$("#marcas").val()+"",function(response, dep){
                    $('.data-table').DataTable().destroy();
                    $("#data_modelos").empty().html(response.data);
                    $("#name_modelos").empty().html(response.model);
                    $("#precio_modelos").empty().html(response.precio);
                    $('.data-table').DataTable();
            });
        }else{
            mensajes("Alerta!", "Nada para mostrar, debe llenar todos los campos", "fa-warning", "red");
        }
        $("#btn_cargar_modelos").removeAttr("disabled");
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
                //window.location = $("#ruta_consig").val();
                setTimeout("location.reload(true);", 2000);
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