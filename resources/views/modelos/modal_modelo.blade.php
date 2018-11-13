<div class="modal fade" tabindex="-1" role="dialog" id="modal_modelo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form_rol" action="{{ route('modelos.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-success">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Nuevo Modelo</h3>
					</div>
					<div class="modal-body text-left">
						<div class="form-group">
							<label for="">Marcas(*)</label>
							<select name="marca_id" id="" class="form-control" required="">
								<option value="">Seleccione</option>
								@foreach($marcas as $m)
								<option value="{{ $m->id }}">{{ $m->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="">Codigo del Modelo</label>
							<input type="text" class="form-control" name="codigo" placeholder="Codigo...." required="">
						</div>
						<div class="form-group">
							<label for="">Nombre del modelo</label>
							<input type="text" class="form-control text-capitalize" name="name" placeholder="Nombre...." required="">
						</div>
						<!-- <div class="form-group">
							<label for="">Cantidad de Monturas</label>
							<select name="c_monturas" class="form-control" required="">
							<option value="">Seleccione</option>
							@for($i = 0; $i <= 12; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
							@endfor
							</select>
						</div>	 -->
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>