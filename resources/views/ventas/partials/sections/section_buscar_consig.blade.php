<h4 class="padding_1em bg-navy">
    <i class="fa fa-arrow-right"></i> Datos asociados a la consignacion
</h4>
<div class="list-group-item">
    <label for="id_consignacion"><i class="fa fa-arrow-right"></i> Consignacion </label> &nbsp;
    <select name="id" class="form-control select2" id="id_consignacion">
        @foreach($consignaciones as $c)
        <option value="{{ $c->id }}">{{ 'Codigo ['.$c->id.'] - Fecha ['.$c->createF().']' }}</option>
        @endforeach
    </select>

    <button type="button" class="btn btn-primary" id="btn_buscar_consignacion"> 
        <i class="fa fa-spinner fa-pulse" style="display: none;" id="icon-buscar-consig"></i> Buscar
    </button>   
</div>