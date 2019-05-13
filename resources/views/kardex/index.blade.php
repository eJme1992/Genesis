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
        <div class="col-lg-12 well">
            <form action="{{ route('kardex.busqueda') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group col-lg-4">
                    <label>Colecciones - Proveedor</label>
                    <select name="coleccion" class="form-control select2" required="" id="coleccion">
                        <option value=""></option>
                        @foreach($colecciones as $c)
                        <option value="{{ $c->id }}">{{ $c->name.' - '.$c->proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-lg-4">
                    <label>Marca</label>
                    <select name="marca" class="form-control" id="marca">
                    </select>
                </div>

                <div class="form-group col-lg-4">
                    <label>Modelo</label>
                    <select name="modelo" class="form-control" id="modelo">
                    </select>
                </div>

                <div class="form-group col-lg-4">
                    <label>Desde</label>
                    <input type="text" name="desde" class="form-control" id="from">
                </div>

                <div class="form-group col-lg-4">
                    <label>Hasta</label>
                    <input type="text" name="hasta" class="form-control" id="to">
                </div>

                <div class="form-group col-lg-4 text-right">
                    <label>-</label><br>
                    <button type="submit" id="btn_buscar" class="btn btn-primary btn-lg btn-flat">Buscar</button>
                </div>
            
            </form>
            <br>
        </div>
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Kardex</h3>
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
                        <thead class="label-success">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Monturas</th>
                                <th class="text-center">Estuches</th>
                                <th class="text-center">Marca (material)- Coleccion</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($modelos as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->montura }}</td>
                                    <td>{{ $d->estuche }}</td>
                                    <td>
                                        {{ $d->marca->name.' ('.$d->marca->material->name.') - '.$d->coleccion->name  }}
                                    </td>
                                    <td>{{ $d->status->name }}</td>
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