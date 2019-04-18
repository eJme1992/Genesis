@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas </li>
	</ol>
@endsection
@section('content')

<div class="row">
  	<div class="col-lg-12">
    	<div class="box box-danger box-solid">
    		<div class="box-body" id="box-body">
                <div class="col-lg-12">
                    <button class="btn btn-app bg-navy" data-toggle="tooltip" title="Nueva venta" id="btn_nueva_consignacion">
                        <i class="fa fa-file"></i> Consignacion
                    </button>
                    <a class="btn btn-app bg-aqua" href="#" data-toggle="tooltip" title="Nueva venta" id="btn_nueva_venta">
                        <i class="fa fa-file-text"></i> Venta directa
                    </a>
                    <hr>
                </div>

                <section id="section_select_consig" style="display: none;">
                    <div class="col-lg-2">
                        <label for="id_consignacion">Codigo consignacion</label>
                        <select name="id" class="form-control select2" id="id_consignacion">
                            @foreach($consignaciones as $c)
                            <option value="{{ $c->id }}">{{ $c->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label for="">-</label><br>
                        <button type="button" class="btn btn-primary btn-flat" id="btn_buscar_consignacion"> 
                            <i class="fa fa-spinner fa-pulse" style="display: none;" id="icon-buscar-consig"></i> Buscar
                        </button>     
                    </div> 
                </section>
	       
           </div>
        </div>
    </div>
</div>    

@endsection
@section("script")
<script>
  
    $("#btn_nueva_consignacion").click(function(e){
        $(this).attr("disabled", "disabled");
        $("#section_select_consig").animate({height: "toggle"}, 400);
    });

    $("#btn_buscar_consignacion").click(function(e){
        valor = $("#id_consignacion").val();
        $("#icon-buscar-consig").show();
        if (valor == null) {
            mensajes("Alerta!", "El campo de seleccion esta vacio, seleccione un codigo", "fa-remove", "red");
        }else{
            $.get('detalleConsig/'+valor+'', function(data) {
                alert(data.cliente.nombre_full);
            }); 
        }
        $("#icon-buscar-consig").hide();
    });

</script>
@endsection