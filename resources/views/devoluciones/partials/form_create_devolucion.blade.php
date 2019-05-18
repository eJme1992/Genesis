<form id="form_save_devolucion">
    <section id="section_venta">
        <h3 class="padding_05em bg-green col-lg-12"><i class="fa fa-arrow-right"></i> Datos de la venta</h3>
        @include("devoluciones.partials.section_venta")
        @include("devoluciones.partials.tabla_modelos_venta")

        <div class="form-group col-lg-3">
            <label>Total a facturar</label>
            <input type="number" name="total_facturar" class="form-control" readonly="" id="total_facturar" step='0.01' max='999999999999' min='1'>
        </div>
    </section>
    
    <section id="section_coleccion_marca">
        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Cargar modelos a facturar</h3>
        @include("ventas.partials.sections_venta_directa.section_cargar_modelos")
        @include("ventas.partials.sections_venta_directa.section_mostrar_datos_cargados") 
    </section>

    <section id="section_devolucion">
        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Nota de credito</h3>
        @include("devoluciones.partials.section_devolucion")
    </section>
    
    <section id="section_factura">
        <h3 class="padding_05em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Factura</h3>
        @include("ventas.partials.sections.section_factura")
    </section>

    <div class="form-group col-lg-12 text-uppercase">
        <label for="">Guia de remision</label>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="checkbox_guia" value="0" id="checkbox_guia">
                Enviar con guia?
            </label>
        </div>
    </div>

    {{-- GUIA DE REMISION --}}
    <section id="section_guia" class="container-fluid" style="display: none;">
        <h4 class="padding_1em bg-primary col-lg-12"><i class="fa fa-arrow-right"></i> Datos de la Guia</h4>
        @include("consignaciones.partials.formGuia")
    </section>

    <div class="form-group col-lg-12"><hr>
        <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        <button type="submit" class="btn btn-success btn-flat" id="btn_guardar_all" disabled="disabled">
            <i class="fa fa-save" id="icon-guardar-all"></i> Procesar Venta
        </button>
    </div>
</form>