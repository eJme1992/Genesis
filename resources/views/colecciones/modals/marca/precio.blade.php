<form method="POST" id="form_precios" action="{{ route('colecciones.savePrecios') }}">
	{{ csrf_field() }}
	<div class="modal fade" tabindex="-1" role="dialog" id="precio">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3><i class="fa fa-plus"></i> Precios </h3>
					</div>
					<div class="modal-body text-left">
						<div class="panel-body">
							<input type="hidden" name="coleccion" id="col">
							<input type="hidden" name="marca" id="mar">
							<div class="form-group col-sm-12">
								<label>Precio de almacen</label>
								<input type='number' step="0.01" max="999999999999" min="1" name='precio_almacen' class='form-control' required='' id="val_pa">
							</div>
				      <div class='form-group col-sm-12'>
				       	<label>Precio de venta establecido</label>
								<input type='number' step="0.01" max="999999999999" min="1" name='precio_venta_establecido' class='form-control' required='' id="val_pve">
				      </div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save"></i> Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
