<div class="modal fade" tabindex="-1" role="dialog" id="create">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="row">
			<div class="col-sm-12 fondo_form">
			<form class="" action="{{ route('asignacion_rutas.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="col-sm-12">
					<h3 class="label-success padding_1em"><i class="fa fa-car"></i> <i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
					 	Nueva Asignacion Ruta - Vendedor
					</h3>
				</div>

				<div class="form-group col-sm-12">
					<label for="">Usuario [Vendedor]</label>
					<select class="form-control" name="user_id" required="">
						@foreach($users as $u)
						<option value="{{ $u->id }}">
							{{ $u->name }}
						</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-group col-sm-12">
					<label for="">Motivo de viaje </label>
					<select class="form-control" name="motivo_viaje_id" required="">
						@foreach($motivo as $m)
						<option value="{{ $m->id }}">{{ $m->nombre }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-sm-12">
					<label for="">Direccion [<em>Dep|Prov|Dist|Detalle</em>]</label>
					<select class="form-control" name="direccion_id" required="">
						@foreach($direcciones as $m)
						@php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
						<option value="{{ $m->id }}">
							{{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
