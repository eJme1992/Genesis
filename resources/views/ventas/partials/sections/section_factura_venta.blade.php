<div class="form-group col-lg-4">
    <label0>Nº Factura *</label>
    <input type="text" name="num_factura_fv" class="form-control" id="num_factura_fv" disabled="">
</div>
<div class="form-group col-lg-4">
    <label0>Tipo de item *</label>
    <select class="form-control" name="ref_item_id_factura" id="item_fv" disabled="">
        @foreach($items as $m)
        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-lg-4">
    <label0>Estado *</label>
    <select class="form-control" name="ref_estadic_id" id="status_av_fv" disabled="">
        @foreach($status_av as $sav)
        <option value="{{ $sav->id }}">{{ $sav->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-lg-4">
    <label0>Sub-Total *</label>
    <input type="text" name="subtotal_fv" class="form-control subtotal" id="subtotal_fv" disabled="">
</div>
<div class="form-group col-lg-4">
    <label0>IGV * (%)</label>
    <input type="number" step="0.01" min="1" max="99999999999" name="impuesto_fv" class="form-control" id="impuesto_fv" onkeyup="calcularImpuesto(this);" disabled="">
</div>
<div class="form-group col-lg-4">
    <label0>Total factura *</label>
    <input type="text" name="total_neto_fv" class="form-control" id="total_neto_fv" disabled="">
</div>