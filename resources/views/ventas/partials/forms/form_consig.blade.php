<form id="form_venta_factura">
    {{ csrf_field() }}

    {{-- SELECT DE CONSIGNACION --}}
    <section id="section_select_consig" class="container-fluid form-inline list-group">
        @include("ventas.partials.sections.section_buscar_consig")
    </section>

    {{-- NOTA DE PEDIDO --}}
    <section id="section_nota_pedido" style="display: none;" class="container-fluid">
        <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Nota de Pedido</h4>
        @include("ventas.partials.sections.section_nota_pedido")
    </section>

    {{-- GUIA DE REMISION --}}
    <section id="section_guia" style="display: none;" class="container-fluid">
        <h4 class="padding_1em bg-primary">
            <i class="fa fa-arrow-right"></i> Datos de la Guia
            <span id="#span_guia" class="pull-right"></span>
        </h4>
        @include("ventas.partials.sections.section_guia")
    </section>

    {{-- DETALLES DE LA CONSIGNACION - MODELOS --}}
    <section id="section_detalle_consig" style="display: none;" class="container-fluid">
        <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Detalles - Modelos</h4>
        @include("ventas.partials.sections.section_consig")
        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        <button type="button" class="btn btn-flat btn-success btn_siguiente" data-toggle="tooltip" title="Guardar los cambios y completar la venta">
            <i class="fa fa-arrow-right" id="icon-procesar-venta"></i> Siguiente
        </button>
    </section>
    
    {{-- SECCION FACTURA --}}
    <section style="display: none;" id="section_factura" class="container-fluid">
        <h4 class="padding_1em bg-primary"><i class="fa fa-arrow-right"></i> Factura</h4>
        @include("ventas.partials.sections.section_factura")
    </section>

    <section id="btn_guardar_nota_pedido" class="container-fluid"  style="display: none;">
        @include("ventas.partials.sections.section_btn_submit_volver")
    </section>

</form>