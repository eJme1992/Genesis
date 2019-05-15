@extends('layouts.app')
@section('title','Kardex - '.config('app.name'))
@section('header','Kardex')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Kardex </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')

    <div class="row">
        <div class="col-lg-3 col-sm-3 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-text text-capitalize">{{ $des }}</span>
              <span class="info-box-number">{{ count($modelos) }}</span>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        @include('kardex.partials.form_busqueda')
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Modelos en {{ $des }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Monturas</th>
                                <th class="text-center">Estuches</th>
                                <th class="text-center">Precio <b>[PA - PVE]</b></th>
                                <th class="text-center">Marca (material)- Coleccion</th>
                                <th class="text-center">Cajas</th>
                                <th class="text-center">Fecha Reg.</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($modelos as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->montura }}</td>
                                    <td>{{ $d->estuche()  }}</td>
                                    <td>
                                        [{{ $d->precioA($d->coleccion_id, $d->marca_id) == null ? 'no posee' : $d->precioA($d->coleccion_id, $d->marca_id) }} - 
                                        {{ $d->precioVE($d->coleccion_id, $d->marca_id) == null ? 'no posee' : $d->precioVE($d->coleccion_id, $d->marca_id) }}]
                                    </td>
                                    <td>
                                        {{ $d->marca->name.' ('.$d->marca->material->name.') - '.$d->coleccion->name  }}
                                    </td>
                                    <td>{{ $d->cajas($d->coleccion_id, $d->marca_id) }}</td>
                                    <td>{{ $d->createF() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
     // busqueda de marcas
    $('#coleccion').change(function(event) {
        $("#marca, #modelo").empty();
        $.get("marcasAll/"+event.target.value+"",function(response, dep){
            if (response.length > 0) {
                $("#marca").append("<option value=''>Seleccione...</option>");
                for (i = 0; i<response.length; i++) {
                    $("#marca").append(
                        "<option value='"+response[i].marca.id+"'>"
                        +response[i].marca.material.name+' | '+response[i].marca.name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
            }
        });
    });

    // busqueda de modelos
    $('#marca').change(function(event) {
        $.get("modelosActivos/"+$("#coleccion").val()+"/"+$("#marca").val()+"",function(response){
            if (response.length > 0) {
                $("#modelo").append("<option value=''>Seleccione...</option>");
                for (i = 0; i<response.length; i++) {
                    $("#modelo").append(
                        "<option value='"+response[i].id+"'>["
                        +response[i].id+'] | '+response[i].name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee modelos asociadas", "fa-warning", "red");
            }
        });
    });
</script>
@endsection