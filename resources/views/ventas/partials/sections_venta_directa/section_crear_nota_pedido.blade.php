<div class="form-group col-lg-3">
    <label for="">Nº Pedido * </label>
    <input type="text" name="n_pedido" required="" class="form-control">
</div>

<div class="form-group col-lg-3">
    <label for="">Cliente * </label> 
    <button type="button" data-toggle="modal" data-target="#create_cliente" class="btn btn-link btn-xs">
        [Nuevo cliente]
    </button>
    <select class="select2" name="cliente_id" required="" id="add_cliente" style="width: 100%">
        <option value="">seleccione...</option>
        @foreach($clientes as $m)
        <option value="{{ $m->id }}">
            {{ $m->nombre_full }}
        </option>
        @endforeach
    </select>
</div>
            
<div class="form-group col-lg-3">
    <label for="">Direccion *</label> 
    <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
        [Nueva direccion]
    </button>
    <select class="select2 dir_asig" name="direccion_id" id="direccion_id" required="" style="width: 100%">
        @foreach($direcciones as $m)
        @php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
        <option value="{{ $m->id }}">
            {{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-3">
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