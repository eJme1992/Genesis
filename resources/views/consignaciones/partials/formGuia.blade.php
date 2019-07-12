<!-- guia de remision -->
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
        <select class="select2 dir_asig" name="dir_salida" id="dir_salida" style="width: 100%;">
            @foreach($direcciones as $m)
            <option value="{{ $m->id }}">
                {{ $m->full_dir() }}
            </option>
            @endforeach
        </select>
    </div>
        
    <div class="form-group col-lg-6">
        <label for="">Direccion de llegada *</label> 
        <select class="select2 dir_asig" name="dir_llegada" id="dir_llegada" style="width: 100%;">
            @foreach($direcciones as $m)
            <option value="{{ $m->id }}">
                {{ $m->full_dir() }}
            </option>
            @endforeach
        </select>
    </div>

    <section id="section_detalle_guia_1">
    
        <div class="form-group col-lg-2">
            <label>Tipo de item *</label>
            <select class="form-control item" name="ref_item_id[]" id="item">
                @foreach($items as $m)
                <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-2">
            <label>Cantidad *</label>
            <input type="text" name="cantidad[]" class="form-control numero" placeholder="Cantidad..." id="cantidad">
        </div>

        <div class="form-group col-lg-2">
            <label>Peso total* (KG)</label>
            <input type="text" name="peso[]" class="form-control numero" placeholder="Peso total..." id="peso">
        </div>

        <div class="form-group col-lg-5">
            <label>Descripcion</label>
            <textarea name="descripcion[]" class="form-control" placeholder="Alguna observacion..." id="descripcion"></textarea>
        </div>

    </section>

    <div class="form-group col-lg-1">
        <label>--</label><br>
        <button class="btn btn-primary" type="button" id="btn_añadir_detalle_guia">
            <i class="fa fa-plus"></i>
        </button>
    </div>

    <section id="section_replicar_detalle_guia"></section>