@extends('layouts.app')
@section('title','Guias de Remision - '.config('app.name'))
@section('header','Guias de Remision')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Guias de Remision </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Guias de Remision</span>
	          <span class="info-box-number">{{ count($guias) }}</span>
	        </div>
	        <!-- /.info-box-content -->
	      </div>
	      <!-- /.info-box -->
	    </div>
	  </div><!--row-->

	<div class="row">
  		<div class="col-md-12">
    		<div class="box box-danger box-solid">
	      		<div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Guias de Remision</h3>
			        <span class="pull-right">
						<a href="#create" data-toggle="modal" data-target="#create_guia" class="btn btn-danger" id="modal_guia">
							<i class="fa fa-plus" aria-hidden="true"></i> Nueva guia
						</a>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Serial-Guia</th>
								<th class="text-center">Cliente</th>
								<th class="text-center">Salida</th>
								<th class="text-center">Llegada</th>
								<th class="text-center">Motivo</th>
								<th class="text-center">Vendedor</th>
								<th class="text-center">Modelos</th>
								<th class="text-center bg-navy text-nowrap"><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
						<tbody class="">
							@foreach($guias as $d)
								<tr>
									<td><b>{{ $d->serial }}</b></td>
									<td>{{ $d->cliente->nombre_full ?? '' }}</td>
									<td>
										{{ $d->dirSalida->departamento->departamento }} |
										{{ $d->dirSalida->provincia->provincia }} |
										{{ $d->dirSalida->distrito->distrito }} |
										{{ $d->dirSalida->detalle }}
										@forelse($d->modeloGuias as $m)
										<input type="hidden" class="name_mod" value="{{ $m->modelo->name }}">
										<input type="hidden" class="montura_mod" value="{{ $m->montura }}">
										@empty
										@endforelse
									</td>
									<td>
										{{ $d->dirLLegada->departamento->departamento }} |
										{{ $d->dirLLegada->provincia->provincia }} |
										{{ $d->dirLLegada->distrito->distrito }} |
										{{ $d->dirLLegada->detalle }}
									</td>
									<td class="success">{{ $d->motivo_guia->nombre }}</td>
									<td>{{ $d->user->name ?? '' }}</td>
									<td class="text-center">
										{{ count($d->modeloGuias) }}
									</td>
									<td class="text-nowrap">
                                        <span class="col-lg-4" data-toggle="modal" data-target="#editar_guia">
                                            <button type="button"
                                                data-id="{{ $d->detalleGuia->id }}"
                                                data-cantidad="{{ $d->detalleGuia->cantidad }}"
                                                data-peso="{{ $d->detalleGuia->peso }}"
                                                data-descripcion="{{ $d->detalleGuia->descripcion }}"
                                                data-toggle="tooltip" title="Editar datos de la guia"
                                                class="btn btn-xs bg-orange beg">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </button> 
                                        </span>
                                        <span class="col-lg-4" data-toggle="modal" data-target="#show_guia_{{ $d->id }}">
                                            <button type="button"
                                                data-toggle="tooltip" title="Detalles de la guia"
                                                class="btn btn-xs bg-navy btn_mg">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button> 
                                        </span>
                                        <span class="col-lg-4">
											<form action="{{ route('guiaRemision.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-xs btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la guia de remision S/N?');"><i class="fa fa-trash"></i></button>
											</form>
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
    @include('guia_remision.modals.editar_guia')
    @include('guia_remision.modals.create')
    @include('direcciones.modals.modal_create')    
    @include('clientes.modals.createclientes') 
    @foreach($guias as $d)
	@include('guia_remision.modals.modelos')
    @endforeach

@endsection
@section("script")
<script>

contar_modelos = 1;

$(".beg").click(function(e) {
    ruta = '{{ route("guiaRemision.update",":value") }}';
    $("#form_edit_guia").attr("action", ruta.replace(':value', $(this).data("id")));

    $("#cantidad, #peso, #descripcion").val("");

    $("#cantidad").val($(this).data("cantidad"));
    $("#peso").val($(this).data("peso"));
    $("#descripcion").val($(this).data("descripcion"));
});

// añadir mas modelos
$("#btn_mas_modelos").click(function(event) {

	contar_modelos++;

	$("#section_modelos").append(
	"<div id='mas_modelos_"+contar_modelos+"'>"+
		"<div class='form-group col-sm-6'>"+
			"<select class='form-control select_modelo' name='modelo_id[]' required='' id='select_modelo_"+contar_modelos+"' style='width: 100%;' data-valor="+contar_modelos+">"+
				"<option value=''>...</option>"+
				
			"</select>"+
		"</div>"+
		"<div class='form-group col-sm-2'>"+
			"<select class='form-control select_montura' name='montura[]' required='' id='select_montura_"+contar_modelos+"'>"+
			"</select>"+
		"</div>"+
		"<div class='form-group col-sm-2'>"+
			"<select class='form-control select_estuche' name='estuche[]' id='select_estuche_"+contar_modelos+"'>"+
			"</select>"+
		"</div>"+
		"<div class='form-group col-sm-1'>"+
			"<button class='btn btn-link' type='button' id='btn_delete_modelo_"+contar_modelos+"'>"+
				"<i class='fa fa-remove text-danger'></i>"+
			"</button>"+
		"</div>"+
	"</div>");

		// eliminar 
	$('#btn_delete_modelo_'+contar_modelos+'').click(function(e){
      $('#mas_modelos_'+contar_modelos+'').remove();
      contar_modelos--;
    });

    // clonar los modelos del option a un nuevo select
	$("#select_modelo_"+contar_modelos+"").html($("#select_modelo_1").html());
});

// busqueda de modelo
$("#section_modelos").on("change", ".select_modelo, .select_montura, .select_estuche",function(event) {
	val = $(this).data("valor");
	$.get("cargarModelo/"+event.target.value+"",function(res, index){
		$("#select_montura_"+val).empty().append(res.monturas);
		$("#select_estuche_"+val).empty().append(res.estuches);
	});
});

// validar cliente en formulario
$('#motivo_guia').change(function(event) {
	if (event.target.value == 2) {
		$('#add_cliente option[value=""]').attr('selected', true);
		$('#add_cliente').attr('disabled', 'disabled');
	}else if($('#add_cliente').attr('disabled')){
		$('#add_cliente').removeAttr('disabled');
		$('#add_cliente').removeAttr('selected');	
	}
});

// guardar guia de remision
$("#form_create_guia").on('submit', function(e) {
	e.preventDefault();
	err = 0;

	$.each($('.select_modelo'),function(index, val){
		name = $(val).val();
		id_name = $(val).attr('id');
		$.each($('.select_modelo'),function(index2, val2){
			 if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
				 $(this).css('border','red 2px solid');
				 err++
			 }
		});
	});

	if(err > 0){
			mensajes('Alerta!', 'No pueden haber modelos iguales', 'fa-warning', 'red');
			return false;
	}else{
		btn = $(".btn_save_guia").text("Espere...").attr("disabled", 'disabled');
		form = $(this);

		$.ajax({
			url: '{{ route("guiaRemision.store") }}',
			headers: {'X-CSRF-TOKEN': $("#token").val()},
			type: 'POST',
			dataType: 'JSON',
			data: form.serialize(),
		})
		.done(function(data) {
			if (data == 2) {
				mensajes('Alerta!', 'Nº de Guia repetido, verifique', 'fa-warning', 'red');
				btn.text("Guardar").removeAttr("disabled");
			}else{
				mensajes('Listo!', 'Creada con exito..... espere', 'fa-check', 'green');
			    form[0].reset();
				$("#create_guia").modal('toggle');
				btn.text("Guardar").removeAttr("disabled");
				location.reload();
			}
		})
		.fail(function(data) {
			btn.text("Guardar").removeAttr("disabled", 'disabled');
			mensajes('Alerta!', eachErrors(data), 'fa-warning', 'red');
		})
		.always(function() {
			console.log("complete");
		});
	}
	
});
</script>
@endsection