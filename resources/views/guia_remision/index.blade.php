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
								<th class="text-center">Direccion</th>
								<th class="text-center">Motivo</th>
								<th class="text-center">Vendedor</th>
								<th class="text-center">Cliente</th>
								<th class="text-center">Modelos</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="">
							@foreach($guias as $d)
								<tr>
									<td><b>{{ $d->serial }}</b></td>
									<td>
										{{ $d->direccion->departamento->departamento }} |
										{{ $d->direccion->provincia->provincia }} |
										{{ $d->direccion->distrito->distrito }} |
										{{ $d->direccion->detalle }}
										@forelse($d->modeloGuias as $m)
										<input type="hidden" class="name_mod" value="{{ $m->modelo->name }}">
										<input type="hidden" class="montura_mod" value="{{ $m->montura }}">
										@empty
										@endforelse
									</td>
									<td>{{ $d->motivo_guia->nombre }}</td>
									<td>{{ $d->user->name ?? '' }}</td>
									<td>{{ $d->cliente->nombre_full ?? '' }}</td>
									<td class="text-center">
										{{ count($d->modeloGuias) }}
										<a href="#modelos_guia"
											data-toggle="modal"
											data-serial="{{ $d->serial }}"
											data-id="{{ $d->id }}"
											class="btn btn-link btn_mg">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a> 
									</td>
									<td>
										<span class="col-sm-6">
											<!-- <a href="#create_guia"
												data-toggle="modal" 
												data-target="#create_guia"
												value="{{ $d->id }}"
												class="btn btn-warning btn-sm">
												<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
											</a> -->
										</span>
										<span class="col-sm-6">
											<form action="{{ route('guiaRemision.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-sm btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la guia de remision S/N?');"><i class="fa fa-trash"></i></button>
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
	@include("guia_remision.modals.create")
	@include('guia_remision.modals.modelos')
	@include('direcciones.modals.modal_create')
	@include('clientes.modals.createclientes')

@endsection
@section("script")
<script>

contar_modelos = 1;

$(".btn_mg").click(function(e) {
	$("#n_guia").empty().text($(this).data('serial'));
	ruta = '{{ route("guiaRemision.show",":btn.value") }}';
	ruta = ruta.replace(':btn.value', $(this).data("id"));

	$.get(ruta, function(res) {
		$("#mostrar_mod").empty().append(res.modelo);
		$("#mostrar_mont").empty().append(res.montura);
		$(".flecha").empty();
		for (i = 0; i < res.montura.length; i++) {
			$(".flecha").append('<i class="fa fa-arrow-right"></i><br>');
		}
	});
});

// mensaje json
function msj(titulo, contenido, icono, type){
  $.alert({
        title: titulo,
        content: contenido,
        icon: 'fa fa-'+icono,
        theme: 'modern',
        type: type
    });
}

// cargar clientes
function viewCliente(){
    var ruta = "{{ route('viewClientes') }}";
    $("#add_cliente").empty()
    $.get(ruta, function(res){
        $.each(res, function(index, val) {
            $("#add_cliente").append("<option value='"+val.id+"'>"+val.nombre_full+"</option>");
        });
    });
}

// cargar direcciones
function allDir(){
  	ruta = '{{ route("allDireccion") }}';
  	$.get(ruta, function(response, dir){
			$(".dir_asig").empty().append(response);
  	});
}

// añadir mas modelos
$("#btn_mas_modelos").click(function(event) {

	contar_modelos++;

	$("#section_modelos").append(
				"<div id='mas_modelos_"+contar_modelos+"'>"+
					"<div class='form-group col-sm-8'>"+
						"<select class='form-control select_modelo' name='modelo_id[]' required='' id='select_modelo_"+contar_modelos+"' style='width: 100%;' data-valor="+contar_modelos+">"+
							"<option value=''>...</option>"+
							
						"</select>"+
					"</div>"+
					"<div class='form-group col-sm-2'>"+
						"<select class='form-control select_montura' name='montura[]' required='' id='select_montura_"+contar_modelos+"'>"+
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
$("#section_modelos").on("change", ".select_modelo, .select_montura",function(event) {
	val = $(this).data("valor");
	$.get("buscar_modelos_en_asignacion/"+event.target.value+"",function(res, index){
		$("#select_montura_"+val).empty().append(res);
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

// busqueda de provincias
$('.dep').change(function(event) {
	$(".prov").empty();
	$(".dist").empty();
	$(".prov").append("<option value=''>...</option>");
	$.get("prov/"+event.target.value+"",function(response, dep){
		for (i = 0; i<response.length; i++) {
				$(".prov").append("<option value='"+response[i].id+"'> "+response[i].provincia+"</option>");
		}
	});
});

// busqueda de distritos
$('.prov').change(function(event) {
	$(".dist").empty();
	$.get("dist/"+event.target.value+"",function(response, dep){
		for (i = 0; i<response.length; i++) {
				$(".dist").append("<option value='"+response[i].id+"'> "+response[i].distrito+"</option>");
		}
	});
});

// crear nuevos clientes
$("#form_cliente_save").on("submit", function(e) {
	e.preventDefault();
	btn = $(".btn_create_cliente");
	form = $(this);

	btn.text("Espere un momento...").addClass("disabled");

	$.ajax({
		url: '{{ route("clientes.store") }}',
		headers: {'X-CSRF-TOKEN': $("#token").val()},
		type: 'POST',
		dataType: 'JSON',
		data: form.serialize(),
	})
	.done(function(data) {
		$("#create_cliente").modal('toggle');
	    btn.text("Guardar").removeClass("disabled");
	    viewCliente();
	    form[0].reset();
        msj('Listo!', "Cliente agregado", 'check', 'green');
	})
	.fail(function(data) {
		btn.text("Guardar").removeClass("disabled");
        msjs = data.responseText;
		msjs = msjs.replace(/\{|\}|\"|\[|\]/gi," ");
		msjs2 = msjs.replace(/\,/gi,"\n\n");
		btn.text("Guardar").removeClass("disabled");
		msj('Alerta!', msjs2.toUpperCase(), 'warning', 'red');
	})
	.always(function() {
		console.log("complete");
	});
	
});

// guardar direccion
$(".form_create_direccion").on('submit', function(e) {
	e.preventDefault();
	btn = $(".btn_create_direccion");
	btn.text("Espere...").attr("disabled", 'disabled');

	var form = $(this);

	$.ajax({
		url: '{{ route("direcciones.store") }}',
		headers: {'X-CSRF-TOKEN': $("#token").val()},
		type: 'POST',
		dataType: 'JSON',
		data: form.serialize(),
	})
	.done(function(data) {
		allDir();
		if (data == 1) {
		    msj('Error!', 'Direccion ya existente, verifique', 'warning', 'red');
			btn.text("Guardar").removeAttr("disabled", 'disabled');
		}else{
		    msj('Listo!', 'Agregado con exito', 'check', 'green');
		    form[0].reset();
			$(".modal_create_direccion").modal('toggle');
			btn.text("Guardar").removeAttr("disabled", 'disabled');
		}
	})
	.fail(function(data) {
		btn.text("Guardar").removeAttr("disabled", 'disabled');
		msjs = data.responseText;
		msjs = msjs.replace(/\{|\}|\"|\[|\]/gi," ");
		msjs2 = msjs.replace(/\,/gi,"\n\n");
		msj('Alerta!', msjs2.toUpperCase(), 'warning', 'red');
	})
	.always(function() {
		console.log("complete");
	});
	
});

// crear guia de remision
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
	    msj('Alerta!', "No puede haber modelos iguales", 'warning', 'red');
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
			console.log(data)
			if (data == 1) {
			    msj('Error!', "Nº Guia repetida, verifique", 'warning', 'red');
				btn.text("Guardar").removeAttr("disabled", 'disabled');
			}else{
			    msj('Listo!', "Creada con exito..... espere", 'check fa fa-spinner fa-spin', 'green');
			    form[0].reset();
				$("#create_guia").modal('toggle');
				btn.text("Guardar").removeAttr("disabled", 'disabled');
				location.reload();
			}
		})
		.fail(function(data) {
			console.log(data)
			btn.text("Guardar").removeAttr("disabled", 'disabled');
			msjs = data.responseText;
			msjs = msjs.replace(/\{|\}|\"|\[|\]/gi," ");
			msjs2 = msjs.replace(/\,/gi,"\n\n");
			msj('Alerta!', msjs2.toUpperCase(), 'warning', 'red');
		})
		.always(function() {
			console.log("complete");
		});
	}
	
});
</script>
@endsection