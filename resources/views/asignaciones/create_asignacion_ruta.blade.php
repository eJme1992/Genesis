@extends('layouts.app')
@section('title','Asignacion - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
			<form class="" action="{{ route('asignacion_rutas.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="col-sm-12">
					<h3 class="label-success padding_1em"><i class="fa fa-car"></i> <i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
					 	Nueva Ruta
					</h3>
				</div>

				<div class="form-group col-sm-4">
					<label for="">Usuario [Vendedor]</label>
					<select class="form-control" name="user_id" required="">
						@foreach($users as $u)
						<option value="{{ $u->id }}">
							{{ $u->name }}
						</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-group col-sm-4">
					<label for="">Motivo de viaje </label>
					<select class="form-control" name="motivo_viaje_id" required="">
						@foreach($motivo as $m)
						<option value="{{ $m->id }}">{{ $m->nombre }}</option>
						@endforeach
					</select>
					<hr>
				</div>

				<div class="form-group col-sm-4">
					<label for="">Direcciones [<em>Dep|Prov|Dist|Detalle</em>]</label>
					<select class="form-control" name="direccion_id" required="">
						@foreach($direcciones as $m)
						@php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
						<option value="{{ $m->id }}">
							{{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
						</option>
						@endforeach
					</select>
				</div>

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

				<div class="form-group text-right col-sm-12">
			        	<a class="btn btn-flat btn-default" href="{{route('asignaciones.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-success" type="submit">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</form>
			</div>
		</div>

@endsection
