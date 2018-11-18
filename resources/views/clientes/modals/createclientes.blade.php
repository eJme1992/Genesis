<form class="" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="modal fade" tabindex="-1" role="dialog" id="create">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> Crear Cliente</h3>
					</div>
					<div class="panel-body">

						<div class="form-group col-sm-6">
							<label>Nombre </label>
							<input type="text" class="form-control text-uppercase" name="name" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Apellido </label>
							<input type="text" class="form-control text-uppercase" name="ape" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Documento </label>
							<select name="documento" class="form-control" required="">
								<option value="DNI">DNI</option>
								<option value="PASAPORTE">PASAPORTE</option>
								<option value="CARNET DE EXTRANGERIA">CARNET DE EXTRANGERIA</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label>Identificacion </label>
							<input type="text" name="identificacion" class="form-control int" placeholder="indique Nº de identificacion..." required="">
						</div>

						<div class="form-group col-sm-6">
							<label>RUC </label>
							<input type="text" name="ruc" class="form-control int" placeholder="Registro unico de constribuyentes...">
						</div>

						<div class="form-group col-sm-6">
							<label>Telefono </label> <span>+51</span>
							<input type="text" name="telefono" class="form-control int" maxlength="9">
						</div>

						<div class="form-group col-sm-6">
							<label>Correo </label>
							<input type="email" name="correo" class="form-control">
						</div>

						<div class="form-group col-sm-6">
							<label>Sexo </label>
							<select name="sexo" class="form-control" required="">
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
						</div>

					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-save"></i> Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>