@extends('layouts.app')
@section('title','Modelos - '.config('app.name'))
@section('header','Modelos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Modelos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Modelos</span>
	          <span class="info-box-number">{{ count($modelos) }}</span>
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
			        <h3 class="box-title"><i class="fa fa-empire"></i> Modelos</h3>
			        <span class="pull-right">
						<button type="button" data-toggle="modal" data-target="#modal_modelo" aria-expanded="false" aria-controls="modal_modelo" class="btn btn-success">
							<i class="fa fa-plus" aria-hidden="true"></i> Nuevo modelo
						</button>
					</span>
			    </div>
      			<div class="box-body">
      				<span id="reg" style="display:none;" class="text-center">
						<i class="fa fa-refresh fa-pulse fa-fw fa-2x text-success"></i>
					</span>
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead class="label-success">
							<tr>
								<th class="text-center">Codigo</th>
								<th class="text-center">Nombre</th>>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($modelos as $d)
								<tr>
									<td>{{ $d->codigo }}</td>
									<td class="text-capitalize">{{ $d->name }}</td>
									<td>
										<a href="{{ route('modelos.edit',[$d->id])}} " class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('modelos.modal_modelo')
@endsection