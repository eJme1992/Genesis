@extends('layouts.app')
@section('title','Clientes - '.config('app.name'))
@section('header','Clientes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Clientes </li>
	</ol>
@endsection
@section('content')

	@include('partials.flash')
	
	<div class="row">

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
	  	
	  	<div class="col-md-4 col-sm-4 col-xs-12">
		  	<div class="info-box">
		    	<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
		   		<div class="info-box-content">
		      		<span class="info-box-text">Clientes</span>
		      		<span class="info-box-number">{{ count($clientes) }}</span>
		    	</div>
		  	</div>
		</div>

		<div class="col-sm-12 col-xs-12">
			<div class="box box-danger box-solid">
		  		<div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-users"></i> Clientes</h3>
			        <span class="pull-right">
			        	<button type="button" data-toggle="modal" data-target="#create" aria-expanded="false" aria-controls="modal_create" class="btn btn-danger btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i> Nuevo cliente
						</button>
			        </span>
			    </div>
					<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Nombre completo</th>
								<th class="text-center">Identificacion</th>
								<th class="text-center">RUC</th>
								<th class="text-center">Sexo</th>
								<th class="text-center">Telefono</th>
								<th class="text-center">Correo</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($clientes as $d)
								<tr>
									<td class="text-capitalize">{{ $d->name.' '.$d->ape }}</td>
									<td>{{ $d->documento.' '.$d->identificacion }}</td>
									<td>{{ $d->ruc }}</td>
									<td>{{ $d->sexo }}</td>
									<td>{{ $d->telefono }}</td>
									<td>{{ $d->correo }}</td>
									<td>
										<span class="col-sm-6">	
											<button type="button" id="btn" value="{{ $d->id }}"
												data-toggle="modal" data-target="#edit"
												aria-expanded="false" aria-controls="edit"
												class="btn btn-warning btn-sm" onclick="MostrarCliente(this);">
													<span class="">
														<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
													</span>
											</button>
										</span>
										<span class="col-sm-6">
											<form action="{{ route('clientes.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Desea eliminar el cliente con todas sus dependencias S/N?');"><i class="fa fa-trash"></i></button>
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
	@include("clientes.modals.createclientes")
	@include("clientes.modals.editclientes")
	
@endsection
@section("script")
<script>

	// cargar clientes
	function MostrarCliente(btn){
		  	ruta = '{{ route("clientes.edit",":btn.value") }}';
		  	url = ruta.replace(':btn.value', btn.value);

		    $("#re").fadeIn('slow/400/fast');
		  	
		  	$.get(url, function(res){
			    action = '{{ route("clientes.update",":res.id") }}'; 
			    action = action.replace(':res.id', res.id);
		    	$("#form_edit_cliente").attr("action", action);

		    	$("#name").val(res.name);
		    	$("#ape").val(res.ape);
		    	$("#ape").val(res.ape);
		    	$("#documento").val(res.documento).attr("selected",true);
		    	$("#sexo").val(res.sexo).attr("selected",true);
		    	$("#identificacion").val(res.identificacion);
		    	$("#ruc").val(res.ruc);
		    	$("#telefono").val(res.telefono);
		    	$("#correo").val(res.correo);
		  	});

		  	$("#re").fadeOut('slow/400/fast');
	}
</script>
@endsection