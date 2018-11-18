@extends('layouts.app')
@section('title','Guias de Remision - '.config('app.name'))
@section('header','Guias de Remision')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Guias de Remision </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Guias de Remision</span>
	          <span class="info-box-number">{{ count($guias) }}</span>
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
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Guias de Remision</h3>
			        <span class="pull-right">
						<a href="{{ route('guiaRemision.create') }}" class="btn btn-danger">
							<i class="fa fa-plus" aria-hidden="true"></i> Nueva guia
						</a>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Serial-Guia</th>
								<th class="text-center">Direccion</th>
								<th class="text-center">Motivo</th>
								<th class="text-center">Vendedor</th>
								<th class="text-center">Cliente</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($guias as $d)
								<tr>
									<td>{{ $d->serial }}</td>
									<td>{{ $d->direccion->detalle }}</td>
									<td>{{ $d->motivo_guia->nombre }}</td>
									<td>{{ $d->user->name }}</td>
									<td>{{ $d->cliente->name }}</td>
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