@extends('layouts.app')
@section('title','Asignacion de Rutas - '.config('app.name'))
@section('header','Asignacion de Rutas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Rutas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

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

	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Asignaciones</span>
	          <span class="info-box-number">{{ count($asignacionesrutas) }}</span>
	        </div>
	        <!-- /.info-box-content -->
	      </div>
	      <!-- /.info-box -->
	    </div>
	  </div><!--row-->

	<div class="row">
  		<div class="col-md-12">
    		<div class="box box-success box-solid">
	      		<div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Rutas - Vendedor</h3>
			        <span class="pull-right">
						<button type="button"
							data-toggle="modal" data-target="#create"
							aria-expanded="false" aria-controls="create"
							class="btn btn-success btn-sm">
								Nueva asignacion
						</button>
						<!-- <a href="{{ route('asigRutaCreate') }}" class="btn btn-sm btn-success">
							Nueva asignacion
						</a> -->
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-success">
							<tr>
								<th class="text-center">Motivo viaje</th>
								<th class="text-center">Direccion</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($rutas as $d)
								<tr>
									<td>{{ $d->motivo_viaje->nombre }}</td>
									<td>{{ $d->direccion->detalle }}</td>
									<td>{{ $d->fecha }}</td>
									<td>...</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include("asignaciones.modals.create_asignacion_ruta")
@endsection