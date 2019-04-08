<div class="modal fade" tabindex="-1" role="dialog" id="cm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="panel panel-primary">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Añadir marca</h3>
					</div>
					<div class="modal-body text-left">
						<div class="panel-body">
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							<div class="form-group col-sm-12">
								<label for="">Nombre de la marca</label>
								<select name="marca_id" id="marca_id" class="form-control marca_id">
									@foreach($m as $mar)
									<option value="{{ $mar->id }}">{{ $mar->name }} | ({{ $mar->material->name }})</option>
									@endforeach
								</select>
							</div>
	            <div class='form-group col-sm-12'>
	              <label>Ruedas</label>
	              <select name='rueda' class='form-control' required='' id="ru">
	                @for($r = 1; $r < 21; $r++)
	                <option value='{{ $r }}'>{{ $r }}</option>
	                @endfor
	              </select>
	            </div>
						</div>
					</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="button" class="btn btn-primary btn_acm">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
				</div>
		</div>
	</div>
</div>
