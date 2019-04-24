@extends('layouts.app')
@section('title','Ventas / Detalles - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Ventas / Detalles </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary box-solid">
                <div class="box-body">
                    <h3 class="bg-navy padding_05em">
                        <i class="fa fa-arrow-right"></i> Venta [{{ $venta->id }}] 
                    </h3>

                    <div class="list-group col-lg-4">
                        <b>Cliente</b>
                        <p class="list-group-item">{{ $venta->cliente->nombre_full }}</p>
                    </div>

                    <div class="list-group col-lg-6">
                        <b>Direccion</b>
                        <p class="list-group-item">{{ $venta->direccion->full_dir() }}</p>
                    </div>

                    <div class="list-group col-lg-2">
                        <b>Fecha inicio de venta</b>
                        <p class="list-group-item">{{ $venta->fecha }}</p>
                    </div>
                    
                    <div class="list-group col-lg-3">
                        <b>Estado de los estuches</b>
                        <p class="list-group-item">
                            {{ $venta->estatusEstuche() }}
                        </p>
                    </div>                    

                    <h3 class="bg-navy padding_05em col-lg-12">
                        <i class="fa fa-arrow-right"></i> Modelos vendidos 
                    </h3>
                    
                    <div class="">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="bg-navy disabled">
                                <tr>
                                    <th>Modelo</th>
                                    <th>Monturas</th>
                                    <th>Estuches</th>
                                    <th>Precio Montura</th>
                                    <th>Precio Modelo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta->movimientoVenta as $mov)
                                <tr>
                                    <td>{{ $mov->modelo->name }}</td>
                                    <td>{{ $mov->monturas}}</td>
                                    <td>{{ $mov->estuches }}</td>
                                    <td>{{ $mov->precio_montura }}</td>
                                    <td>{{ $mov->precio_modelo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-inline text-right">
                            <b><i class="fa fa-arrow-right"></i>  Total Venta (S/)</b>&nbsp;  
                            <input type="text" class="form-control" value="{{ $venta->total }}" readonly="">
                        </div>
                        <hr>
                    </div>

                    @if($venta->adicionalVenta)
                        <h3 class="bg-green padding_05em col-lg-12">
                            <i class="fa fa-arrow-right"></i> Factura 
                        </h3>

                        <div class="list-group col-lg-3">
                            <b>Nº Factura</b>
                            <p class="list-group-item">{{ $venta->adicionalVenta->factura->num_factura }}</p>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>Sub-Total</b>
                            <p class="list-group-item">
                                S/ {{ $venta->adicionalVenta->factura->subtotal }}
                            </p>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>IGV</b>
                            <p class="list-group-item">
                                {{ $venta->adicionalVenta->factura->impuesto }} %
                            </p>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>Total Neto</b>
                            <p class="list-group-item">
                                s/ {{ $venta->adicionalVenta->factura->total }}
                            </p>
                        <hr>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>Fecha estado de entrega Factura</b>
                            <p class="list-group-item list-group-item-info">
                                {{ $venta->adicionalVenta->ref_estadic_id == 3 ? $venta->adicionalVenta->fecha_estado : 'Factura no entregada'}}
                            </p>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>Tipo de item</b>
                            <p class="list-group-item list-group-item-{{ $venta->adicionalVenta ? 'info' : 'danger' }}">
                                {{ $venta->adicionalVenta->item->nombre  }}
                            </p>
                        </div>

                        <div class="list-group col-lg-3">
                            <b>Estado Factura</b>
                            <p class="list-group-item list-group-item-{{ $venta->adicionalVenta->ref_estadic_id == 3 ? 'success' : 'danger' }}">
                                {{ $venta->adicionalVenta->statusAdicional->nombre }}
                            </p>
                        </div>

                        <div class="list-group col-lg-3"></div>
                    @endif

                </div>
            </div>
                <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        </div>
    </div>
@endsection