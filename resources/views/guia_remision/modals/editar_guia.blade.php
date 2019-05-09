<form id="form_edit_guia" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_guia">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Editar guia de remision</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label>Cantidad *</label>
            <input type="text" name="cantidad" class="form-control" id="cantidad" required="">
        </div>
        <div class="form-group col-lg-4">
            <label>Peso *</label>
            <input type="text" name="peso" class="form-control" id="peso" required="">
        </div>
        <div class="form-group col-lg-4">
            <label>Descripcion *</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning" id="btn_edit_guia"><i class="fa fa-edit"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>