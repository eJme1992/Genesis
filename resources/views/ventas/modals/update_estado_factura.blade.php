<form id="form_update_estado_factura" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="update_estado_factura">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Actualizar estado de la factura</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label0>Nº Factura *</label>
            <input type="text" name="num_factura" class="form-control" id="num_factura_update" readonly="">
            <input type="hidden" name="adicional_id" id="adicional_id">
        </div>
        <div class="form-group col-lg-4">
            <label0>Estado *</label>
            <select class="form-control item" name="ref_estadic_id" required="">
                @foreach($status_av as $sav)
                <option value="{{ $sav->id }}">{{ $sav->nombre }}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <hr>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning btn_uef"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>