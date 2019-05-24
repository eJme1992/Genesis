<form id="form_editar_pago" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_pago">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-orange">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            <i class="fa fa-arrow-right"></i> Editar Pago
        </h4>
      </div>
      <div class="modal-body">

        <div class="form-group col-lg-3">
            <label for="">Tipo de abono * </label>
            <select class="form-control" name="tipo_abono_id" id="tipo_abono_id_edit" required="">
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
            <input type="text" class="form-control" id="total_deuda_edit" readonly="" name="total_deuda" required="">
        </div>

        <div class="form-group col-lg-3">
            <label for="">Abono *</label>
            <input type="number" min="1" max="99999999999" step="0.01" class="form-control" name="abono" id="abono_edit" onkeyup="calcularRestanteEdit(this);" pattern="^[0-9]+" required="">
        </div>

        <div class="form-group col-lg-3">
            <label for="">Restante *</label>
            <input type="text" class="form-control" name="restante" id="restante_edit" readonly="" pattern="^[0-9]+" required="">
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
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>