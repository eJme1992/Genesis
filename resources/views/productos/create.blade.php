@extends('layouts.app')
@section('title','Producto (Caja) - '.config('app.name'))
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12 fondo_form">
				<form class="" action="{{ route('modelos.store') }}" method="POST">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					
					<input type="hidden" name="coleccion_id" value="{{ $data->id }}">
					@foreach($data->marcas as $m)
					<input type="hidden" name="marca_id[]" value="{{ $m->id }}">
					@endforeach
					<section style="padding: 2em;">
					
						<div class="col-sm-12">
							<h3 class="label-primary padding_1em">
								Coleccion
							</h3>
						</div>
						

						<div class="form-group col-sm-1">
							<label for="">Codigo </label>
							<input type="text" class="form-control" value="{{ $data->codigo }}" readonly="">
						</div>

						<div class="form-group col-sm-3">
							<label for="">Coleccion </label>
							<input type="text" class="form-control" value="{{ $data->name }}" readonly="">
						</div>

						<div class="form-group col-sm-8">
							<label for="">Marca(s) </label>
							<div class="col-sm-12 list-group">
								@foreach($data->marcas as $m)
								<span class="text-capitalize list-group-item list-group-item-info col-sm-3">{{ $m->name }}</span>
								@endforeach
							</div>
						</div>

						<div class="col-sm-12">
							<h3 class="label-primary padding_1em">
								Nueva Modelo (Caja)
							</h3>
						</div>

							@for($i = 1; $i < count($data->marcas) + 1; $i++)

								@foreach($ruedas as $rue)
								<section class="row" style="margin:1em;">
									<div class="col-sm-12 bg-info" style="padding: 1em">
									@for($i = 1; $i < $rue + 1; $i++)
									<div class="form-group col-sm-4">
										<label class="control-label" for="name">Nombre modelo: *</label>
										<input type="text" name="name[$data->marcas->name]" class="form-control" required="">
									</div>

									<div class="form-group col-sm-2">
										<label class="control-label">Cantidad Monturas: *</label>
										<select name="montura[]" class="form-control" required="">
											@for($m = 0; $m < 13; $m++)
												<option value="{{$m}}" @if($m == 12) selected @endif>{{$m}}</option>
											@endfor
										</select>
									</div>

									<div class="form-group col-sm-6">
										<label for="">Descripcion </label>
										<textarea name="descripcion_modelo[]" class="form-control"></textarea>
									</div>
									@endfor
									</div>
								</section>
								<br>
								@endforeach
							@endfor

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
							<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
						</div>
						
				</form>
			</div>
		</div>
@endsection
