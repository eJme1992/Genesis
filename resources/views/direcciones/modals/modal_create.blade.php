<form class="form_create_direccion" action="{{ route('direcciones.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_create">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> Crear Direccion</h3>
					</div>
					<div class="panel-body">
							<div class="form-group col-sm-12">
								<label for="">Departamento </label>
								<select class="form-control dep" name="departamento_id" required="">
									<option>Seleccione</option>
									@foreach($departamentos as $d)
									<option value="{{ $d->id }}">{{ $d->departamento }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-12">
								<label for="">Provincia </label>
								<select class="form-control prov" name="provincia_id" required="">
								</select>
							</div>

							<div class="form-group col-sm-12">
								<label for="">Distrito </label>
								<select class="form-control dist" name="distrito_id">
								</select>
							</div>

							<div class="form-group col-sm-12">
								<label for="">Detalle </label>
								<input type="text" class="form-control text-uppercase" name="detalle" placeholder="Especifique un detalle">
							</div>

							<div class="form-group col-sm-12">
								<label for="">Tipo </label>
								<select class="form-control" name="tipo" required="">
									<option value="00">Origen</option>
									<option value="01">Destino</option>
								</select>
							</div>
					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-success btn_create_direccion">
								<i class="fa fa-save"></i> Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>