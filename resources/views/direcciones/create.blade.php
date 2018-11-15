@extends('layouts.app')
@section('title','Direccion - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<form class="" action="{{ route('direcciones.store') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="col-sm-12">
						<h3 class="label-success padding_1em"><i class="fa fa-list"></i> <i class="fa fa-arrow-left"></i>
						 	Nueva Direccion
						</h3>
					</div>

					<div class="form-group col-sm-4">
						<label for="">Departamento </label>
						<select class="form-control" name="departamento_id" required="" id="dep">
							<option>Seleccione</option>
							@foreach($departamentos as $d)
							<option value="{{ $d->id }}">{{ $d->departamento }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-sm-4">
						<label for="">Provincia </label>
						<select class="form-control" name="provincia_id" id="prov" required="">
						</select>
					</div>

					<div class="form-group col-sm-4">
						<label for="">Distrito </label>
						<select class="form-control" name="distrito_id" id="dist">
						</select>
					</div>

					<div class="form-group col-sm-8">
						<label for="">Detalle </label>
						<input type="text" class="form-control text-uppercase" name="detalle" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" placeholder="Especifique un detalle">
					</div>

					<div class="form-group col-sm-4">
						<label for="">Tipo </label>
						<select class="form-control" name="tipo" required="">
							<option value="00">Origen</option>
							<option value="01">Destino</option>
						</select>
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
						<hr>
			        	<a class="btn btn-flat btn-default" href="{{route('direcciones.index')}}"><i class="fa fa-reply"></i> Atras</a>
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
	
	// busqueda de provincias
	$('#dep').change(function(event) {
		$.get("../prov/"+event.target.value+"",function(response, dep){
			$("#prov").empty();
			$("#dist").empty();
			for (i = 0; i<response.length; i++) {
					$("#prov").append("<option value='"+response[i].id+"'> "+response[i].provincia+"</option>");
			}
		});
	});

	// busqueda de distritos
	$('#prov').change(function(event) {
		$.get("../dist/"+event.target.value+"",function(response, dep){
			$("#dist").empty();
			for (i = 0; i<response.length; i++) {
					$("#dist").append("<option value='"+response[i].id+"'> "+response[i].distrito+"</option>");
			}
		});
	});


</script>
@endsection
