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
                        <span data-toggle="modal" data-target="#create_factura">
                            <button type="button" class="btn btn-danger btn_realizar_factura" data-toggle="tooltip" title="Realizar factura">
                                <i class="fa fa-plus"></i> Nueva
                            </button>
                        </span>
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
                                <th class="text-center">Venta</th>
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
                                        @if($d->adicionalFactura)
                                        <span data-toggle="modal" data-target="#ver_venta_{{ $d->id }}">
                                            <button type="button" class="btn bg-primary btn-xs" data-toggle="tooltip" title="Ver venta">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                        @endif
                                    </td>
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
    @include('facturas.modals.create_factura') 
    @foreach($facturas as $d)
        @if($d->adicionalFactura)
            @include("facturas.modals.verventa")
        @endif
    @endforeach
@endsection

@section("script")
<script>

    // calcular impuesto solo para crear facturas
    function calTotal(porcentaje){
        subtotal = $(".subtotal").val();
        valor = (porcentaje.value < 0) ? porcentaje.value = 0 : porcentaje.value = porcentaje.value;
        calculo =  (parseFloat(subtotal) * parseFloat(valor)) / 100;
        $(".total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
    }

    $("#buscar_venta").click(function(e) {
        $("#cliente_id, #cliente_id_id, #num_factura, #subtotal_c, #impuesto, #total_neto_c").val("");
        $(".icon-load").show();
        $.get("cargarVenta/"+$("#venta_id_id").val()+"",function(response, dep){
            if (response != null) {
                $("#cliente_id_id").val(response.cliente_id);
                $("#cliente_id").val(response.cliente.nombre_full);
                $("#subtotal_c").val(response.total);
            }else{
                mensajes("Alerta!", "Sin datos", "fa-warning", "red");
            }
            $(".icon-load").hide();
        });
    });

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

    $("#form_create_factura").submit(function(e){
        if ($('#total_neto_c').val() == 'NaN' || $('#total_neto_c').val() < 0) {
            mensajes("Alerta!", "El restante no puede ser negativo ni puede ser letras, verifique", "fa-warning", "red");
            return false;
        }

        e.preventDefault();
        btn = $(".btn_save_factura"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('facturas.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Factura procesada, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "facturas", 3000);
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