<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-arrow-right"></i> Filtrar por Coleccion/Marca</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{ route('kardex.busquedaCM') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="coleccion" class="col-lg-2 control-label">Colecciones/Prov</label>
                <div class="col-lg-10">
                    <select name="coleccion" class="form-control select2" required="" id="coleccion">
                        <option value=""></option>
                        @foreach($colecciones as $c)
                        <option value="{{ $c->id }}">{{ $c->name.' - '.$c->proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="marca" class="col-lg-2 control-label">Marca</label>
                <div class="col-lg-10">
                    <select name="marca" class="form-control" id="marca">
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="modelo" class="col-lg-2 control-label">Modelo</label>
                <div class="col-lg-10">
                    <select name="modelo" class="form-control" id="modelo">
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="desde" class="col-lg-2 control-label">Desde</label>
                <div class="col-lg-10">
                    <input type="text" name="desde" class="form-control from">
                </div>
            </div>

            <div class="form-group">
                <label for="hasta" class="col-lg-2 control-label">Hasta</label>
                <div class="col-lg-10">
                    <input type="text" name="hasta" class="form-control to">
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <button type="submit" id="btn_buscar_mc" class="btn btn-primary btn-flat pull-right">Buscar</button>
                </div>
            </div>

        </form>
    </div>
</div>
