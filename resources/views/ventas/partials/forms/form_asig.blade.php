<form id="form_venta_directa" accept-charset="utf-8">
    {{ csrf_field() }}

    <section id="section_vendedor" class="container-fluid">
        <div class="col-lg-12">
            <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Datos para la venta de productos asignados</h4>
        </div>

        <div class="col-lg-4">
            <label for="">Vendedor (usuario) </label>
            <select class="form-control" name="user_id" required="" id="user_id">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-8">
            <label for="">-</label><br>
            <button type="button" class="btn btn-primary" id="btn_cargar_modelos" onclick="buscarModelos();">
                <i class="fa fa-spinner fa-pulse" style="display: none;" id="icon-cargar-modelos"></i> Buscar
            </button>
            <hr>
        </div>
    </section>
    
    <section id="section_mostrar_datos_cargados" class="container-fluid">
        @include("ventas.partials.sections_venta_directa.section_mostrar_datos_cargados") 
    </section>

    {{-- NOTA DE PEDIDO --}}
    <section id="section_crear_nota_pedido" class="container-fluid">
        <div class="col-lg-12">
            <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Nota de Pedido</h4>
        </div>
        @include("ventas.partials.sections_venta_directa.section_crear_nota_pedido")
    </section>

    <div class="form-group col-lg-12">
        <hr>
        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        <button type="submit" class="btn btn-success btn-flat" id="btn_guardar_all">
            <i class="fa fa-save" id="icon-guardar-all"></i> Procesar Venta
        </button>
    </div>
</form>