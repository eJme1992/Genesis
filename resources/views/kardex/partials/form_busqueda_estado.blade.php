<div class="col-lg-12">
    <h4 class="padding_05em bg-green">
        <i class="fa fa-arrow-right"></i> Filtrar por Estacion
    </h4>
</div>

<form action="{{ route('kardex.busquedaPorEstado') }}" method="POST">
    {{ csrf_field() }}

    <div class="form-group col-lg-3">
        <label>Estado</label>
        <select name="estado" class="form-control" required="" id="estado">
            <option value="asignacion">Asignacion</option>
            <option value="consignacion">Consignacion</option>
            <option value="venta">Venta</option>
            <option value="devolucion">Devolucion</option>
        </select>
    </div>

    <div class="form-group col-lg-3">
        <label>Desde</label>
        <input type="text" name="desde" class="form-control from">
    </div>

    <div class="form-group col-lg-3">
        <label>Hasta</label>
        <input type="text" name="hasta" class="form-control to">
    </div>

    <div class="form-group col-lg-3 text-right">
        <label>-</label><br>
        <button type="submit" id="btn_buscar_porestado" class="btn btn-primary btn-flat">Buscar</button>
    </div>

</form>