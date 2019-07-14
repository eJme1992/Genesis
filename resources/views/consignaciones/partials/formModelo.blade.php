<div class="form-group col-lg-3">
    <label for="">Coleccion </label>
    <select class="select2" name="coleccion" id="coleccion" required="" style="width: 100%;">
        <option>Seleccione..</option>
        @foreach($colecciones as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-3">
    <label for="">Marcas </label>
    <select class="select2" name="marcas" id="marcas" required="" style="width: 100%;">
    </select>
</div>

<div class="form-group col-lg-3">
    <label>-</label><br>
    <button class="btn btn-primary btn-flat" type="button" id="btn_cargar_modelos">
         Cargar modelos
    </button>
    <hr>
</div>

<div class="col-lg-12 div_tablas_modelos">
    <table class="table table-bordered table-striped">
        <tr>
            <td><span id="name_modelos"></span></td>
        </tr>
    </table>
    <table class="table data-table table-bordered table-striped table-hover" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>[Codigo]</th>
                <th>Nombre</th>
                <th>Monturas disponibles</th>
                <th>Estuches disponibles</th>
                <th>Precio S/</th>
                <th>Total S/</th>
            </tr>
        </thead>
        <tbody id="data_modelos"></tbody>
    </table>
    <hr>
</div>

<div class="form-group col-lg-12 form-inline text-right">
    <p class="text-uppercase pull-left text-info">
        <i class="fa fa-info-circle"></i> Seleccione solo las monturas a consignar.
    </p>    
    <label class="">Total S/</label>
    <input type="text" class="form-control total_consig" readonly="" name="total">
    <button type="button" class="btn btn-flat btn-primary" data-toggle="tooltip" title="Calcular total por modelo y total definitivo" onclick="calcularMontoTotal();">
        <i class="fa fa-arrow-right"></i> Calcular
    </button>
</div>   