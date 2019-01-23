@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Dashboard')
@section('content')
	<div class="row">
		<h1 style="background-color: #fff; border-top: solid 1px #198F56; border-bottom: solid 1px #198F56; padding: 0.5em;">Distribuidora Genesis</h1>			
		<div class="col-sm-12" style="color: #198F56;">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-capitalize">Bienvenido <span style="color: #198F56;">{{ \Auth::user()->usuario }}</span></h4>
				</div>
				<div class="panel-body">	
					<div class="text-center">
						<div class="col-sm-4">
							<span> <em>Verifica tus productos</em></span>
							<img src="{{ asset('img/dash1.png') }}" alt="dash" class="img-responsive center-block" style="height: 200px">
						</div>
						<div class="col-sm-4">
							<span> <em>Lleva el control</em></span>
							<img src="{{ asset('img/dash3.png') }}" alt="dash" class="img-responsive center-block" style="height: 200px">
						</div>
						<div class="col-sm-4">
							<span> <em>Asigna tus cajas</em></span>
							<img src="{{ asset('img/dash2.png') }}" alt="dash" class="img-responsive center-block" style="height: 200px">
						</div>						
					</div>
				</div>
			</div>   
		</div>
  </div>
@endsection