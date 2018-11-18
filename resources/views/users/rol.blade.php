@extends('layouts.app')
@section('title','Roles - '.config('app.name'))
@section('header','Roles')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Roles </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

	<!-- Info boxes -->
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Roles</span>
	          <span class="info-box-number">{{ count($roles) }}</span>
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
	        <h3 class="box-title"><i class="fa fa-users"></i> Roles del sistema</h3>
	        <span class="pull-right"></span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Rol (Perfil)</th>
								<th class="text-center">Usuarios con este rol</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($roles as $d)
								<tr>
									<td>{{$d->name}}</td>
									<td>{{ $d->userRol($d->id) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection