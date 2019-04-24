<form id="form_venta_directa" accept-charset="utf-8">
    {{ csrf_field() }}
    <section id="section_cargar_modelos" class="container-fluid">
        <div class="col-lg-12">
            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Seleccion de modelos</h4>
        </div>
        <div class="form-group col-lg-3">
            <label for="">Coleccion </label>
            <select class="form-control" name="coleccion" id="select_coleccion" required="">
                <option>Seleccione..</option>
                @foreach($colecciones as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-3">
            <label for="">Marcas </label>
            <select class="form-control" name="marca" id="select_marca" required="">
            </select>
        </div>

        <div class="form-group col-lg-6 text-left">
            <label>-</label><br>
            <button class="btn btn-primary" type="button" id="btn_cargar_modelos" onclick="cargarModelos();">
                 <i class="fa fa-spinner fa-pulse" id="icon-cargar-modelos" style="display: none;"></i>Cargar modelos
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
            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Nota de Pedido</h4>
        </div>
        @include("ventas.partials.sections_venta_directa.section_crear_nota_pedido")
        <div class="form-group col-lg-3 text-uppercase">
            <label for="">Guia de remision</label> <br>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="checkbox_guia" value="0" id="checkbox_guia">
                    Enviar con guia?
                </label>
            </div>
        </div>
    </section>

     {{-- GUIA DE REMISION --}}
    <section id="section_guia" class="container-fluid" style="display: none;">
        @include("consignaciones.partials.formGuia")
    </section>
    
    <section class="container-fluid">
        <div class="form-group col-lg-6 text-uppercase">
            <label for="">FACTURA</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="checkbox_factura" value="0" id="checkbox_factura">
                    Entregar factura?
                </label>
            </div>
        </div>

        <div class="form-group col-lg-6 text-uppercase">
            <label for="">Pago</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="checkbox_pago" value="0" id="checkbox_pago">
                    Proceder al pago?
                </label>
            </div>
        </div>
    </section>

    {{-- SECCION FACTURA --}}
    <section style="display: none;" id="section_factura" class="container-fluid">
        <div class="form-group col-lg-12">
            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Factura</h4>
        </div>
        @include("ventas.partials.sections.section_factura")
    </section>

    {{-- SECCION PAGO --}}
    <section style="display: none;" id="section_pago" class="container-fluid">
        <div class="form-group col-lg-12">
            <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Pago</h4>
        </div>
        @include("ventas.partials.sections_venta_directa.section_pago")
        <section id="section_letra" style="display: none" class="padding_1em">
            <div class="col-lg-12 well">
            @include("ventas.partials.sections_venta_directa.section_letra")
            </div>
        </section>
    </section>

    <div class="form-group col-lg-12">
        <hr>
        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        <button type="submit" class="btn btn-success btn-flat" id="btn_guardar_all">
            <i class="fa fa-save" id="icon-guardar-all"></i> Procesar Venta
        </button>
    </div>
</form>