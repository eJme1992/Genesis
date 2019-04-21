<!-- guia de remision -->
    <div class="col-lg-12">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
    </div>

    <div class="form-group col-lg-6">
        <label>Nº Serie *</label> 
        <input type="text" name="serial" class="form-control" placeholder="Nª de serie..." id="serial">
    </div>

    <div class="form-group col-lg-6">
        <label>Nº Guia *</label>
        <input type="text" name="guia" class="form-control" placeholder="Nª de guia de remision..." id="guia">
    </div>

    <div class="form-group col-lg-6">
        <label for="">Direccion de salida *</label> 
        <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
            [Nueva direccion]
        </button>
        <select class="form-control dir_asig" name="dir_salida" id="dir_salida">
            @foreach($direcciones as $m)
            @php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
            <option value="{{ $m->id }}">
                {{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
            </option>
            @endforeach
        </select>
    </div>
        
    <div class="form-group col-lg-6">
        <label for="">Direccion de llegada *</label> 
        <select class="form-control dir_asig" name="dir_llegada" id="dir_llegada">
            @foreach($direcciones as $m)
            @php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
            <option value="{{ $m->id }}">
                {{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-lg-4">
        <label>Tipo de item *</label>
        <select class="form-control item" name="ref_item_id" id="item">
            @foreach($items as $m)
            <option value="{{ $m->id }}">{{ $m->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-lg-4">
        <label>Cantidad *</label>
        <input type="text" name="cantidad" class="form-control numero" placeholder="Cantidad..." id="cantidad">
    </div>

    <div class="form-group col-lg-4">
        <label>Peso * (KG = Kilogramos)</label>
        <input type="text" name="peso" class="form-control numero" placeholder="Cantidad..." id="peso">
    </div>

    <div class="form-group col-lg-12">
        <label>Descripcion</label>
        <textarea name="descripcion" class="form-control" placeholder="Alguna observacion..." id="descripcion"></textarea>
        <br>
    </div>