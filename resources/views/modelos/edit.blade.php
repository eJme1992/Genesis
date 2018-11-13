@extends('layouts.app')
@section('title','Modelo - '.config('app.name'))
@section('header','Modelo')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Modelo"> Modelo </a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form padding_1em">
				<form action="{{ route('modelos.update',[$modelo->id]) }}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					
					<div class="form-group">
						<label for="">Marcas(*)</label>
						<select name="marca_id" id="" class="form-control" required="">
							<option value="">Seleccione</option>
							@foreach($marcas as $m)
							<option value="{{ $m->id }}" @if($m->id == $modelo->id) selected @endif>{{ $m->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Codigo del Modelo</label>
						<input type="text" class="form-control" name="codigo" placeholder="Codigo...." required="" value="{{ $modelo->codigo }}">
					</div>
					<div class="form-group">
						<label for="">Nombre del modelo</label>
						<input type="text" class="form-control text-capitalize" name="name" placeholder="Nombre...." required="" value="{{ $modelo->name }}">
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
						<a class="btn btn-flat btn-default" href="{{route('modelos.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection
