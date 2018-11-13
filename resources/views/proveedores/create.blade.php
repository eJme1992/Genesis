@extends('layouts.app')
@section('title','Proveedor / Crear - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<form class="" action="{{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}

					<div class="col-sm-12">
						<h3 class="label-danger padding_1em"><i class="fa fa-user"></i> Representante</h3>
					</div>
					<div class="form-group col-sm-4 {{ $errors->has('nombre')?'has-error':'' }}">
						<label class="control-label" for="name">Nombre completo: *</label>
						<input id="name" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):'' }}" placeholder="Nombre completo" required pattern="[A-Z a-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z">
					</div>

					<div class="form-group col-sm-4 {{ $errors->has('telefono')?'has-error':'' }}">
						<label class="control-label" for="telefono">Telefono: * <span>+51</span></label>
						<input id="telefono" class="form-control int" type="text" name="telefono" value="{{ old('telefono')?old('telefono'):'' }}" placeholder="telefono" required maxlength="9">
					</div>

					<div class="form-group col-sm-4 {{ $errors->has('correo')?'has-error':'' }}">
						<label class="control-label" for="correo">Correo: *</label>
						<input type="email" name="correo" class="form-control" placeholder="correo..." required="">
					</div>
					
					<hr>
					
					<div class="col-sm-12">
						<h3 class="label-danger padding_1em"><i class="fa fa-industry"></i> Empresa</h3>
					</div>

					<div class="form-group col-sm-6 {{ $errors->has('empresa')?'has-error':'' }}">
						<label class="control-label" for="foto">Empresa: *</label>
						<input type="text" name="empresa" class="form-control" placeholder="nombre empresa..." required="">
					</div>

					<div class="form-group col-sm-6 {{ $errors->has('ruc')?'has-error':'' }}">
						<label class="control-label" for="email">RUC: *</label>
						<input class="form-control int" type="text" name="ruc" placeholder="ruc..." required>
					</div>

					<div class="form-group col-sm-12 {{ $errors->has('direccion')?'has-error':'' }}">
						<label class="control-label" for="password">Direccion: *</label>
						<textarea name="direccion" class="form-control" required=""></textarea>
					</div>

					<div class="form-group col-sm-12 {{ $errors->has('observacion')?'has-error':'' }}">
						<label class="control-label" for="password">Observacion: *</label>
						<textarea name="observacion" class="form-control" required=""></textarea>
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
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection
