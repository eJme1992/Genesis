@extends('layouts.app')
@section('title','Devoluciones - '.config('app.name'))
@section('header','Devoluciones')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Devoluciones </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Devoluciones</span>
              <span class="info-box-number">{{ count($devoluciones) }}</span>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Devoluciones</h3>
                    <span class="pull-right">
                        <a href="{{ route('devoluciones.create') }}" class="btn btn-danger">
                            <i class="fa fa-plus"></i> Nueva devolucion
                        </a>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th>Cod. Venta</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                <th>Modelos Devueltos</th>
                                <th class="bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach($devoluciones as $d)
                                <tr>
                                    <td>{{ $d->venta_id }}</td>
                                    <td>{{ $d->motivo }}</td>
                                    <td>{{ $d->fecha }}</td>
                                    <td>{{ $d->movDevolucion->count() }}</td>
                                    <td>
                                        <a href="{{ route('devoluciones.show', $d->id) }}" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Detalles de la devolucion">
                                            <i class="fa fa-eye"></i> Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
<script>

</script>
@endsection