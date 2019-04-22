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
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Direccion</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center bg-navy" width="100px">Estado Fact.</th>
                                <th class="text-center bg-navy">Estado Estu.</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($ventas as $d)
                                <tr>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ $d->direccion->full_dir() }}</td>
                                    <td>{{ 'S/ '.$d->total }}</td>
                                    <td>{{ $d->fecha }}</td>
                                    <td class="{{ $d->adicionalVenta->factura_id ? 'success' : 'warning' }}">
                                        @if($d->adicionalVenta->factura_id)
                                            <span class="">Factura entregada</span>
                                        @else
                                            <span class="col-lg-6">No entregada</span>
                                            <span class="col-lg-6">
                                                <button type="button" class="btn btn-default btn-xs bg-green">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $d->estatusEstuche() }}</td>
                                    <td>
                                        <a href="{{ route('ventas.show', $d->id) }}" class="btn bg-navy btn-xs">
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