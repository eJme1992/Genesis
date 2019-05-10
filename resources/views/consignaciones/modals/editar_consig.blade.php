<form id="form_edit_consig" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_consig">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Editar fecha de envio</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-4">
            <label>Fecha *</label>
            <input type="text" name="fecha_envio" class="form-control fecha" id="fecha_envio" required="">
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-warning" id="btn_edit_consig"><i class="fa fa-edit"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>