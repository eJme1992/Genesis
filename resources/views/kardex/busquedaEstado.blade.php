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
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-body">
                    @include('kardex.partials.form_busqueda_estado')
                </div>
            </div>
        </div>
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
                                <th class="text-center">Marca (material)- Coleccion</th>
                                <th class="text-center">Fecha Reg.</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($modelos as $d)
                                <tr>
                                    <td>{{ $d->modelo_id }}</td>
                                    <td>{{ $d->modelo->name }}</td>
                                    <td>{{ !$d->montura ? $d->monturas : $d->montura}}</td>
                                    <td>{{ !$d->estuches ? $d->estuche : $d->estuches  }}</td>
                                    <td>
                                        {{ $d->modelo->marca->name.' ('.$d->modelo->marca->material->name.') - '.$d->modelo->coleccion->name  }}
                                    </td>
                                    <td>{{ $d->createF() }}</td>
                                    <td>
                                        @if($des == "asignacion")

                                        @elseif($des == "consignacion")
                                            <span data-toggle="tooltip" title="detalles de la {{ $des }}">
                                                <button type="button" data-toggle="modal" data-target="#detalle_consig" class="btn btn-xs bg-navy bc" data-id="{{ $d->consignacion_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </span>
                                        @elseif($des == "venta")

                                        @elseif($des == "devolucion")

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include("consignaciones.modals.detalle_consig")
@endsection
@section('script')
<script>

    $(".bc").click(function(e){
        $.get('detalleConsig/'+$(this).data("id"), function(data) {
            alert(data);
        });
    });

</script>
@endsection