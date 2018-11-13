<div class="modal fade" tabindex="-1" role="dialog" id="modal_rol">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form id="form_rol">
				<div class="panel panel-primary">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3>Cambio de Rol(Perfil)</h3>
					</div>
				 
					<div class="modal-body text-left">
							<p class="texto_negro text-center">
								Actualmente <b><span class="text-info text-capitalize" id="name_rol"></span></b>
								<span id="reload" style="display:none"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
							</p>
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							<input type="hidden" id="id_user" name="id">
							<div class="form-group">
								<label for="">Roles</label>
								<select name="rol_id" class="form-control" required>
									<option value="">Seleccione un rol</option>
									@foreach($roles as $rol)
									<option value="{{ $rol->id }}">{{ $rol->name }}</option>
									@endforeach
								</select>
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success btn_rol">
							Actualizar
						</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>