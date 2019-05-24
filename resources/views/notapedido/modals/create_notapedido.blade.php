<form id="form_create_notapedido" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="create_notapedido">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Nueva Nota de pedido</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
            <section id="section_crear_nota_pedido">
                @include("ventas.partials.sections_venta_directa.section_crear_nota_pedido")
            </section>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <label0><b>Motivo *</b></label>
                <select class="form-control" name="motivo_nota_id" id="motivo_nota_id" required="">
                    @foreach($motivos as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h4 class="padding_1em bg-navy"><i class="fa fa-arrow-right"></i> Seleccion de modelos</h4>
            </div>
            @include("ventas.partials.sections_venta_directa.section_cargar_modelos")
            @include("ventas.partials.sections_venta_directa.section_mostrar_datos_cargados")
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn_save_np"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>