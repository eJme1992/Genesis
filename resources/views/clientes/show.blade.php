@extends('layouts.app')
@section('title','Cliente / Detalles - '.config('app.name'))
@section('header','Cliente')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Cliente / Detalles </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary box-solid">
                <div class="box-body">
                    <h3 class="bg-navy padding_05em">
                        <i class="fa fa-arrow-right"></i> Codigo [{{ $cliente->id }}] - {{ $cliente->nombre_full }} 
                    </h3>

                    <div class="list-group col-lg-3">
                        <b>Tipo de identificacion</b>
                        <p class="list-group-item">{{ $cliente->tipo_id }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>Identificacion</b>
                        <p class="list-group-item">{{ $cliente->identificacion }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>RUC</b>
                        <p class="list-group-item">{{ $cliente->ruc }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>Correo</b>
                        <p class="list-group-item">{{ $cliente->correo }}</p>
                    </div>

                    <div class="list-group col-lg-6">
                        <b>Direccion</b>
                        <p class="list-group-item">{{ $cliente->dir() }}</p>
                    </div>

                    <div class="list-group col-lg-2">
                        <b>Telefono 1</b>
                        <p class="list-group-item"><span>01</span> {{ $cliente->telefono_1 }}</p>
                    </div>
                    
                    <div class="list-group col-lg-2">
                        <b>Telefono 2</b>
                        <p class="list-group-item"><span>+51</span> {{ $cliente->telefono_2 }}</p>
                    </div>

                    <div class="list-group col-lg-2">
                        <b>Fecha registro</b>
                        <p class="list-group-item list-group-item-info">{{ $cliente->createF() }}</p>
                    </div>                    

                    @if(count($cliente->ventas) > 0)
                        <h3 class="bg-navy padding_05em col-lg-12">
                            <i class="fa fa-arrow-right"></i>  Ventas
                        </h3>

                        <table class="table table-bordered table-hover table-striped data-table">
                            <thead class="bg-navy disabled">
                                <tr>
                                    <th>Codigo Venta</th>
                                    <th>Fecha</th>
                                    <th>Vendedor</th>
                                    <th>Total</th>
                                    <th>Estuches</th>
                                    <th>Deuda - Fecha cancelacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->ventas as $v)
                                <tr>
                                    <td>[{{ $v->id }}]</td>
                                    <td>{{ $v->fecha }}</td>
                                    <td>{{ $v->user->fullName() }}</td>
                                    <td class="text-nowrap">
                                        <b>S/ </b>{{ $v->total }}
                                        {{-- modelos --}}
                                        <span data-toggle="modal" data-target="#show_modelos_{{ $v->id }}" class="pull-right">
                                            <button type="button" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Ver modelos">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </td>
                                    <td>{{ $v->estatusEstuche() }}</td>
                                    <td class="text-primary"><b>S/ </b> {{ $v->totaldeuda() }} - {{ $v->fechaCancelacion() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach($cliente->ventas as $v)
                            @include("clientes.modals.show_modelos")
                        @endforeach
                    @endif

                </div>
            </div>
            <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        </div>
    </div>
@endsection