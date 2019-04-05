<div class="modal fade" tabindex="-1" role="dialog" id="modal_marca">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form_rol" action="{{ route('marcas.store') }}" method="POST">
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="panel panel-success">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Nueva Marca</h3>
					</div>
					<div class="modal-body text-left">
						<div class="form-group">
							<label for="">Nombre de la marca</label>
							<input type="text" class="form-control" name="name" placeholder="Nombre...." required="" pattern="[A-Z a-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z" id="marca_name">
						</div>
						<div class="form-group">
							<label for="">Material</label>
							<select class="form-control" name="material_id" required id="marca_material_id">
								<option value="">Seleccione</option>
								@foreach($materiales as $m)
								<option value="{{ $m->id }}">{{ $m->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="">Estuches</label>
							<select class="form-control" name="estuche" required id="estuche">
								<option value="1">SI</option>
								<option value="0">NO</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Observacion (opcional)</label>
							<textarea name="observacion" class="form-control" id="marca_observacion"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success btn_cm">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
