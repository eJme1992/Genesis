<div class="modal fade" id="show_factura_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Factura</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-6">
            <label0>Cliente </label>
            <p class="list-group-item">{{ $d->factura->cliente->nombre_full }}</p>
        </div>
        <div class="form-group col-lg-3">
            <label0>Nº Factura </label>
            <p class="list-group-item">{{ $d->factura->num_factura }}</p>
        </div>
        <div class="form-group col-lg-3">
            <label0>Sub-Total </label>
            <p class="list-group-item">{{ $d->factura->subtotal }}</p>    
        </div>
        <div class="form-group col-lg-6">
            <label0>IGV * (%)</label>
            <p class="list-group-item">{{ $d->factura->impuesto }}</p>
        </div>
        <div class="form-group col-lg-6">
            <label0>Total factura *</label>
            <p class="list-group-item">{{ $d->factura->total }}</p>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>