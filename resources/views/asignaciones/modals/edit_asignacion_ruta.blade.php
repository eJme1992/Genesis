<form id="form_edit_asig_ruta" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="modal fade" tabindex="-1" role="dialog" id="edit_ar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-warning">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3>
							<i class="fa fa-car"></i> <i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
					 		Editar Asignacion Ruta - Vendedor
						</h3>
					</div>
					<div class="panel-body">
						<div class="form-group col-sm-12">
							<label for="">Usuario [Vendedor]</label>
							<select class="form-control" name="user_id" required="" id="user_id">
								@foreach($users as $u)
								<option value="{{ $u->id }}">
									{{ $u->name }}
								</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group col-sm-12">
							<label for="">Motivo de viaje </label>
							<select class="form-control" name="motivo_viaje_id" required="" id="motivo_viaje_id">
								@foreach($motivo as $m)
								<option value="{{ $m->id }}">{{ $m->nombre }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-sm-12">
							<label for="">Direccion [<em>Dep|Prov|Dist|Detalle</em>]</label>
							<button type="button" data-toggle="modal" data-target="#modal_create" aria-expanded="false" aria-controls="modal_create" class="btn btn-link btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i> Nueva direccion
							</button>
							<select class="form-control dir_asig" name="direccion_id" required="" id="direccion_id">
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
								<button type="submit" class="btn btn-warning">
									<i class="fa fa-save"></i> Actualizar
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>