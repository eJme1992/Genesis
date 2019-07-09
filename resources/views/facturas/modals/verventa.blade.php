<div class="modal fade" id="ver_venta_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Datos de la Venta</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-4 list-group">
                <label0>Nº Venta</label>
                <p class="list-group-item">{{ $d->adicionalFactura->venta->id }}</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>