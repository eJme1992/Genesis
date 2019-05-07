@extends('layouts.app')
@section('title','Notas de Credito - '.config('app.name'))
@section('header','Notas de Credito')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Notas de Credito </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Notas de Credito</span>
              <span class="info-box-number">{{ count($notacreditos) }}</span>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Notas de Credito</h3>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th>Nº Serie</th>
                                <th>Nº Nota</th>
                                <th>Subtotal</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Factura</th>
                                <th class="bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach($notacreditos as $d)
                                <tr>
                                    <td>{{ $d->n_serie }}</td>
                                    <td>{{ $d->n_nota }}</td>
                                    <td>{{ $d->subtotal }}</td>
                                    <td>{{ $d->impuesto }}</td>
                                    <td>{{ $d->total }}</td>
                                    <td>{{ $d->createF() }}</td>
                                    <td class="text-nowrap">
                                        <span data-toggle="modal" data-target="#show_factura_{{ $d->id }}">
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Detales de la factura">
                                                <i class="fa fa-eye"></i> detalles
                                            </button>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('notacredito.show', $d->id) }}" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Detalles de la devolucion">
                                            <i class="fa fa-eye"></i> Detalles
                                        </a>
                                    </td>
                                </tr>
                                @include("notacredito.modals.show_factura")
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection