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
        <div class="col-lg-12">
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Notas de Credito</h3>
                    <span class="pull-right">
                        <a href="{{ route('notacredito.create') }}" class="btn btn-danger" data-toggle="tooltip" title="Realizar factura">
                            <i class="fa fa-plus"></i> Nueva
                        </a>
                    </span>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover text-center">
                        <thead class="label-danger">
                            <tr>
                                <th>Nº Serie</th>
                                <th>Nº Nota</th>
                                <th>Subtotal</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Ultima act.</th>
                                <th class="bg-navy">Factura</th>
                                <th class="bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notacreditos as $d)
                                <tr>
                                    <td>{{ $d->n_serie }}</td>
                                    <td>{{ $d->n_nota }}</td>
                                    <td>{{ $d->subtotal }}</td>
                                    <td>{{ $d->impuesto }}</td>
                                    <td>{{ $d->total }}</td>
                                    <td>{{ $d->createF() }}</td>
                                    <td>{{ $d->updateF() }}</td>
                                    <td>
                                        Nº [{{ $d->factura->num_factura }}] - 
                                        <span data-toggle="modal" data-target="#show_factura_{{ $d->id }}">
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Detales de la factura">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                    </td>
                                    <td>
                                        {{-- editar nota de credito --}}
                                        <span data-toggle="modal" data-target="#editar_nota">
                                            <button type="button" class="btn bg-orange btn-xs ben" data-toggle="tooltip" title="Editar nota" data-id="{{ $d->id }}" data-nserie="{{ $d->n_serie }}" data-nnota="{{ $d->n_nota }}" data-subtotal="{{ $d->subtotal }}" data-impuesto="{{ $d->impuesto }}" data-total="{{ $d->total }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </span>

                                        @if(count($d->movDevolucion) > 0)
                                        <span data-toggle="modal" data-target="#show_modelos_{{ $d->id }}">
                                            <button type="button" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Ver modelos">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($notacreditos as $d)
        @include("notacredito.modals.show_modelos")
        @include("notacredito.modals.show_factura")
    @endforeach
    @include("notacredito.modals.editar_nota")
    @include("notacredito.modals.create_notacredito")
@endsection
@section("script")
<script>

    // calcular impuesto solo para crear notas
    function calTotal(porcentaje){
        subtotal = $(".subtotal").val();
        valor = (porcentaje.value < 0) ? porcentaje.value = 0 : porcentaje.value = porcentaje.value;
        calculo =  (parseFloat(subtotal) * parseFloat(valor)) / 100;
        $(".total_neto").val(parseFloat(calculo) + parseFloat(subtotal));
    }

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
            mensajes('Listo!', 'Nota de credito procesada, espere mientras es redireccionado...', 'fa-check', 'green');
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