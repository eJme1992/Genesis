<form id="form_venta_directa" accept-charset="utf-8">
    {{ csrf_field() }}
    <section id="section_cargar_modelos" class="container-fluid">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Seleccion de modelos</h4>
        @include("ventas.partials.sections_venta_directa.section_cargar_modelos") 
    </section>
    
    <section id="section_mostrar_datos_cargados" class="container-fluid"><hr>
        @include("ventas.partials.sections_venta_directa.section_mostrar_datos_cargados") 
    </section>

    {{-- NOTA DE PEDIDO --}}
    <section id="section_crear_nota_pedido" class="container-fluid">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Nota de Pedido</h4>
        @include("ventas.partials.sections_venta_directa.section_crear_nota_pedido")
    </section>
    
    {{-- CHECKBOXES --}}
    <section class="container-fluid"><hr>
        @include("ventas.partials.checkboxes")
    </section>

    {{-- GUIA DE REMISION --}}
    <section id="section_guia" class="container-fluid" style="display: none;">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
        @include("consignaciones.partials.formGuia")
    </section>

    {{-- SECCION FACTURA --}}
    <section style="display: none;" id="section_factura" class="container-fluid">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Factura</h4>
        @include("ventas.partials.sections.section_factura")
    </section>

    {{-- SECCION PAGO Y LETRA --}}
    <section style="display: none;" id="section_pago" class="container-fluid">
        <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Pago</h4>
        @include("ventas.partials.sections_venta_directa.section_pago")

        {{-- section letra --}}
        <section id="section_letra" style="display: none" class="padding_1em">
            <div class="col-lg-12 well">
                @include("ventas.partials.sections_venta_directa.section_letra")
            </div>
        </section>
    </section>

    <div class="form-group col-lg-12"><hr>
        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        <button type="submit" class="btn btn-success btn-flat" id="btn_guardar_all">
            <i class="fa fa-save" id="icon-guardar-all"></i> Procesar Venta
        </button>
    </div>
</form>