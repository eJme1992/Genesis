<input type="hidden" name="id_consig" id="id_consig">
<section id="section_consig_principal">
    <div class="col-lg-6">
        <label class="">Cliente</label>
        <p class="list-group-item"><strong id="cliente"></strong></p>
        <input type="hidden" class="cliente_id">
    </div>
                
    <div class="col-lg-3">
        <label class="">Fecha de envio</label>
        <p id="fecha_envio" class="list-group-item"></p>
    </div>

    <div class="col-lg-3">
        <label>---</label>
        <p id="guia" class="list-group-item"></p>
        <br>
    </div>
</section>

<section id="section_modelos_calcular_precio">
    
<div class="col-lg-12">
    <table class="table table-bordered table-striped table-hover data-table">
        <thead class="bg-navy disabled">
            <tr>
                <th>[Codigo]</th>
                <th>Nombre</th>
                <th>Monturas</th>
                <th>Estuches</th>
                <th class="text-nowrap">Precio <strong data-toggle="tooltip" title="Precio de venta establecido en la marca y coleccion">(PVE)</strong></th>
                <th class="bg-primary">Total (S/)</th>
                <th class="bg-primary">Estado</th>
            </tr>
        </thead>
        <tbody id="data_modelos"></tbody>
    </table>
    <br>
</div>

<div class="col-lg-12 form-inline text-right">
        <p class="text-uppercase pull-left text-info">
            <i class="fa fa-info-circle"></i> Seleccione solo las monturas consignadas.
        </p>    
        <label class="">Total S/</label>
        <input type="text" class="form-control total_venta" readonly="" name="total">
        <button type="button" class="btn btn-flat btn-primary" id="btn_calcular_total_venta" data-toggle="tooltip" title="Calcular total por modelo y total venta" onclick="calcularMontoTotal();">
            <i class="fa fa-arrow-right"></i> Calcular
        </button>
    <hr>
</div> 
</section>