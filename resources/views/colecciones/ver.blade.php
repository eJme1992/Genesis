@extends('layouts.app')
@section('title','Listado de colecciones - '.config('app.name'))
@section('header','Listado de colecciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Listado de colecciones </li>
	</ol>
@endsection
@section('content')
@include('partials.flash')
<style type="text/css">
	.icon_color:hover{
		color: #35C96B;
	}
</style>
<div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-table"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Colecciones</span>
          <span class="info-box-number">{{ count($colecciones) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div><!--row-->
<div class="row">
<div class="col-sm-12 col-xs-12">
	<div class="box box-danger box-solid">
  		<div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-database"></i> Listado de colecciones</h3>
	        <span class="pull-right">
	        	<a href="{{ route('colecciones.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Nuevo</a>
	        </span>
	    </div>
			<div class="box-body">
			<table class="table data-table table-bordered table-hover">
				<thead class="label-danger">
					<tr>
						<th class="text-center">Codigo</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Fecha de coleccion</th>
						<th class="text-center">Marcas</th>
						<th class="text-center">Precio almacen / Precio establecido</th>
						<th class="text-center">Modelos</th>
						<th class="text-center">Proveedor</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($colecciones as $d)
						<tr>
							<td>000{{ $d->id }}</td>
							<td>{{ $d->name }}</td>
							<td>{{ $d->fecha_coleccion }}</td>
							<td class="text-left">
								@forelse($d->cm as $m)
									<i class="fa fa-arrow-right"></i>
									<span class="text-capitalize">
										{{ $m->marca->name.' - ['.$m->marca->material->name.']' }} 
									</span>
									<br>
								@empty
									<em class="text-warning">No posee marcas asignadas</em>
								@endforelse
							</td>
							<td>
								@foreach($d->cm as $m)
									@if($m->precio_almacen)
										<i class="fa fa-arrow-right"></i>
										<span>
											{{ 'S/'.$m->precio_almacen.' | S/'.$m->precio_venta_establecido }} 
										</span>
										<br>
									@else
										No asignado
										<span data-toggle="tooltip" title="Añadir precios">
											<a href="#precio" data-toggle="modal" data-target="#precio" class="btn-link btn-sm btn_precio" id="{{$d->id}}" value="{{$m->marca_id}}">
												<i class="fa fa-plus-circle text-success icon_color"></i> añadir
											</a>
										</span>
										<br>
									@endif	
								@endforeach
							</td>
							<td>
								{{ $d->modelos($d->id)->count() }}
								<span class="">
									<a href="{{ route('colecciones.show',[$d->id]) }}" class="btn btn-default"
										data-toggle="tooltip" data-placement="top" title="Añadir mas modelos">
										<i class="fa fa-plus-circle"></i>
									</a>
								</span>
							</td>
							<td>{{ $d->proveedor->nombre }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@include("colecciones.modals.precio")
@endsection
@section("script")
<script>
	$(".btn_precio").click(function(event) {
		$("#col").val($(this).attr("id"));
		$("#mar").val($(this).attr("value"));
	});
</script>
@endsection
