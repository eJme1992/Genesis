@extends('layouts.app')
@section('title','Asignacion - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<form class="" action="{{ route('asignaciones.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}

					<div class="col-sm-12">
						<h3 class="label-success padding_1em"><i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
						 	Nueva Asignacion
						</h3>
					</div>

					<div class="form-group col-sm-3">
						<label for="">Vendedor (usuario) </label>
						<select class="form-control" name="user_id" required="">
							@foreach($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-sm-3">
						<label for="">Coleccion </label>
						<select class="form-control" name="coleccion" id="coleccion" required="">
							<option>Seleccione..</option>
							@foreach($colecciones as $c)
							<option value="{{ $c->id }}">{{ $c->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-sm-3">
						<label for="">Marcas </label>
						<select class="form-control" name="marcas" id="marcas" required="">
						</select>
					</div>

					<div class="form-group col-sm-3">
						<label>-</label><br>
						<button class="btn btn-primary btn_sm" type="button" id="btn_cargar_modelos">
							 Cargar modelos
						</button>
					<hr>
					</div>
					<section id="mostrar_modelos" style="display: none;">
						<div class="form-group col-sm-8">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<td>Nombre</td>
										<td>Monturas disponibles</td>
										<td>Precio Monturas</td>
										<td>Asignacion (monturas)</td>
									</tr>
								</thead>
								<tbody id="data_modelos"></tbody>
							</table>
						</div>
					</section>

					@if (count($errors) > 0)
					<div class="col-sm-12">	
			          <div class="alert alert-danger alert-important">
			          	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        </div> 
			        @endif

					<div class="form-group text-right col-sm-12">
			        	<em class="pull-left"><i class="fa fa-info-circle"></i> Seleccione solo las monturas de los modelos que desea asignar</em>
			        	<a class="btn btn-flat btn-default" href="{{route('asignaciones.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-success" type="submit">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</form>
			</div>
		</div>
@endsection
@section("script")
<script>
	
	// busqueda de marcas en la coleccion
	$('#coleccion').change(function(event) {
		$.get("../marcasAll/"+event.target.value+"",function(response, dep){
			$("#marcas").empty();
			if (response.length > 0) {
				for (i = 0; i<response.length; i++) {
						$("#marcas").append("<option value='"+response[i].marca.id+"'> "+response[i].marca.name+"</option>");
				}
				$("#data_modelos").empty();
			}else{
				alert("No posee marcas asociadas");
				$("#data_modelos").empty();
			}
		});
	});

	// cargar modelos en la vista
	$("#btn_cargar_modelos").click(function(e) {
		e.preventDefault();
		nombre_modelo = "";
		montura_modelo = "";
		precio_montura_modelo = "";

		if ($("#coleccion").val() && $("#marcas").val()) {
			$.get("../modelosAll/"+$("#coleccion").val()+"/"+$("#marcas").val()+"",function(response, dep){
					console.log(response)
					$("#data_modelos").empty();
					$("#data_modelos").append(response);
					$("#mostrar_modelos").fadeIn(400);
			});
		}else{
			alert("Nada para mostrar, debe llenar todos los campos");
		}
	});

	// Asignar id al elemento eleccionado
	// $('#monturas').change(function(event) {
	// 	$("#modelo_id").attr("name", "modelo_id[]");
	// });

</script>
@endsection
