@extends('layouts.app')
@section('title','Coleccion - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<form class="" action="{{ route('colecciones.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}

					<div class="col-sm-12">
						<h3 class="label-success padding_1em">Coleccion</h3>
					</div>

					<div class="form-group col-sm-3">
						<label for="">Nombre </label>
						<input type="text" class="form-control" name="name" required="">
					</div>

					<div class="form-group col-sm-3">
						<label for="">Fecha </label>
						<input type="text" class="form-control fecha" name="fecha_coleccion" required="">
					</div>

					<div class="form-group col-sm-3">
						<label for="">Cod Coleccion </label>
						<input type="text" name="codigo" value="{{ $col }}" class="form-control" readonly="">
					</div>

					<div class="form-group col-sm-3">
						<label for="">
							Proveedor <button class="btn btn-sm btn-primary" id="btn_prov"><i class="fa fa-plus"></i></button>  
						</label>
						<select name="proveedor_id" class="form-control" required="">
							<option value="">Seleccione</option>
							@foreach($proveedores as $prov)
							<option value="{{ $prov->id }}">{{ $prov->nombre }} / {{ $prov->empresa }}</option>
							@endforeach
						</select>
					</div>	
					
					<hr>

					<div class="form-group col-sm-3">
						<label for="">
							Marca <button class="btn btn-sm btn-primary" id="btn_marca"><i class="fa fa-plus"></i></button>  
						</label>
						<select name="proveedor_id" class="form-control" required="">
							<option value="">Seleccione</option>
							@foreach($marcas as $m)
							<option value="{{ $m->id }}">{{ $m->name }}</option>
							@endforeach
						</select>
					</div>	

					<div class="form-group col-sm-3">
						<label for="">Ruedas</label>
						<select name="ruedas" class="form-control" required="">
							@for($r = 1; $r < 51; $r++)
							<option value="{{ $r }}">{{ $r }}</option>
							@endfor
						</select>
					</div>	

					@if (count($errors) > 0)
					<div class="col-sm-12">	
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        </div> 
			        @endif

					<div class="form-group text-right col-sm-12">
						<button class="btn btn-success" type="submit">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</form>
			</div>
		</div>
@endsection
