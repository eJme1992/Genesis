@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Usuarios"> Usuarios </a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-danger box-solid">
					<div class="box-body">
						<form class="" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
							{{ method_field( 'POST' ) }}
							{{ csrf_field() }}

							<div class="col-sm-12">
								<h3 class="label-danger padding_1em">Datos Personales</h3>
							</div>
							<div class="form-group col-sm-4 {{ $errors->has('name')?'has-error':'' }}">
								<label class="control-label" for="name">Nombre: *</label>
								<input id="name" class="form-control" type="text" name="name" value="{{ old('name')?old('name'):'' }}" placeholder="Nombre" required pattern="[A-Za-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z">
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('ape')?'has-error':'' }}">
								<label class="control-label" for="ape">Apellido: *</label>
								<input id="ape" class="form-control" type="text" name="ape" value="{{ old('ape')?old('ape'):'' }}" placeholder="Apellido" required pattern="[A-Za-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z">
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('RUC')?'has-error':'' }}">
								<label class="control-label" for="sexo">Sexo: *</label>
								<select name="sexo" class="form-control" required="">
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
								</select>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('documento')?'has-error':'' }}">
								<label class="control-label" for="documento">Documento: *</label>
								<select name="documento" class="form-control" required="">
									<option value="DNI">DNI</option>
									<option value="PASAPORTE">PASAPORTE</option>
									<option value="CARNET DE EXTRANGERIA">CARNET DE EXTRANGERIA</option>
								</select>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('identificacion')?'has-error':'' }}">
								<label class="control-label" for="identificacion">Identificacion: *</label>
								<input type="text" name="identificacion" class="form-control int" placeholder="indique Nº de identificacion..." required="">
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('RUC')?'has-error':'' }}">
								<label class="control-label" for="RUC">RUC: </label>
								<input type="text" name="ruc" class="form-control int" placeholder="Registro unico de constribuyentes...">
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('departamento')?'has-error':'' }}">
								<label class="control-label" for="departamento">Departamento: *</label>
								<select class="form-control" name="departamento_id" id="dep" required>
										<option value="">Seleccione</option>
										@foreach($departamentos as $depart)
										<option value="{{ $depart->id }}">{{ $depart->departamento }}</option>
										@endforeach
								</select>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('provincia')?'has-error':'' }}">
								<label class="control-label" for="provincia">Provincia: *</label>
								<select class="form-control" name="provincia_id" id="prov" required>

								</select>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('distrito')?'has-error':'' }}">
								<label class="control-label" for="distrito">Distrito: *</label>
								<select class="form-control" name="distrito_id" id="dist" required>

								</select>
							</div>


							<div class="form-group col-sm-8 {{ $errors->has('direccion_hab')?'has-error':'' }}">
								<label class="control-label" for="identificacion">Direccion de habitacion: *</label>
								<textarea name="direccion_hab" class="form-control" required=""></textarea>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('correo')?'has-error':'' }}">
								<label class="control-label" for="correo">E-mail: *</label>
								<input type="email" name="correo" class="form-control" placeholder="indique correo..." required="">
							</div>

							<div class="form-group col-sm-6 {{ $errors->has('telefono_casa')?'has-error':'' }}">
								<label class="control-label" for="telefono_casa">Telefono Casa: </label>
								<span>01</span>
								<input type="text" name="telefono_casa" class="form-control int" placeholder="indique telefono de casa (7 digitos)..." maxlength="7">
							</div>

							<div class="form-group col-sm-6 {{ $errors->has('telefono_movil')?'has-error':'' }}">
								<label class="control-label" for="telefono_movil">Telefono movil: *</label>
								<span>+51</span>
								<input type="text" name="telefono_movil" class="form-control int" placeholder="indique telefono movil (9 digitos)..." required="" maxlength="9">
							</div>

							<hr>

							<div class="col-sm-12">
								<h3 class="label-danger padding_1em">Datos de Acceso</h3>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('foto')?'has-error':'' }}">
								<label class="control-label" for="foto">Foto: *</label>
								<input type="file" name="imagen" class="form-control" placeholder="indique foto..." id="file_input" required="">
							</div>

							<div class="form-group col-sm-8 {{ $errors->has('cargo')?'has-error':'' }}">
								<label class="control-label" for="cargo">Cargo: *</label>
								<textarea name="cargo" required="" class="form-control"></textarea>
							</div>

							<!-- <div class="col-sm-4"></div> -->

							<div class="form-group col-sm-4 {{ $errors->has('usuario')?'has-error':'' }}">
								<label class="control-label" for="email">Usuario: *</label>
								<input id="email" class="form-control" type="text" name="usuario" value="{{ old('usuario')?old('usuario'):'' }}" placeholder="Usuario" required maxlength="15">
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('password')?'has-error':'' }}">
								<label class="control-label" for="password">Contraseña:* </label><em>(min 6, max 12)</em>
								<input id="password" class="form-control" type="password" name="password" required>
							</div>

							<div class="form-group col-sm-4 {{ $errors->has('password_confirmation')?'has-error':'' }}">
								<label class="control-label" for="password_confirmation">Repetir Contraseña: *</label><em>(min 6, max 12)</em>
								<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
							</div>

							@if (count($errors) > 0)
							<div class="col-sm-12">
					          <div class="alert alert-danger alert-important">
						          <ul>
						            @foreach($errors->all() as $error)
						              <li>{{$error}}</li>
						            @endforeach
						          </ul>
					          </div>
					        </div>
					        @endif

							<div class="form-group text-right col-sm-12">
								<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
								<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
							</div>
						</form>
					</div>
				</div>
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
			$("#prov").append("<option value=''></option>");
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
