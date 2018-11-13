@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Usuarios </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<div class="alert alert-success" style="display:none" id="msj_alert_done">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong class="text-center">Actualizado con exito!</strong>
		<span><i class="fa fa-refresh fa-pulse fa-fw"></i></span>
	</div>
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Usuarios</span>
          <span class="info-box-number">{{ count($users) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
	        <span class="pull-right">
						<a href="{{ route('users.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead class="label-success">
							<tr>
								<th class="text-center">Nombre y apellido</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Rol</th>
								<th class="text-center">Status</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($users as $d)
								<tr>
									<td>{{$d->name}} {{$d->ape}}</td>
									<td>{{$d->usuario}}</td>
									<td class="success">
										<span>{{$d->rol->name}}</span>
										@if($d->usuario != "admin")
										<span class="pull-right">
											<button type="button" id="btn_rol" value="{{ $d->id }}"
											data-toggle="modal" data-target="#modal_rol" 
											aria-expanded="false" aria-controls="modal_rol" 
											class="btn btn-default" onclick="MostrarRol(this);">
												<span class="">
													<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
												</span>	
											</button>
										</span>
										@endif
									</td>
									<td @if($d->status == 'activo') class="label-primary text-capitalize" @else class="label-danger text-capitalize" @endif>
										<span>{{$d->status}}</span>
										@if($d->usuario != "admin")
										<form action="{{ url('userStatus/'.$d->id)}}" method="POST" class="pull-right">
											{{ method_field( 'PUT' ) }}
											{{ csrf_field() }}
											<span class="pull-right">
												<button class="btn btn-default" type="submit" onclick="return confirm('Desea cambiar el status S/N?');">
													<i class="fa fa-edit"></i>	
												</button>
											</span>
										</form>
										@endif
									</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('users.show',[$d->id])}}"><i class="fa fa-search"></i></a>
										<a href="{{route('users.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('partials.modal_rol')

@endsection
@section('script')
	<script>
		// buscar status del usuario
		function MostrarRol(btn_rol){
		  var ruta = "users_rol/"+btn_rol.value;
		  $("#reload").fadeIn('slow/400/fast');
		  $.get(ruta, function(res){
		    if (res.rol_id == 1) {
		    	$("#name_rol").text("Admin");
		    }else if(res.rol_id == 2){
		    	$("#name_rol").text("Usuario");
		    }else if(res.rol_id == 3){
		    	$("#name_rol").text("Permiso Especial");
		    }
		    $("#id_user").val(res.id);
		  });
		  $("#reload").fadeOut('slow/400/fast');
		}

		// actualizar status
		$('#form_rol').on("submit", function(ev) {
		  ev.preventDefault();
		  var form = $(this);
		  var ruta = "update_rol/"+$("#id_user").val();
		  var btn = $('.btn_rol');
		  btn.text('Espere...');
		  
		  $.ajax({
		    url: ruta,
		    headers: {'X-CSRF-TOKEN': $("#token").val()},
		    type: 'PUT',
		    dataType: 'JSON',
		    data: form.serialize(),
		  })
		  .done(function() {
		    $("#modal_rol").modal('toggle');
		    $("#msj_alert_done").fadeIn('slow/400/fast').fadeOut(5000);
		    location.reload(2000);
		  })
		  .fail(function(msj) {
		      $("#modal_rol").modal('toggle');
		      btn.text('Actualizar');
		  })
		});
	</script>
@endsection		