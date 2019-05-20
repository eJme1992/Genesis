@extends('layouts.app')
@section('title','Notas de Pedido - '.config('app.name'))
@section('header','Notas de Pedido')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Notas de Pedido </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-right"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Notas de Pedido</span>
              <span class="info-box-number">{{ count($notapedidos) }}</span>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Notas de Pedido</h3>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover text-center">
                        <thead class="label-danger">
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Motivo</th>
                                <th>Cliente</th>
                                <th>Direccion</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th class="bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notapedidos as $d)
                                <tr>
                                    <td>{{ $d->n_pedido }}</td>
                                    <td>{{ $d->motivo->nombre }}</td>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ $d->direccion->full_dir() }}</td>
                                    <td>{{ $d->total }}</td>
                                    <td>{{ $d->createF() }}</td>
                                    <td>
                                        {{-- editar nota de pedido --}}
                                        <span data-toggle="modal" data-target="#editar_nota">
                                            <button type="button" class="btn bg-orange btn-xs ben" data-toggle="tooltip" title="Editar nota" data-id="{{ $d->id }}" data-nserie="{{ $d->n_serie }}" data-nnota="{{ $d->n_nota }}" data-subtotal="{{ $d->subtotal }}" data-impuesto="{{ $d->impuesto }}" data-total="{{ $d->total }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </span>

                                        {{-- ver modelos pedido --}}
                                        <span data-toggle="modal" data-target="#show_devolucion_{{ $d->id }}">
                                            <button type="button" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Ver modelos">
                                                <i class="fa fa-eye"></i>
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
@endsection
@section("script")
<script>
    $(".ben").click(function(e) {
        ruta = '{{ route("notacredito.update",":value") }}';
        $("#form_edit_nota").attr("action", ruta.replace(':value', $(this).data("id")));

        $("#n_serie, #n_nota, #subtotal, #impuesto, #total").val("");

        $("#n_serie").val($(this).data("nserie"));
        $("#n_nota").val($(this).data("nnota"));
        $("#subtotal").val($(this).data("subtotal"));
        $("#impuesto").val($(this).data("impuesto"));
        $("#total_neto").val($(this).data("total"));
    });
</script>
@endsection