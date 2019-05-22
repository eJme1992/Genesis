<form id="form_edit_notapedido" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_notapedido">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Editar nota de pedido</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label0>Nº Pedido *</label>
            <input type="text" name="n_pedido" class="form-control" id="n_pedido" required="">
        </div>
        <div class="form-group col-lg-4">
            <label0>Motivo *</label>
            <select name="motivo_nota_id" class="form-control" required="" id="motivo_nota_id">
                @foreach($motivos as $m)
                <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label0>Cliente *</label>
            <select name="cliente_id" class="form-control" required="" id="cliente_id">
                @foreach($clientes as $m)
                <option value="{{ $m->id }}">{{ $m->nombre_full }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label0>Direccion *</label>
            <select name="direccion_id" class="form-control" required="" id="direccion_id">
                @foreach($direcciones as $m)
                <option value="{{ $m->id }}">{{ $m->full_dir() }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label0>Total *</label>
            <input type="text" name="total" class="form-control" id="total" readonly="">
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning" id="btn_edit_notapedido"><i class="fa fa-edit"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>