<div class="modal fade" tabindex="-1" role="dialog" id="cp">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="panel panel-danger">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Nuevo Proveedor</h3>
					</div>
					<div class="modal-body text-left">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						<div class="col-sm-12">
							<h3 class="label-danger padding_1em"><i class="fa fa-user"></i> Representante</h3>
						</div>
					<div class="form-group col-sm-4 {{ $errors->has('nombre')?'has-error':'' }}">
						<label class="control-label" for="name">Nombre completo: *</label>
						<input id="nombre_pro" class="form-control" type="text" name="nombre_pro" placeholder="Nombre" required="" pattern="[A-Z a-z]+" data-validation-pattern-message="debe ingresar solo letras de la a-z">
					</div>

					<div class="form-group col-sm-4 {{ $errors->has('telefono')?'has-error':'' }}">
						<label class="control-label" for="telefono">Telefono: * <span>+51</span></label>
						<input id="telefono" class="form-control int" type="text" name="telefono" placeholder="telefono" maxlength="9" required>
					</div>

					<div class="form-group col-sm-4 {{ $errors->has('correo')?'has-error':'' }}">
						<label class="control-label" for="correo">Correo: *</label>
						<input type="email" name="correo" class="form-control" placeholder="correo..." id="correo" required>
					</div>
					
					<hr>
					
					<div class="col-sm-12">
						<h3 class="label-danger padding_1em"><i class="fa fa-industry"></i> Empresa</h3>
					</div>

					<div class="form-group col-sm-6 {{ $errors->has('empresa')?'has-error':'' }}">
						<label class="control-label" for="foto">Empresa: *</label>
						<input type="text" name="empresa" class="form-control" placeholder="nombre empresa..." id="empresa" required>
					</div>

					<div class="form-group col-sm-6 {{ $errors->has('ruc')?'has-error':'' }}">
						<label class="control-label" for="email">RUC: *</label>
						<input class="form-control int" type="text" name="ruc" placeholder="ruc..." id="ruc" required>
					</div>

					<div class="form-group col-sm-12 {{ $errors->has('direccion')?'has-error':'' }}">
						<label class="control-label" for="password">Direccion: *</label>
						<textarea name="direccion" class="form-control"  id="direccion"></textarea>
					</div>

					<div class="form-group col-sm-12 {{ $errors->has('observacion')?'has-error':'' }}">
						<label class="control-label" for="password">Observacion: *</label>
						<textarea name="observacion" class="form-control" id="observacion"></textarea>
					</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="button" class="btn btn-success btn_cp">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
		</div>	
	</div>
</div>