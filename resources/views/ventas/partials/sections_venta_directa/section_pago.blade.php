<div class="form-group col-lg-3">
    <label for="">Tipo de abono * </label>
    <select class="form-control" name="tipo_abono_id" id="tipo_abono_id">
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
    <input type="text" class="form-control" id="total_deuda" readonly="" name="total_deuda">
</div>

<div class="form-group col-lg-3">
    <label for="">Abono *</label>
    <input type="number" min="1" max="99999999999" step="0.01" class="form-control" name="abono" id="abono" onkeyup="calcularRestante(this);" pattern="^[0-9]+">
</div>

<div class="form-group col-lg-3">
    <label for="">Restante *</label>
    <input type="number" class="form-control" name="restante" id="restante" readonly="" pattern="^[0-9]+" min="1" max="99999999999" step="0.01" autocomplete="false">
</div>