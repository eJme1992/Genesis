<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form_edit_dir" method="POST">
				{{ method_field('PATCH') }}
				{{ csrf_field() }}
				<div class="panel panel-warning">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Editar Direccion</h3>
					</div>
					<div class="modal-body text-left">

							<div class="form-group col-sm-12">
								<label for="">Departamento </label>
								<select class="form-control" name="departamento_id" required="" id="dep">
									<option value="">seleccione</option>
									@foreach($departamentos as $d)
									<option value="{{ $d->id }}">{{ $d->departamento }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-12">
								<label for="">Provincia </label>
								<select class="form-control" name="provincia_id" required="" id="prov">
									<option value="">seleccione</option>
									@foreach($provincias as $d)
									<option value="{{ $d->id }}">{{ $d->provincia }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-12">
								<label for="">Distrito </label>
								<select class="form-control" name="distrito_id" id="dist">
									<option value="">seleccione</option>
									@foreach($distritos as $d)
									<option value="{{ $d->id }}">{{ $d->distrito }}</option>
									@endforeach
								</select>
							</div>
							
							<div class="form-group col-sm-12">
								<label for="">Detalle </label>
								<input type="text" name="detalle" id="detalle" class="form-control text-uppercase" pattern="[A-Z a-z]+" title="Indique solo letras sin guiones ni puntos" placeholder="Especifique un detalle">
							</div>

							<div class="form-group col-sm-12">
								<label for="">Tipo </label>
								<select class="form-control" name="tipo" required="" id="tipo">
									<option value="ORIGEN">Origen</option>
									<option value="DESTINO">Destino</option>
								</select>
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
