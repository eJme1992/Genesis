<div class="form-group col-lg-4">
    <label for="">Numero unico *</label>
    <input type="text" class="form-control" id="numero_unico" name="numero_unico">
</div>

<div class="form-group col-lg-4">
    <label for="">Estado letra * </label>
    <select class="form-control" name="estatus_id" id="estatus_id">
        <option value="">seleccione...</option>
        @foreach($status_letra as $m)
        <option value="{{ $m->id }}">
            {{ $m->nombre }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-4">
    <label for="">Protesto letra * </label>
    <select class="form-control" name="protesto_id" id="protesto_id">
        <option value="">seleccione...</option>
        @foreach($protesto_letra as $m)
        <option value="{{ $m->id }}">
            {{ $m->monto }}
        </option>
        @endforeach
    </select>
</div>
            
<div class="form-group col-lg-3">
    <label for="">Monto inicial *</label>
    <input type="text" class="form-control" name="monto_inicial" id="monto_inicial">
</div>

<div class="form-group col-lg-3">
    <label for="">Monto Final *</label>
    <input type="text" class="form-control" name="monto_final" id="monto_final">
</div>

<div class="form-group col-lg-3">
    <label for="">Fecha Inicial *</label>
    <input type="text" class="form-control fecha" name="fecha_inicial" id="fecha_inicial">
</div>

<div class="form-group col-lg-3">
    <label for="">Fecha Final *</label>
    <input type="text" class="form-control fecha" name="fecha_final" id="fecha_final">
</div>

<div class="form-group col-lg-3">
    <label for="">Fecha Pago *</label>
    <input type="text" class="form-control fecha" name="fecha_pago" id="fecha_pago">
</div>

<div class="form-group col-lg-3">
    <label for="">No adeudado *</label>
    <select class="form-control" name="no_adeudado" id="no_adeudado">
        <option value="Si">SI</option>
        <option value="NO">NO</option>
    </select>
</div>