@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Ventas</span>
	          <span class="info-box-number"></span>
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
			        <h3 class="box-title"><i class="fa fa-empire"></i> Ventas</h3>
			    </div>
      			<div class="box-body">
      				<h1>En contruccion.... (ejemplo)<i class="fa fa-exclamation text-info"></i></h1>
      				<table class="table data-table table-bordered table-hover">
						<thead class="label-success">
							<tr>
								<th class="text-center">Vendedor (usuario)</th>
								<th class="text-center">Producto</th>
								<th class="text-center">Status</th>
								<th class="text-center">Fecha venta</th>
								<th class="text-center">Monturas restantes</th>
								<th class="text-center">Vendido a</th>
								<th class="text-center">Pdf</th>
								<th class="text-center">Informe</th>
							</tr>
						</thead>
						<tbody class="text-center">
							<tr>
								<td>Rafael Mendez</td>
								<td>001 - coleccion 001 - marca donato - modelo dn214</td>
								<td>Baja</td>
								<td>12/08/2018</td>
								<td>5</td>
								<td>Jose Luis Parra</td>
								<td><button class="btn btn-danger">PDF</button></td>
								<td><button class="btn btn-primary">Nuevo</button></td>
							</tr>
							<tr>
								<td>Julio Gonzales</td>
								<td>001 - coleccion 004 - marca donato - modelo ddn089</td>
								<td>Baja</td>
								<td>20/08/2018</td>
								<td>2</td>
								<td>Luis Enrique Salas</td>
								<td><button class="btn btn-danger">PDF</button></td>
								<td><button class="btn btn-primary">Nuevo</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection