<div class="form-group col-lg-3">
    <label for="">Coleccion </label>
    <select class="form-control" name="coleccion" id="coleccion" required="">
        <option>Seleccione..</option>
        @foreach($colecciones as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-3">
    <label for="">Marcas </label>
    <select class="form-control" name="marcas" id="marcas" required="">
    </select>
</div>

<div class="form-group col-lg-3">
    <label>-</label><br>
    <button class="btn btn-primary btn-flat" type="button" id="btn_cargar_modelos">
         Cargar modelos
    </button>
    <hr>
</div>

<div class="col-lg-12">
    <table class="table table-bordered table-striped">
        <tr>
            <td style="width: 150px"><span id="name_modelos"></span></td>
            <td><span id="precio_modelos"></span></td>
        </tr>
    </table>
    <table class="table data-table table-bordered table-striped table-hover">
        <thead class="bg-navy">
            <tr>
                <th>[Codigo]</th>
                <th>Nombre</th>
                <th>Monturas disponibles</th>
                <th>Estuches disponibles</th>
                <th>Consignacion (monturas)</th>
            </tr>
        </thead>
        <tbody id="data_modelos"></tbody>
    </table>
</div>   