@extends('layouts.app')
@section('title','Pagos - '.config('app.name'))
@section('header','Pagos')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Pagos </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total de Pagos</span>
                    <span class="info-box-number">{{ count($pagos) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list-alt"></i> Pagos</h3>
                    <span class="pull-right">
                        <span data-toggle="modal" data-target="#create_pago">
                            <button type="button" class="btn btn-danger btn_create_pago" rel="tooltip" data-toggle="tooltip" title="Añadir un nuevo pago">
                                <i class="fa fa-plus"></i> Nuevo pago
                            </button>
                        </span>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="label-danger">
                            <tr>
                                <th class="text-center">Nº Pago</th>
                                <th class="text-center">Codigo Venta</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">total</th>
                                <th class="text-center">Abono</th>
                                <th class="text-center">Restante</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($pagos as $pago)
                                <tr>
                                    <td><b>[{{ $pago->id }}]</b></td>
                                    <td><b>[{{ $pago->venta_id }}]</b></td>
                                    <td>
                                        {{ $pago->tipoAbono->nombre }}
                                        @if($pago->tipo_abono_id == 1)
                                            <span data-toggle="modal" data-target="#modal_showletra_{{ $pago->id }}">
                                                <button type="button" class="btn btn-xs bg-navy pull-right" data-toggle="tooltip" title="Detalles de la letra"> 
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </span>
                                            @include("ventas.modals.showLetra")
                                        @endif
                                    </td>
                                    <td>{{ $pago->total }}</td>
                                    <td>{{ $pago->abono }}</td>
                                    <td>{{ $pago->restante }}</td>
                                    <td>{{ $pago->createF() }}</td>
                                    <td class="{{ $pago->fecha_cancelacion == null ? 'warning' : 'success' }}">
                                        @if($pago->fecha_cancelacion)
                                            <span><i class="fa fa-check text-success"></i> Cancelado</span> / 
                                            {{ $pago->fecha_cancelacion }}
                                        @else
                                            <span><i class="fa fa-warning"></i> Pendiente</span>
                                        @endif
                                    </td>
                                    <td>

                                        {{-- editar devolucion --}}
                                        <span data-toggle="modal" data-target="#editar_pago">
                                            <button type="button" class="btn bg-orange btn-xs bep" data-toggle="tooltip" title="Editar pago" data-id="{{ $pago->id }}" data-total="{{ $pago->total }}" data-abono="{{ $pago->abono }}" data-restante="{{ $pago->restante }}" data-tipoabono="{{ $pago->tipo_abono_id }}">
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
    @include('pagos.modals.create_pago') 
    @include('pagos.modals.editar_pago') 
@endsection

@section("script")
<script>

    $(".btn_create_pago").click(function(){
        $("#form_add_pago")[0].reset();
        $('#section_letra').hide();
    });

    $(".bep").click(function(e) {
        ruta = '{{ route("pagos.update",":value") }}';
        $("#form_editar_pago").attr("action", ruta.replace(':value', $(this).data("id")));

        $("#total_deuda_edit, #abono_edit, #restante_edit").val('');

        $("#total_deuda_edit").val($(this).data("total"));
        $("#abono_edit").val($(this).data("abono"));
        $("#restante_edit").val($(this).data("restante"));
        $("#tipo_abono_id_edit").val($(this).data("tipoabono")).attr("selected",true);
    });

    $('#venta_id').change(function(event) {
        $("#total_deuda, #abono, #restante").val('');
        $("#icon_load_venta").show();
        $.get("totalDeuda/"+event.target.value+"",function(response, dep){
            $("#total_deuda").val(response);
            $("#icon_load_venta").hide();
        });
    });

    // calcular restante del pago a editar
    function calcularRestanteEdit(monto){
        valor = (monto.value < 0) ? monto.value = 0 : monto.value = monto.value;
        $("#restante_edit").val((parseFloat($("#total_deuda_edit").val()) - parseFloat(valor)));
    }

    $("#form_create_pago").submit(function(e){

        if ($('#restante').val() == 'NaN' || $('#restante').val() < 0) {
            mensajes("Alerta!", "El restante no puede ser negativo ni pueden ser letras, verifique", "fa-warning", "red");
            return false;
        }

        e.preventDefault();
        btn = $(".btn_cp"); btn.attr("disabled", 'disabled');
        form = $(this);

        $.ajax({
            url: "{{ route('pagos.store') }}",
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
        })
        .done(function(data) {
            mensajes('Listo!', 'Nuevo pago añadido, espere mientras es redireccionado...', 'fa-check', 'green');
            setTimeout(window.location = "pagos", 3000);
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