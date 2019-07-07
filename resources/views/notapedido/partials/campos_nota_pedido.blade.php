<div class="form-group col-lg-3">
    <label for="">Nº Pedido * </label>
    <input type="text" name="n_pedido" required="" class="form-control">
</div>

<div class="form-group col-lg-9">
    <label for="">Direccion *</label> 
    <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
        [Nueva direccion]
    </button>
    <select class="form-control dir_asig" name="direccion_id" id="direccion_id" required="">
        @foreach($direcciones as $m)
        <option value="{{ $m->id }}">
            {{ $m->full_dir() }}
        </option>
        @endforeach
    </select>
</div>