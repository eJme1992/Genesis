<div class="col-lg-12">
    <table class="table data-table table-bordered table-striped table-hover" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>[Codigo]</th>
                <th>Nombre</th>
                <th>Monturas</th>
                <th>Estuches</th>
                <th class="text-nowrap">Precio <strong data-toggle="tooltip" title="Precio de venta establecido en la marca y coleccion">(PVE)</strong></th>
                <th class="bg-navy">Total (S/)</th>
            </tr>
        </thead>
        <tbody id="data_modelos_venta_directa"></tbody>
    </table>
</div>

<div class="col-lg-12 form-inline text-right"><hr>
    <p class="text-uppercase pull-left text-info">
        <i class="fa fa-info-circle"></i> Seleccione solo las monturas a vender.
    </p>    
    <label class="">Total S/</label>
    <input type="text" class="form-control total_venta" readonly="" name="total">
    <button type="button" class="btn btn-flat btn-primary" id="btn_calcular_total_venta" data-toggle="tooltip" title="Calcular total por modelo y total venta" onclick="calcularMontoTotal();">
        <i class="fa fa-arrow-right"></i> Calcular
    </button><hr>
</div>