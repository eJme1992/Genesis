@extends('layouts.app')
@section('title','Direcciones - '.config('app.name'))
@section('header','Direcciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Direccion </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
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
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>
	        
	        <div class="info-box-content">
	          <span class="info-box-text">Direcciones</span>
	          <span class="info-box-number">{{ count($direcciones) }}</span>
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
			        <span class="pull-right">
						<button type="button" data-toggle="modal" data-target="#modal_create" aria-expanded="false" aria-controls="modal_create" class="btn btn-danger btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i>	Nueva direccion
						</button>
					</span>
			    </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">Departamento</th>
								<th class="text-center">Provincia</th>
								<th class="text-center">Distrito</th>
								<th class="text-center">Detalle</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Fecha</th>
								<th class="text-center" width="100px">Acciones</th>
							</tr>
						</thead>
						<tbody class="text-center" id="data_dir">
							@foreach($direcciones as $d)
								<tr>
									<td>{{ $d->departamento->departamento }}</td>
									<td>{{ $d->provincia->provincia }}</td>
									<td>@if($d->distrito) {{ $d->distrito->distrito }} @endif</td>
									<td>{{ $d->detalle }}</td>
									<td class="@if($d->tipo == 'ORIGEN') info @else success @endif">{{ $d->tipo }}</td>
									<td>{{ $d->fecha }}</td>
									<td>
										<span class="col-sm-6">
											<button type="button" id="btn_dir" value="{{ $d->id }}"
												data-toggle="modal" data-target="#modal_edit"
												aria-expanded="false" aria-controls="modal_edit"
												class="btn btn-warning btn-xs" onclick="MostrarDireccion(this);">
													<span class="">
														<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
													</span>
											</button>
										</span>
										<span class="col-sm-6">
											<form action="{{ route('direcciones.destroy', $d->id) }}" method="POST">
												{{ method_field( 'DELETE' ) }}
		              							{{ csrf_field() }}
		              							<button class="btn btn-xs btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la direccion con todas sus dependencias S/N?');"><i class="fa fa-trash"></i></button>
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
	@include('direcciones.modals.modal_edit')
	@include('direcciones.modals.modal_create')
@endsection
@section("script")
<script>

	// cargar direcciones
	function MostrarDireccion(btn_dir){
		  	var ruta = "edit_dir/"+btn_dir.value;

		    $("#re").fadeIn('slow/400/fast');
		    $(".dep .prov .dist").val("");
		  	
		  	$.get(ruta, function(res){
			    action = '{{ route("direcciones.update",":res.id") }}'; 
			    action = action.replace(':res.id', res.id);
		    	$("#form_edit_dir").attr("action", action);
		    	$(".dep").val(res.departamento_id).attr("selected",true);
		    	$(".prov").val(res.provincia_id).attr("selected",true);
		    	$(".dist").val(res.distrito_id).attr("selected",true);
		    	$("#detalle").val(res.detalle);
		    	$("#tipo").val(res.tipo).attr("selected",true);
		  	});

		  	$("#re").fadeOut('slow/400/fast');
	}

</script>
@endsection