<div class="form-group col-lg-4">
    <label0>Nº Factura *</label>
    <input type="text" required="" name="num_factura" class="form-control" id="num_factura">
</div>
<div class="form-group col-lg-4">
    <label0>Tipo de item *</label>
    <select class="form-control item" required="" name="ref_item_id" id="item">
        @foreach($items as $m)
        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-lg-4">
    <label0>Estado *</label>
    <select class="form-control item" required="" name="ref_estadic_id" id="status_av">
        @foreach($status_av as $sav)
        <option value="{{ $sav->id }}">{{ $sav->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-lg-4">
    <label0>Sub-Total *</label>
    <input type="text" required="" name="subtotal" class="form-control" id="subtotal" readonly="">
</div>
<div class="form-group col-lg-4">
    <label0>IGV * (%)</label>
    <input type="number" step="0.01" min="1" max="99999999999" required="" name="impuesto" class="form-control" id="impuesto" onkeyup="calcularImpuesto(this);">
</div>
<div class="form-group col-lg-4">
    <label0>Total factura *</label>
    <input type="text" required="" name="total_neto" class="form-control" id="total_neto" readonly="">
</div>