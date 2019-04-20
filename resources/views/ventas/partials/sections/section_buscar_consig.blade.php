<div class="col-lg-7 text-left bg-primary disabled padding_1em">
    <label for="id_consignacion"><i class="fa fa-arrow-right"></i> Codigo consignacion </label>
    <select name="id" class="form-control select2" id="id_consignacion">
        @foreach($consignaciones as $c)
        <option value="{{ $c->id }}">{{ $c->id }}</option>
        @endforeach
    </select>

    <button type="button" class="btn btn-primary" id="btn_buscar_consignacion"> 
        <i class="fa fa-spinner fa-pulse" style="display: none;" id="icon-buscar-consig"></i> Buscar
    </button>   
</div>

<div class="col-lg-5"><br><br></div>