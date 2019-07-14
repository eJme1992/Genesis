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
        <div class="row">
            <div class="form-group col-lg-4">
                <label>Nº Pedido *</label>
                <input type="text" name="n_pedido" class="form-control" id="n_pedido" required="">
            </div>
            <div class="form-group col-lg-4">
                <label>Motivo *</label>
                <select name="motivo_nota_id" class="form-control" required="" id="motivo_nota_id">
                    @foreach($motivos as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label>Cliente *</label>
                <select name="cliente_id" class="select2" required="" id="cliente_id" style="width: 100%;">
                    @foreach($clientes as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre_full }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-8">
                <label>Direccion *</label>
                <select name="direccion_id" class="select2" id="direccion_edit" required="" style="width: 100%;">
                    @foreach($direcciones as $d)
                    <option value="{{ $d->id }}">{{ $d->full_dir() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label>Total *</label>
                <input type="text" name="total" class="form-control" id="total" readonly="">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning" id="btn_edit_notapedido"><i class="fa fa-edit"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>