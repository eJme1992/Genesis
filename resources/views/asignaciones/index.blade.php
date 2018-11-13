@extends('layouts.app')
@section('title','Asignaciones - '.config('app.name'))
@section('header','Asignaciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Asignaciones </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Asignaciones</span>
	          <span class="info-box-number">{{ count($asignaciones) }}</span>
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
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Asignaciones</h3>
			        <span class="pull-right">
						<a href="{{ route('asignaciones.create') }}" class="btn btn-success">
							<i class="fa fa-plus" aria-hidden="true"></i> Nueva asignacion
						</a>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-success">
							<tr>
								<th class="text-center">Vendedor (Usuario)</th>
								<th class="text-center">Producto (Modelos)</th>
								<th class="text-center">Monturas</th>
								<th class="text-center">Fecha asignacion</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($asignaciones as $d)
								<tr>
									<td class="text-capitalize">{{ $d->user->name }} {{ $d->user->ape }}</td>
									<td>{{ $d->modelo->name }}</td>
									<td>{{ $d->monturas }}</td>
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
@endsection