@extends('layouts.app')
@section('title','Asignacion de modelos - '.config('app.name'))
@section('header','Asignacion de modelos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Asignacion de modelos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Asignacion de modelos</span>
	          <span class="info-box-number">{{ count($asignaciones) }}</span>
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
			        <h3 class="box-title"><i class="fa fa-list-alt"></i> Asignacion de modelos</h3>
			        <span class="pull-right">
						<a href="{{ route('asignaciones.create') }}" class="btn btn-danger">
							<i class="fa fa-plus" aria-hidden="true"></i> Nueva asignacion
						</a>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Vendedor (Usuario)</th>
								<th class="text-center">Modelo - [Codigo]</th>
								<th class="text-center">Monturas</th>
								<th class="text-center">Fecha asignacion</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($asignaciones as $d)
								<tr>
									<td class="text-capitalize"><strong>{{ $d->user->name }} {{ $d->user->ape }}</strong></td>
									<td>{{ $d->modelo->name.' - ['.$d->modelo->id.']' }}</td>
									<td>{{ $d->monturas }}</td>
									<td>{{ $d->fecha }}</td>
									<td>
										<span class="">
											<form action="{{ route('asignaciones.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-sm btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la asignacion con todas sus dependencias S/N?');"><i class="fa fa-trash"></i>
		              							</button>
											</form>
										</span>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection