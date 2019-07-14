<div class="form-group col-lg-6">
    <label for="">Cliente * </label> 
    <button type="button" data-toggle="modal" data-target="#create_cliente" class="btn btn-link btn-xs">
        [Nuevo cliente]
    </button>
    <select class="select2" name="cliente_id" required="" id="add_cliente" style="width: 100%;">
        <option value="">seleccione...</option>
        @foreach($clientes as $m)
        <option value="{{ $m->id }}">
            {{ $m->nombre_full }}
        </option>
        @endforeach
    </select>
</div>
            
<div class="form-group col-lg-4">
    <label for="fecha">Fecha de envio *</label>
    <input type="text" name="fecha_envio" class="form-control fecha" id="fecha" required="">
</div>

<div class="form-group col-lg-2">
    <label for="">Guia de remision</label> <br>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="checkbox" value="0" id="checkbox_guia" class="icheckbox_flat-green">
            Enviar con guia?
        </label>
    </div>
</div>