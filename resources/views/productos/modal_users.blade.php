<div class="modal fade" tabindex="-1" role="dialog" id="users">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('asignaciones.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-success">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Asignacion</h3>
					</div>
					<div class="modal-body text-left">
						<div class="form-group">
							<input type="hidden" id="p_id" name="producto_id">
							<label for="">Usuarios (* Vendedores)</label>
							<span id="re" style="display:none">
								<i class="fa fa-spinner fa-pulse fa-fw"></i>
							</span>
							<select name="user_id" id="" class="form-control" required="" id="select_users">
								<option value="">Seleccione</option>
								@foreach($users as $m)
								<option value="{{ $m->id }}">{{ $m->name }} {{ $m->ape }} - ({{ $m->usuario }})</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-save"></i> Asignar
						</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>