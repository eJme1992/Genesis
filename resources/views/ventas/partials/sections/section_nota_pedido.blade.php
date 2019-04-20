
<div class="form-group col-lg-6">
    <label class="">Cliente *</label>
    <input type="hidden" name="cliente_id" class="cliente_id" required="">
    <input type="text" id="cliente_form" class="form-control" disabled="disabled">
</div>

<div class="form-group col-lg-6">
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

