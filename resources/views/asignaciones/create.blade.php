@extends('layouts.app')
@section('title','Asignacion de modelos - '.config('app.name'))
@section('header','Asignacion de modelos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Asignacion de modelos </li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-danger box-solid">
					<div class="box-body">
						<form class="" action="{{ route('asignaciones.store') }}" method="POST" enctype="multipart/form-data">
							{{ method_field( 'POST' ) }}
							{{ csrf_field() }}

							<div class="col-sm-12">
								<h3 class="label-danger padding_1em"><i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
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

							<div class="col-sm-12">
								<table class="table table-bordered table-striped">
									<tr>
										<td style="width: 80px"><span id="name_modelos"></span></td>
										<td><span id="precio_modelos"></span></td>
									</tr>
								</table>
								<table class="table data-table table-bordered table-striped">
									<thead class="label-danger">
										<tr>
											<th>[Codigo]</th>
											<th>Nombre</th>
											<th>Monturas disponibles</th>
											<th>Asignacion (monturas)</th>
										</tr>
									</thead>
									<tbody id="data_modelos"></tbody>
								</table>
							</div>

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
								<hr><br>
					        	<em class="pull-left"><i class="fa fa-info-circle"></i> Seleccione solo las monturas de los modelos que desea asignar</em>
					        	<a class="btn btn-flat btn-default" href="{{route('asignaciones.index')}}"><i class="fa fa-reply"></i> Atras</a>
								<button class="btn btn-success" type="submit" onclick="return confirm('Desea Asignar estos datos al usuario?');">
									<i class="fa fa-save"></i> Guardar
								</button>
							</div>
						</form>
					</div>
				</div>
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
				$.alert({
			        title: 'Alerta!',
			        content: "No posee marcas asociadas",
			        icon: 'fa fa-warning',
			        theme: 'modern',
			        type: 'red'
			    });
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
			$("#data_modelos").empty();
			$("#name_modelos").empty();

			$.get("../modelosAll/"+$("#coleccion").val()+"/"+$("#marcas").val()+"",function(response, dep){
					// alert(response.data);

					$('.data-table').DataTable().destroy();
				    $("#data_modelos").html(response.data);
				    $("#name_modelos").html(response.model);
				    $("#precio_modelos").html(response.precio);
				    $('.data-table').DataTable({
				    	responsive: true,
					    language: {
					      	url:'{{asset("plugins/datatables/spanish.json")}}'
					    }
				    });

					// $("#mostrar_modelos").fadeIn(400);
			});
		}else{
			$.alert({
		        title: 'Alerta!',
		        content: "Nada para mostrar, debe llenar todos los campos",
		        icon: 'fa fa-warning',
		        theme: 'modern',
		        type: 'red'
		    });
		}
	});

	// Asignar id al elemento eleccionado
	// $('#monturas').change(function(event) {
	// 	$("#modelo_id").attr("name", "modelo_id[]");
	// });

</script>
@endsection
