@extends('layouts.app')
@section('title','Asignacion de Rutas - '.config('app.name'))
@section('header','Asignacion de Rutas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Asignacion de Rutas </li>
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
	        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
	        
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
    		<div class="box box-danger box-solid">
	      		<div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Rutas - Vendedor</h3>
			        <span class="pull-right">
						<button type="button"
							data-toggle="modal" data-target="#create"
							aria-expanded="false" aria-controls="create"
							class="btn btn-danger btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i> Nueva asignacion
						</button>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Usuario</th>
								<th class="text-center">Direccion</th>
								<th class="text-center">Motivo</th>
								<th class="text-center">Fecha de asignacion</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($asignacionesrutas as $d)
								<tr>
									<td>{{ $d->user->name }}</td>
									<td>
										@php 
											$distrito = "";
											if($d->ruta->direccion->distrito){$distrito = $d->ruta->direccion->distrito->distrito;}
										@endphp
										{{ $d->ruta->direccion->departamento->departamento.' | '.$d->ruta->direccion->provincia->provincia.' | '.$distrito.' | '.$d->ruta->direccion->detalle }}
									</td>
									<td>{{ $d->ruta->motivo_viaje->nombre }}</td>
									<td>{{ $d->fecha }}</td>
									<td>
										<span class="col-sm-6">
											<button type="button" id="btn_ar" value="{{ $d->id }}"
												data-toggle="modal" data-target="#edit_ar"
												aria-expanded="false" aria-controls="edit_ar"
												class="btn btn-warning btn-sm" onclick="MostrarAsigRuta(this);">
													<span class="">
														<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
													</span>
											</button>
										</span>
										<span class="col-sm-6">
											<form action="{{ route('asig_ruta.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-sm btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la asignacion con todas sus dependencias S/N?');"><i class="fa fa-trash"></i></button>
											</form>
										</span>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@include("asignaciones.modals.edit_asignacion_ruta")
		</div>
	</div>
	@include("asignaciones.modals.create_asignacion_ruta")
	
@endsection
@section("script")
<script>

	// cargar direcciones
	function MostrarAsigRuta(btn_ar){
		  	var ruta = "editAsigRuta/"+btn_ar.value;

		  	$.get(ruta, function(res){
			    action = '{{ route("asignacion_rutas.update",":res.id") }}'; 
			    action = action.replace(':res.id', res.id);
		    	$("#form_edit_asig_ruta").attr("action", action);

		    	$("#user_id").val(res.user_id).attr("selected",true);
		    	$("#motivo_viaje_id").val(res.ruta.motivo_viaje.id).attr("selected",true);
		    	$("#direccion_id").val(res.ruta.direccion.id).attr("selected",true);
		  	});
	}
</script>
@endsection