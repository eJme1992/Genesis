<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form_edit" action="{{ route('editMarcaSave') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-warning">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Editar Marca</h3>
					</div>
					<div class="modal-body text-left">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						<input type="hidden" id="id_marca" name="id">
						<div class="form-group">
							<label for="">
								Nombre de la marca
								<span id="re" style="display:none;">
									<i class="fa fa-refresh fa-pulse fa-fw text-primary"></i>
								</span>
							</label>
							<input type="text" class="form-control text-capitalize" name="name" placeholder="Nombre...." id="name_marca" pattern="[A-Z a-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z" required="">
						</div>
						<div class="form-group">
							<label for="">Material </label>
							<select class="form-control" name="material_id" required="" id="material_id">
								<option value="">seleccione</option>
								@foreach($materiales as $mat)
								<option value="{{ $mat->id }}">{{ $mat->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="">Estuches</label>
							<select class="form-control" name="estuche" required id="marca_estuche">
								<option value="1">SI</option>
								<option value="0">NO</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Observacion</label>
							<textarea name="observacion" id="observacion_marca" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success btn_edit_marca">
							<i class="fa fa-save"></i> Actualizar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
