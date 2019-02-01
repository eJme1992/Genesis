@extends('layouts.app')
@section('title','Usuario - '.config('app.name'))
@section('header','Usuario')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Usuarios </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
	<section>
    <a class="btn btn-flat btn-default" href="{{ route('users.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-flat btn-warning" href="{{ route('users.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
    @if(Auth::user()->usuario <> "admin")
    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
    @endif
	</section>

	<section class="box box-danger box-solid padding_1em">
		<div class="row">
    	<div class="col-md-12 ">
    		<h2 class="page-header text-capitalize" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ $user->usuario }}
          <small class="pull-right">Registrado: {{ $user->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
    	</div>
			<div class="col-sm-6">
				<h4>Detalles del Usuario</h4>
        <p><b>Nombre y Apellido: </b> {{$user->name}} {{$user->ape}} </p>
        <p><b>Identificacion: </b> {{$user->documento}} {{$user->identificacion}} </p>
        <p><b>RUC: </b> {{$user->ruc}} </p>
        <p><b>Sexo: </b> {{$user->sexo}} </p>
        <p><b>Direccion: </b> {{$user->direccion}} </p>
        <p><b>Correo: </b> {{$user->correo}} </p>
        <p><b>Telefonos(Casa/Movil): </b> {{$user->telefono_casa}} / {{$user->telefono_movil}} </p>
        <p><b>Cargo: </b> {{$user->cargo}} </p>
        <p><b>Rol: </b> {{$user->rol->name}} </p>
			</div>

      <div class="col-sm-6">
        @if($user->foto)
          <img src="{{ url('images/'."$user->id.$user->foto") }}" 
          class="img-circle center-block img-responsive" width="200">
        @else
          <img src="{{ asset('img/sin_imagen.jpg') }}" alt="imagen" class="img-circle center-block img-responsive" width="200">
        @endif
      </div>
		
		</div>
	</section>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('users.destroy',[$user->id])}}" method="POST">
              {{ method_field( 'DELETE' ) }}
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar este usuario?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection