
<div class="form-group col-lg-4">
    <label class="">Cliente *</label>
    <input type="hidden" name="cliente_id" class="cliente_id" required="">
    <input type="text" id="cliente_form" class="form-control" disabled="disabled">
</div>


<div class="form-group col-lg-4">
    <label for="">Direccion *</label> 
    <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
        [Nueva direccion]
    </button>
    <select class="form-control dir_asig" name="direccion_id" id="direccion_id" required="">
        @foreach($direcciones as $m)
        @php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
        <option value="{{ $m->id }}">
            {{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-4">
    <label class="">Estado de los estuches *</label><br>
    <span id="span_select_estuche" style="display: none;">
        <select class="form-control" id="status_estuche">
            <option value="1">Entregados</option>
            <option value="0">No entregados</option>
        </select>
    </span>
    <span id="span_info_estuche" style="display: none;">
        <p class="text-uppercase text-info">
            <i class="fa fa-info-circle"></i> Estos modelos no poseen estuches.
        </p>    
    </span>
</div>

<div class="col-lg-12">
    <hr>
</div>

<div class="form-group col-lg-6 text-uppercase">
    <label for="">FACTURA</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="checkbox_factura" value="0" id="checkbox_factura">
            <b>Entregar factura?</b>
        </label>
    </div>
</div>

<div class="form-group col-lg-6 text-uppercase">
    <label for="">Pago</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="checkbox_pago" value="0" id="checkbox_pago">
            Proceder al pago?
        </label>
    </div>
</div>

