<form id="form_edit_cliente" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{ method_field('PATCH') }}
	<div class="modal fade" tabindex="-1" role="dialog" id="edit">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-warning">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> Editar Cliente</h3>
					</div>
					<div class="panel-body">

						<div class="form-group col-sm-6">
							<label>Nombre </label>
							<input type="text" class="form-control text-uppercase" name="name" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="" id="name">
						</div>

						<div class="form-group col-sm-6">
							<label>Apellido </label>
							<input type="text" class="form-control text-uppercase" name="ape" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="" id="ape">
						</div>

						<div class="form-group col-sm-6">
							<label>Documento </label>
							<select name="documento" class="form-control" required="" id="documento">
								<option value="DNI">DNI</option>
								<option value="PASAPORTE">PASAPORTE</option>
								<option value="CARNET DE EXTRANGERIA">CARNET DE EXTRANGERIA</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label>Identificacion </label>
							<input type="text" name="identificacion" class="form-control int" placeholder="indique Nº de identificacion..." required="" id="identificacion">
						</div>

						<div class="form-group col-sm-6">
							<label>RUC </label>
							<input type="text" name="ruc" class="form-control int" placeholder="Registro unico de constribuyentes..." id="ruc">
						</div>

						<div class="form-group col-sm-6">
							<label>Telefono </label> <span>+51</span>
							<input type="text" name="telefono" class="form-control int" maxlength="9" id="telefono">
						</div>

						<div class="form-group col-sm-6">
							<label>Correo </label>
							<input type="email" name="correo" class="form-control" id="correo">
						</div>

						<div class="form-group col-sm-6">
							<label>Sexo </label>
							<select name="sexo" class="form-control" required="" id="sexo">
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
						</div>

					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-warning">
								<i class="fa fa-save"></i> Actualizar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>