@extends('layouts.app')
@section('title','Actividad de los usuarios - '.config('app.name'))
@section('header','Actividad de los usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Actividad de los usuarios </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Actividad</span>
	          <span class="info-box-number">{{ count($bu) }}</span>
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
			        <h3 class="box-title"><i class="fa fa-empire"></i> Usuarios del sistema</h3>
			        <span class="pull-right">
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-success">
							<tr>
								<th class="text-center">Usuario</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>>
								<th class="text-center">Movimiento</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($bu as $d)
								<tr>
									<td>{{ $d->user->name }} {{ $d->user->ape }} ({{ $d->user->usuario }})</td>
									<td>{{ $d->fecha }}</td>
									<td>{{ $d->hora }}</td>
									<td>{{ $d->movimiento }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection