<form id="form_update_estado_estuche" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="update_estado_estuche">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Actualizar estado de los estuches</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label0>Estado entrega*</label>
            <input type="hidden" name="venta_id" id="venta_id">
            <select class="form-control estado_estuche" name="estado_entrega_estuche" required="">
                <option value="1">Entregados</option>
                <option value="0">No entregados</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <hr>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning btn_uee"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>