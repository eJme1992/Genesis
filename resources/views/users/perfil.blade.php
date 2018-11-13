@extends('layouts.app')

@section('title','Perfil - '.config('app.name'))
@section('header','Perfil')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Perfil </li>
	</ol>
@endsection
@section('content')
	<section class="perfil">
		<div class="row">
			<div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{$perfil->name}}
        </h2>

			  <form action="{{route('update_perfil')}}" method="POST">
				  {{method_field('PATCH')}}
				  {{csrf_field()}}
					@include('partials.flash')
				  <div class="form-group col-md-4 col-md-offset-4 {{$errors->has('name')?'has-error':''}}">
				    <label for="name">Nombre: *</label>
				    <input type="text" class="form-control" name="name"  value="{{$perfil->name}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4 {{$errors->has('usuario')?'has-error':''}}">
				    <label for="email">Usuario: *</label>
				    <input type="text" class="form-control" name="usuario" value="{{$perfil->usuario}}" required>
				  </div>

				  <div class="col-md-4 col-md-offset-4">
				  	<div class="checkbox">
					    <label>
					      <input id="pp" type="checkbox" name="checkbox" value="Yes"> Cambiar contraseña?
					    </label>
				    </div>
				  </div>
				  
				  <section id="password_fields" style="display:none">
					  <div class="form-group col-md-4 col-md-offset-4">
					  	<label>Contraseña nueva: *</label>
					  	<input id="password" class="form-control" type="password" name="password">
					  </div>
					  <div class=" form-group col-md-4 col-md-offset-4">
					  	<label>Verificar: *</label>
					  	<input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
					  </div>
				  </section>

					@if (count($errors) > 0)
					<div class="col-md-12">
						<div class="col-md-4 col-md-offset-4">
			          		<div class="alert alert-danger">
				          		<ul>
						            @foreach($errors->all() as $error)
						              <li>{{$error}}</li>
						            @endforeach
				          		</ul>  
			          		</div>
			          	</div>
			        </div>
			        @endif

				  <div class="col-md-4 col-md-offset-4">
				    <button class="btn btn-flat btn-success" type="submit">Actualizar</button>
				  </div>
			  </form>
      </div>
		</div>
	</section>
@endsection

@section('script')
 	<script type="text/javascript">
 	$(document).ready(function(){
 			$("#pp").click(function(event) {
	 		var bool = this.checked;
	 		if(bool === true){
	 			$("#password_fields").show();
	 			$("#password,#password_confirmation").prop('required',true);
	 		}else{
	 			$("#password_fields").hide();
	 			$("#password,#password_confirmation").prop('required',false).val('');
	 		}
	 	});
 	});
 	</script>
@endsection