<div class="modal fade" id="detalle_dev">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title">
            <i class="fa fa-arrow-right"></i> Detalles de la Devolucion
            <i class='fa fa-spinner fa-pulse' id="icon-loading-dev" style="display: none;"></i>
        </h3>
      </div>
      <div class="modal-body">
        <div class="list-group col-lg-3">
            <b>Cod. Venta</b>
            <p class="list-group-item" id="id_venta_dev"></p>
        </div>

        <div class="list-group col-lg-3">
            <b>Fecha</b>
            <p class="list-group-item" id="fecha_dev"></p>
        </div>

        <div class="list-group col-lg-6">
            <b>Motivo</b>
            <p class="list-group-item" id="motivo_dev"></p>
        </div>
        
        <h3 class="bg-navy padding_05em col-lg-12">
            <i class="fa fa-arrow-right"></i> Modelos devueltos 
        </h3>

        <table class="table table-bordered table-hover table-striped">
            <thead class="bg-navy disabled">
                <tr>
                    <th>Codigo</th>
                    <th>Modelo</th>
                    <th>Monturas</th>
                    <th>Estuches</th>
                </tr>
            </thead>
            <tbody id="data_dev">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>