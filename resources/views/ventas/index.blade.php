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
                        <div class="btn-group">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                            Nueva venta <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu bg-red">
                            <li><a href="{{ route('create_venta_directa') }}">Venta directa</a></li>
                            <li><a href="{{ route('create_venta_asignacion') }}">Venta por asignacion</a></li>
                            <li><a href="{{ route('create_venta_consignacion') }}">Venta por consignacion</a></li>
                          </ul>
                        </div>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center bg-navy" width="140px">Estado Fact.</th>
                                <th class="text-center bg-navy">Estado Estu.</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($ventas as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->cliente->nombre_full }}</td>
                                    <td>{{ 'S/ '.$d->total }}</td>
                                    <td>{{ $d->fecha }}</td>

                                    {{-- Estado factura --}}
                                    <td class="{{ $d->adicionalVenta ? 'info' : 'danger' }}">
                                        @if($d->adicionalVenta)
                                            @if($d->adicionalVenta->ref_estadic_id == 3)
                                                <span class="text-center">Entregada</span>
                                            @else
                                                <span class="text-center">{{ $d->adicionalVenta->statusAdicional->nombre }}</span>
                                                <span class="pull-right">
                                                    <button type="button" class="btn btn-default btn-sm btn_update_estado_factura" data-toggle="modal" role="tooltip" data-target="#update_estado_factura" title="Actualizar estado de la factura" value="{{ $d->adicionalVenta->id }}" data-numfactura="{{ $d->adicionalVenta->factura->num_factura }}">
                                                        <i class="fa fa-plus-square"></i>
                                                    </button>
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-nowrap">Factura no generada</span>
                                            <span class="pull-right">
                                                <button type="button" class="btn btn-default btn-sm btn_realizar_factura" data-toggle="modal" role="tooltip" data-target="#create_factura" title="Realizar factura" value="{{ $d->id }}" data-subtotal="{{ $d->total }}" data-subtotal="{{ $d->total }}" data-cliente="{{ $d->cliente_id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Estado estuche --}}
                                    <td>
                                        @if($d->estado_entrega_estuche == "1")
                                            <span class="text-success">{{ $d->estatusEstuche() }} <i class="fa fa-check"></i></span>
                                        @elseif($d->estado_entrega_estuche == "0")
                                            <span class="text-info">{{ $d->estatusEstuche() }} <i class="fa fa-info-circle"></i></span>
                                            <span class="pull-right">
                                                <button type="button" class="btn btn-default btn-sm btn_update_estado_estuche" data-toggle="modal" role="tooltip" data-target="#update_estado_estuche" title="Estado  de los estuches" value="{{ $d->id }}">
                                                    <i class="fa fa-plus-square"></i>
                                                </button>
                                            </span>
                                        @else
                                            <span class="text-danger">{{ $d->estatusEstuche() }} <i class="fa fa-remove"></i></span>
                                        @endif
                                    </td>

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
    @include('ventas.modals.create_factura') 
    @include('ventas.modals.update_estado_factura') 
    @include('ventas.modals.update_estado_estuche') 
@endsection

@section("script")
<script>

    $(".btn_realizar_factura").click(function(){
        $("#impuesto, #total_neto, #num_factura").val("");
        $("#subtotal").val($(this).data('subtotal'));
        $("#id_cliente").val($(this).data('cliente'));
        $("#id_venta").val($(this).val());
    })

    $(".btn_update_estado_factura").click(function(){
        $("#adicional_id").val($(this).val());
        $("#num_factura_update").val($(this).data("numfactura"));
    })

    $(".btn_update_estado_estuche").click(function(){
        $("#venta_id").val($(this).val());
    })

    // calcular impuesto
    function calcularImpuesto(porcentaje){
        subtotal = $("#subtotal").val();
        calculo =  (parseFloat(subtotal) * parseFloat(porcentaje.value)) / 100;
        $("#total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
    }

    $("#form_create_factura").submit(function(e){
        e.preventDefault();
        btn = $(".btn_save_factura"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('ventas.generarFactura') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Factura procesada, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "ventas", 3000);
        })
        .fail(function(data) {
            btn.removeAttr("disabled");
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });

    $("#form_update_estado_factura").submit(function(e){
        e.preventDefault();
        btn = $(".btn_uef"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('ventas.updateEstadoFactura') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Factura actualizada, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "ventas", 3000);
        })
        .fail(function(data) {
            btn.removeAttr("disabled");
            mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
        })
        .always(function() {
            console.log("complete");
        });
        
    });

    $("#form_update_estado_estuche").submit(function(e){
        e.preventDefault();
        btn = $(".btn_uee"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('ventas.updateEstadoEstuche') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Estuches actualizados, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "ventas", 3000);
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