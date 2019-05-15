<div class="col-lg-12">
    <h4 class="padding_05em bg-green">
        <i class="fa fa-arrow-right"></i> Filtrar por Coleccion/Marca
    </h4>
</div>
<form action="{{ route('kardex.busquedaCM') }}" method="POST">
    {{ csrf_field() }}

    <div class="form-group col-lg-4">
        <label>Colecciones - Proveedor</label>
        <select name="coleccion" class="form-control select2" required="" id="coleccion">
            <option value=""></option>
            @foreach($colecciones as $c)
            <option value="{{ $c->id }}">{{ $c->name.' - '.$c->proveedor->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-lg-4">
        <label>Marca</label>
        <select name="marca" class="form-control" id="marca">
        </select>
    </div>

    <div class="form-group col-lg-4">
        <label>Modelo</label>
        <select name="modelo" class="form-control" id="modelo">
        </select>
    </div>

    <div class="form-group col-lg-4">
        <label>Desde</label>
        <input type="text" name="desde" class="form-control from">
    </div>

    <div class="form-group col-lg-4">
        <label>Hasta</label>
        <input type="text" name="hasta" class="form-control to">
    </div>

    <div class="form-group col-lg-4 text-right">
        <label>-</label><br>
        <button type="submit" id="btn_buscar_mc" class="btn btn-primary btn-flat">Buscar</button>
    </div>

</form>