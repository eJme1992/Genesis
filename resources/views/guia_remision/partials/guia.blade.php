<div class="form-group col-lg-6">
    <label>Nº Serie *</label>
    <input type="text" name="serial" class="form-control" placeholder="Nª de serie..." required="" autofocus="" id="serial">
</div>

<div class="form-group col-lg-6">
    <label>Nº Guia *</label>
    <input type="text" name="guia" class="form-control" placeholder="Nª de guia de remision..." required="" id="guia">
</div>

<div class="form-group col-lg-6">
    <label>Motivo de guia *</label>
    <select class="form-control" name="motivo_guia_id" id="motivo_guia">
        @foreach($motivo as $m)
        <option value="{{ $m->id }}">
            {{ $m->nombre }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-6">
    <label for="">Cliente * </label> 
    <button type="button" data-toggle="modal" data-target="#create_cliente" class="btn btn-link btn-xs">
        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo cliente
    </button>
    <select class="form-control" name="cliente_id" required="" id="add_cliente">
        <option value="">seleccione...</option>
        @foreach($clientes as $m)
        <option value="{{ $m->id }}">
            {{ $m->nombre_full }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-6">
    <label for="">Direccion de salida *</label> 
    <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
        <i class="fa fa-plus" aria-hidden="true"></i> Nueva direccion
    </button>
    <select class="form-control dir_asig" name="dir_salida" required="" id="dir_salida">
        @foreach($direcciones as $m)
        <option value="{{ $m->id }}">
            {{ $m->full_dir() }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group col-lg-6">
    <label for="">Direccion de llegada *</label> 
    <select class="form-control dir_asig" name="dir_llegada" required="" id="dir_llegada">
        @foreach($direcciones as $m)
        <option value="{{ $m->id }}">
            {{ $m->full_dir() }}
        </option>
        @endforeach
    </select>
</div>