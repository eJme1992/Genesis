<div class="modal fade" id="modal_showletra_{{ $pago->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Detalles de la letra</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label>Numero Unico</label>
            <p class="list-group-item">{{ $pago->letra->numero_unico }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Estado Letra</label>
            <p class="list-group-item">{{ $pago->letra->statusLetra->nombre }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Protesto Letra</label>
            <p class="list-group-item">{{ $pago->letra->protestoLetra->monto }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Monto Inicial</label>
            <p class="list-group-item">{{ $pago->letra->monto_inicial }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Monto Final</label>
            <p class="list-group-item">{{ $pago->letra->monto_final }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Fecha Inical</label>
            <p class="list-group-item">{{ $pago->letra->fecha_inicial }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Fecha Final</label>
            <p class="list-group-item">{{ $pago->letra->fecha_final }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>Fecha Pago</label>
            <p class="list-group-item">{{ $pago->letra->fecha_pago }} </p>
        </div>
        <div class="form-group col-lg-4">
            <label>No adeudado</label>
            <p class="list-group-item">{{ $pago->letra->no_adeudado }} </p>
        </div>
      </div>
      <div class="modal-footer">            
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>