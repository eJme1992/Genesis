<form id="form_create_factura" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="create_factura">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Nueva factura</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label0>Nº Factura *</label>
            <input type="text" name="num_factura" class="form-control" id="num_factura" required="">
            <input type="hidden" name="venta_id" id="id_venta">
            <input type="hidden" name="cliente_id" id="id_cliente">
        </div>
        <div class="form-group col-lg-4">
            <label0>Tipo de item *</label>
            <select class="form-control item" name="ref_item_id_factura" id="item" required="">
                @foreach($items as $m)
                <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label0>Estado *</label>
            <select class="form-control item" name="ref_estadic_id" id="status_av" required="">
                @foreach($status_av as $sav)
                <option value="{{ $sav->id }}">{{ $sav->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label0>Sub-Total *</label>
            <input type="text" name="subtotal" class="form-control subtotal" id="subtotal" readonly="" required="">
        </div>
        <div class="form-group col-lg-4">
            <label0>IGV * (%)</label>
            <input type="number" step="0.01" min="1" max="99999999999" name="impuesto" class="form-control" id="impuesto" onkeyup="calcularImpuesto(this);" required="">
        </div>
        <div class="form-group col-lg-4">
            <label0>Total factura *</label>
            <input type="text" name="total_neto" class="form-control" id="total_neto" readonly="" required="">
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn_save_factura"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>