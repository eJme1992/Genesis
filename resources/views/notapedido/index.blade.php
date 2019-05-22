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
                                        <span data-toggle="modal" data-target="#editar_notapedido">
                                            <button type="button" class="btn bg-orange btn-xs benp" data-toggle="tooltip" title="Editar nota" data-id="{{ $d->id }}" data-npedido="{{ $d->n_pedido }}" data-motivo="{{ $d->motivo_nota_id }}" data-cliente="{{ $d->cliente_id }}" data-direccion="{{ $d->direccion_id }}"  data-total="{{ $d->total }}">
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
    @include("notapedido.modals.edit_notapedido")
    @include("notapedido.modals.create_notapedido")
@endsection
@section("script")
<script>

    $(".benp").click(function(e) {
        ruta = '{{ route("notapedido.update",":value") }}';
        $("#form_edit_notapedido").attr("action", ruta.replace(':value', $(this).data("id")));

        $("#n_pedido, #motivo_nota_id, #cliente_id, #direccion_id, #total").val("");

        $("#n_pedido").val($(this).data("npedido"));
        $("#motivo_nota_id").val($(this).data("motivo")).attr("selected",true);
        $("#cliente_id").val($(this).data("cliente")).attr("selected",true);
        $("#direccion_id").val($(this).data("direccion")).attr("selected",true);
        $("#total").val($(this).data("total"));
    });

    $("#form_create_notacredito").submit(function(e){
        if ($('#total_neto_c').val() == 'NaN' || $('#total_neto_c').val() < 0) {
            mensajes("Alerta!", "El restante no puede ser negativo ni pueden ser letras, verifique", "fa-warning", "red");
            return false;
        }

        e.preventDefault();
        btn = $(".btn_save_nc"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('notacredito.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Factura procesada, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "notacredito", 3000);
        })
        .fail(function(data) {
            btn.removeAttr("disabled");
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>
@endsection