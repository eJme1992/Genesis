@extends('layouts.app')
@section('title','Facturas - '.config('app.name'))
@section('header','Facturas')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Facturas </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Facturas</span>
              <span class="info-box-number">{{ count($facturas) }}</span>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list-alt"></i> Facturas</h3>
                    <span class="pull-right">
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th class="text-center">Nº Factura</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Impuesto</th>
                                <th class="text-center">Total</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($facturas as $d)
                                <tr>
                                    <td>{{ $d->num_factura }}</td>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ $d->subtotal }}</td>
                                    <td>{{ $d->impuesto }}</td>
                                    <td>{{ $d->total }}</td>
                                    <td>

                                        {{-- editar devolucion --}}
                                        <span data-toggle="modal" data-target="#editar_factura">
                                            <button type="button" class="btn bg-orange btn-xs bf" data-toggle="tooltip" title="Editar factura" data-id="{{ $d->id }}" data-nfactura="{{ $d->num_factura }}" data-cliente="{{ $d->cliente->nombre_full }}" data-subtotal="{{ $d->subtotal }}" data-impuesto="{{ $d->impuesto }}" data-total="{{ $d->total }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </span>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include("facturas.modals.edit_factura")
@endsection

@section("script")
<script>
    $(".bf").click(function(e) {
        ruta = '{{ route("facturas.update",":value") }}';
        $("#form_edit_factura").attr("action", ruta.replace(':value', $(this).data("id")));

        $("#n_factura, #cliente, #subtotal, #impuesto, #total").val("");
        $("#n_factura").val($(this).data("nfactura"));
        $("#cliente").val($(this).data("cliente"));
        $("#subtotal").val($(this).data("subtotal"));
        $("#impuesto").val($(this).data("impuesto"));
        $("#total_neto").val($(this).data("total"));
    });
</script>
@endsection