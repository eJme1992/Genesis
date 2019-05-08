<div class="modal fade" id="show_factura_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-navy">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Detalles de Factura</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-6">
            <label0>Tipo de item </label>
            <p class="list-group-item">{{ $d->adicionalFactura }}</p>
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