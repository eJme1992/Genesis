<div class="modal fade" tabindex="-1" role="dialog" id="modal_upd">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="form_upd_modelos">
				<div class="panel panel-primary">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-trash"></i> Actualizar Modelo(s)
							<span id="em2" style="display:none;" class="text-center">
	                <i class="fa fa-refresh fa-pulse fa-fw"></i>
	            </span>
						</h3>
					</div>
					<div class="modal-body text-left">
						<div class="panel-body">
						<input type="hidden" id="id_col_upd" name="col_upd">
						<input type="hidden" id="id_mar_upd" name="mar_upd">
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							<div class="list-group">
								<h3 class="text-capitalize text-center" id="nombre_de_la_marca2"></h3>
								<div id="dataM"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-warning btn-sm btn_actualizar_modelos">
								<i class="fa fa-trash"></i> Actualizar Modelo(s)
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
