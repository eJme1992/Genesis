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
	  	
	  	<div class="col-sm-3 col-xs-12">
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
			        	<button type="button" data-toggle="modal" data-target="#create_cliente"  class="btn btn-danger btn-sm">
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
								<th class="text-center">Direccion fiscal</th>
								<th class="text-center">Correo</th>
								<th class="text-center">Telefonos</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center" id="data_clientes">
							@foreach($clientes as $d)
								<tr>
									<td>{{ $d->nombre_full }}</td>
									<td>{{ $d->tipo_id.' '.$d->identificacion }}</td>
									<td>{{ $d->ruc ? $d->ruc : '-' }}</td>
									<td>{{ $d->dir() }}</td>
									<td>{{ ($d->correo) ? $d->correo : '-' }}</td>
									<td>
										Local: {{ ($d->telefono_1) ? '01'.$d->telefono_1 : 'vacio' }} 
										<br> 
										{{ 'Movil: +51'.$d->telefono_2 }}
									</td>
									<td class="text-nowrap">
										<span class="col-sm-4" data-toggle="tooltip" title="Editar cliente">	
											<a 
											href="#edit" 
											data-toggle="modal" 
											data-target="#edit" 
											data-id="{{ $d->id }}" 
											data-tipo_id="{{ $d->tipo_id }}" 
											data-identificacion="{{ $d->identificacion }}" 
											data-ruc="{{ $d->ruc }}" 
											data-nombre_1="{{ $d->nombre_1 }}"
											data-nombre_2="{{ $d->nombre_2 }}"
											data-ape_1="{{ $d->ape_1 }}"
											data-ape_2="{{ $d->ape_2 }}"
											data-direccion_id="{{ $d->direccion_id }}"
											data-correo="{{ $d->correo }}"
											data-telefono_1="{{ $d->telefono_1 }}"
											data-telefono_2="{{ $d->telefono_2 }}"
											class="btn btn-warning btn-xs btn_editar"											>
												<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
											</a>
										</span>
										<span class="col-sm-4">
											<form action="{{ route('clientes.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Desea eliminar el cliente con todas sus dependencias S/N?');"><i class="fa fa-trash" data-toggle="tooltip" title="Eliminar cliente"></i></button>
											</form>
										</span>

                                        <span class="col-sm-4">
                                            <a href="{{ route('clientes.show', $d->id) }}" class="btn bg-navy btn-xs" data-toggle="tooltip" title="Detalles del cliente desde el comienzo">
                                                <i class="fa fa-eye"></i>
                                            </a>
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
	@include('direcciones.modals.modal_create')
	
@endsection
@section("script")
<script>

	$(".btn_editar").click(function(e) {
		ruta = '{{ route("clientes.update",":btn.value") }}';
		$("#form_edit_cliente").attr("action", ruta.replace(':btn.value', $(this).data("id")));

		$("#tipo_id").val("");
		$("#identificacion").val("");
		$("#ruc").val("");
		$("#nombre_1").val("");
		$("#nombre_2").val("");
		$("#ape_1").val("");
		$("#ape_2").val("");
		$("#direccion_id").removeAttr('selected');
		$("#correo").val("");
		$("#telefono_1").val("");
		$("#telefono_2").val("");

		$("#tipo_id").val($(this).data("tipo_id"));
		$("#identificacion").val($(this).data("identificacion"));
		$("#ruc").val($(this).data("ruc"));
		$("#nombre_1").val($(this).data("nombre_1"));
		$("#nombre_2").val($(this).data("nombre_2"));
		$("#ape_1").val($(this).data("ape_1"));
		$("#ape_2").val($(this).data("ape_2"));
		$("#direccion").val($(this).data("direccion_id")).attr("selected",true);
		$("#correo").val($(this).data("correo"));
		$("#telefono_1").val($(this).data("telefono_1"));
		$("#telefono_2").val($(this).data("telefono_2"));
	});
	
</script>
@endsection