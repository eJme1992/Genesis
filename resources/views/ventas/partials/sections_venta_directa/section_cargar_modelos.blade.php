<div class="form-group col-lg-3">
    <label for="">Coleccion </label>
    <select class="select2" name="coleccion" id="select_coleccion" required="" style="width: 100%">
        <option>Seleccione..</option>
        @foreach($colecciones as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-3">
    <label for="">Marcas </label> <i class="fa fa-spinner fa-pulse" id="icon-load-marcas" style="display: none;"></i>
    <select class="select2" name="marca" id="select_marca" required="" style="width: 100%">
    </select>
</div>

<div class="form-group col-lg-6 text-left">
    <label>-</label><br>
    <button class="btn btn-primary" type="button" id="btn_cargar_modelos" onclick="cargarModelos();" data-toggle="tooltip" title="Cargar modelos asociados a la coleccion y la marca">
         <i class="fa fa-spinner fa-pulse" id="icon-cargar-modelos" style="display: none;"></i>Cargar modelos
    </button>
</div>