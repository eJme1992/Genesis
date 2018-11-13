<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form id="form_edit" action="{{ route('editMarcaSave') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-warning">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Editar Modelo</h3>
					</div>
					<div class="modal-body text-left">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						<input type="hidden" id="id_modelo" name="id">
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
							<input type="text" class="form-control" name="codigo" placeholder="Codigo...." required="" id="cod_mod">
						</div>
						<div class="form-group">
							<label for="">Nombre del modelo</label>
							<input type="text" class="form-control text-capitalize" name="name" placeholder="Nombre...." required="" id="nom_mod">
						</div>
						<div class="form-group">
							<label for="">Cantidad de Monturas</label>
							<select name="c_montura" class="form-control" required="">
							<option value="">Seleccione</option>
							@for($i = 0; $i <= 12; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
							@endfor
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