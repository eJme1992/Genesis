<div class="form-group col-lg-3">
    <label for="">Coleccion </label>
    <select class="form-control" name="coleccion" id="select_coleccion" required="">
        <option>Seleccione..</option>
        @foreach($colecciones as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-3">
    <label for="">Marcas </label>
    <select class="form-control" name="marca" id="select_marca" required="">
    </select>
</div>

<div class="form-group col-lg-6 text-left">
    <label>-</label><br>
    <button class="btn btn-primary" type="button" id="btn_cargar_modelos" onclick="cargarModelos();" data-toggle="tooltip" title="Cargar modelos asociados a la coleccion y la marca">
         <i class="fa fa-spinner fa-pulse" id="icon-cargar-modelos" style="display: none;"></i>Cargar modelos
    </button>
</div>