<form id="form_create_notacredito" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="create_notacredito">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Nueva Nota de credito</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-lg-8">
                <label0>Factura *</label><br>
                <select class="select2" name="factura_id" id="factura_id" required="" style="width: 100%">
                    @foreach($facturas as $m)
                    <option value="{{ $m->id }}">{{ '['.$m->num_factura.'] - '.$m->createF() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label></label><br>
                <button type="button" id="buscar_factura" class="btn btn-primary btn-sm">Buscar</button>
                <i class="fa fa-spinner fa-pulse icon-load" style="display: none;"></i>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
                <label0>Nº Serie *</label>
                <input type="text" name="n_serie" class="form-control" id="n_serie" required="">
            </div>
            <div class="form-group col-lg-4">
                <label0>Nº Nota *</label>
                <input type="text" name="n_nota" class="form-control" id="n_nota" required="">
            </div>
            <div class="form-group col-lg-4">
                <label0>Sub-Total *</label>
                <input type="number" step="0.01" min="1" max="99999999999" name="subtotal" class="form-control subtotal" id="subtotal_c" required="">
            </div>
            <div class="form-group col-lg-4">
                <label0>IGV * (%)</label>
                <input type="number" step="0.01" min="1" max="99999999999" name="impuesto" class="form-control" id="impuesto" onkeyup="calTotal(this);" required="">
            </div>
            <div class="form-group col-lg-4">
                <label0>Total factura *</label>
                <input type="text" name="total_neto" class="form-control total_neto" id="total_neto_c" readonly="" required="">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn_save_nc"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>