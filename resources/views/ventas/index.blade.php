@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Ventas </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total ventas</span>
              <span class="info-box-number">{{ count($ventas) }}</span>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list-alt"></i> Ventas</h3>
                    <span class="pull-right">
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th class="text-center">Vendedor (Usuario)</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Direccion</th>
                                <th class="text-center">Modelos</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center bg-navy">Estado</th>
                                {{-- <th class="text-center bg-navy">Acciones</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($ventas as $d)
                                <tr>
                                    <td class="text-capitalize"><strong>{{ $d->user->name }} {{ $d->user->ape }}</strong></td>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ $d->direccion->full_dir() }}</td>
                                    <td>{{ $d->movimientoVenta->count() }}</td>
                                    <td>{{ 'S/ '.$d->total }}</td>
                                    <td>{{ $d->fecha }}</td>
                                    <td>{{ $d->adicionalVenta->factura_id ? 'Factura entregada' : 'No entregada' }}</td>
                                    {{-- <td>
                                        <span class="">
                                            <form action="{{ route('asignaciones.destroy', $d->id) }}" method="POST">
                                                {{ method_field( 'DELETE' ) }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-sm btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la asignacion con todas sus dependencias S/N?');"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection