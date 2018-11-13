@extends('layouts.app')
@section('title','Producto - '.config('app.name'))
@section('header','Producto')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('productos.index')}}" title="Producto"> Producto </a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<h1>En contruccion.... <i class="fa fa-exclamation-circle text-info"></i></h1>
			</div>
		</div>
@endsection
