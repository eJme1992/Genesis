<form id="form_cliente_save" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="modal fade" tabindex="-1" role="dialog" id="create_cliente">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> Crear Cliente</h3>
					</div>
					<div class="panel-body">

						<div class="form-group col-sm-6">
							<label>Tipo de identificacion *</label>
							<select name="tipo_id" class="form-control" required="">
								<option value="DNI">DNI</option>
								<option value="PASAPORTE">PASAPORTE</option>
								<option value="CARNET DE EXTRANGERIA">CARNET DE EXTRANGERIA</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label>Identificacion *</label>
							<input type="text" name="identificacion" class="form-control int" placeholder="indique Nº de identificacion..." required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Primer nombre *</label>
							<input type="text" class="form-control text-uppercase" name="nombre_1" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Segundo nombre </label>
							<input type="text" class="form-control text-uppercase" name="nombre_2" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos">
						</div>

						<div class="form-group col-sm-6">
							<label>Primer apellido *</label>
							<input type="text" class="form-control text-uppercase" name="ape_1" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Segundo apellido </label>
							<input type="text" class="form-control text-uppercase" name="ape_2" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos">
						</div>

						<div class="form-group col-sm-12">
							<label>Domicilio fiscal *</label>
							<textarea class="form-control" name="direccion" required=""></textarea>
						</div>

						<div class="form-group col-sm-12">
							<label>Correo </label>
							<input type="email" name="correo" class="form-control">
						</div>

						<div class="form-group col-sm-6">
							<label>Telefono local </label>
							<span>01</span>
							<input type="text" name="telefono_1" class="form-control int" placeholder="indique telefono de su casa (7 digitos)..." maxlength="7">
						</div>

						<div class="form-group col-sm-6">
							<label>Telefono movil *</label>
							<span>+51</span>
							<input type="text" name="telefono_2" class="form-control int" placeholder="indique telefono movil (9 digitos)..." required="" maxlength="9">
						</div>

					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-success btn_create_cliente">
								<i class="fa fa-save"></i> Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>