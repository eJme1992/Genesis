<div class="modal fade" id="detalle_venta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title">
            <i class="fa fa-arrow-right"></i> Detalles de la Venta
            <i class='fa fa-spinner fa-pulse' id="icon-loading-venta" style="display: none;"></i>
        </h3>
      </div>
      <div class="modal-body">
        <h3 class="bg-navy padding_05em">
            <i class="fa fa-arrow-right"></i> Venta <span id="id_venta_venta"></span> 
        </h3>

        <div class="list-group col-lg-4">
            <b>Vendedor</b>
            <p class="list-group-item" id="user_venta"></p>
        </div>

        <div class="list-group col-lg-4">
            <b>Cliente</b>
            <p class="list-group-item" id="cliente_venta"></p>
        </div>

        <div class="list-group col-lg-4">
            <b>Direccion</b>
            <p class="list-group-item" id="direccion_venta"></p>
        </div>

        <div class="list-group col-lg-4">
            <b>Fecha inicio de venta</b>
            <p class="list-group-item" id="fecha_venta"></p>
        </div>
        
        <div class="list-group col-lg-4">
            <b>Estado de los estuches</b>
            <p class="list-group-item" id="status_estuche_venta"></p>
        </div>                    

        <h3 class="bg-navy padding_05em col-lg-12">
            <i class="fa fa-arrow-right"></i> Modelos vendidos 
        </h3>
        
        <div class="">
            <table class="table table-bordered table-hover table-striped">
                <thead class="bg-navy disabled">
                    <tr>
                        <th>Modelo</th>
                        <th>Monturas</th>
                        <th>Estuches</th>
                        <th>Precio Montura</th>
                        <th>Precio Modelo</th>
                    </tr>
                </thead>
                <tbody id="data_venta">
                </tbody>
            </table>
            <div class="form-group col-lg-3 pull-right">
                <b><i class="fa fa-arrow-right"></i>  Total Venta (S/)</b>&nbsp;
                <p class="list-group-item list-group-item-success" id="total_venta"></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>