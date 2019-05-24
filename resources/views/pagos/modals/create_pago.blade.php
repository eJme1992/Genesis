<form id="form_create_pago" accept-charset="utf-8">
{{ csrf_field() }}
<div class="modal fade" id="create_pago">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Nuevo Pago</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="venta_id" id="venta_id_pago">
        <div class="form-group col-lg-3">
            <label for="">Venta * </label>
            <select class="form-control" name="venta_id" id="venta_id" required="">
                <option value="">seleccione...</option>
                @foreach($ventas as $m)
                <option value="{{ $m->id }}">
                    {{ $m->id.' - '.$m->createF() }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-3">
            <label for="">Tipo de abono * </label>
            <select class="form-control" name="tipo_abono_id" id="tipo_abono_id" required="">
                <option value="">seleccione...</option>
                @foreach($tipo_abono as $m)
                <option value="{{ $m->id }}">
                    {{ $m->nombre }}
                </option>
                @endforeach
            </select>
        </div>
                    
        <div class="form-group col-lg-3">
            <label for="">Total Deuda *</label>
            <input type="text" class="form-control" id="total_deuda" name="total_deuda" required="">
        </div>

        <div class="form-group col-lg-3">
            <label for="">Abono *</label>
            <input type="number" min="1" max="99999999999" step="0.01" class="form-control" name="abono" id="abono" onkeyup="calcularRestante(this);" pattern="^[0-9]+" required="">
        </div>

        <div class="form-group col-lg-3">
            <label for="">Restante *</label>
            <input type="text" class="form-control" name="restante" id="restante" readonly="" pattern="^[0-9]+" required="">
        </div>
        <section id="section_letra" style="display: none" class="padding_1em">
            <div class="col-lg-12 well">
                @include("ventas.partials.sections_venta_directa.section_letra")
            </div>
        </section>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <hr>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn_cp"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>