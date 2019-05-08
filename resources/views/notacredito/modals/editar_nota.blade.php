<form id="form_edit_nota" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_nota">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Editar nota de credito</h4>
      </div>
      <div class="modal-body">
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
            <input type="text" name="subtotal" class="form-control" id="subtotal" required="">
        </div>
        <div class="form-group col-lg-4">
            <label0>IGV * (%)</label>
            <input type="number" step="0.01" min="1" max="99999999999" name="impuesto" class="form-control" id="impuesto" onkeyup="calcularImpuesto(this);" required="">
        </div>
        <div class="form-group col-lg-4">
            <label0>Total factura *</label>
            <input type="text" name="total" class="form-control" id="total_neto" readonly="" required="">
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning" id="btn_edit_nota"><i class="fa fa-edit"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>