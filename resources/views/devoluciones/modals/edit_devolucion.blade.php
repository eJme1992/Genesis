<form id="form_edit_devolucion" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_devolucion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Editar devolucion</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-12">
            <label0>Motivo *</label>
            <textarea name="motivo" class="form-control" id="motivo_dev" required=""></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning" id="btn_edit_devolucion"><i class="fa fa-edit"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>