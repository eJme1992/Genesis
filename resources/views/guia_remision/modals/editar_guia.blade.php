<form id="form_edit_guia" method="POST">
{{ csrf_field() }} {{ method_field('PATCH') }}
<div class="modal fade" id="editar_guia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-orange">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">
                <i class="fa fa-arrow-right"></i> Editar Guia de Remision Nº <span id="edit_serial"></span> 
                <i class="fa fa-spinner fa-pulse" style="display: none;" id="icon-load"></i>
            </h4>
      </div>
      <div class="modal-body">

        <div class="form-group col-lg-6">
            <label>Motivo de guia *</label>
            <select class="form-control" name="motivo_guia_id" id="edit_motivoguia">
                @foreach($motivo as $m)
                <option value="{{ $m->id }}">
                    {{ $m->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="">Cliente * </label> 
            <button type="button" data-toggle="modal" data-target="#create_cliente" class="btn btn-link btn-xs">
                <i class="fa fa-plus" aria-hidden="true"></i> Nuevo cliente
            </button>
            <select class="form-control" name="cliente_id" required="" id="edit_cliente">
                <option value="">seleccione...</option>
                @foreach($clientes as $m)
                <option value="{{ $m->id }}">
                    {{ $m->nombre_full }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="">Direccion de salida *</label> 
            <button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-xs">
                <i class="fa fa-plus" aria-hidden="true"></i> Nueva direccion
            </button>
            <select class="form-control dir_asig" name="dir_salida" required="" id="edit_dirsalida">
                @foreach($direcciones as $m)
                <option value="{{ $m->id }}">
                    {{ $m->full_dir() }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="">Direccion de llegada *</label> 
            <select class="form-control dir_asig" name="dir_llegada" required="" id="edit_dirllegada">
                @foreach($direcciones as $m)
                <option value="{{ $m->id }}">
                    {{ $m->full_dir() }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-12">
            <table class="table table-hover table-bordered">
                <caption>Detalles de la guia</caption>
                <thead class="bg-primary">
                    <tr>
                        <th>ITEM</th>
                        <th>CANTIDAD</th>
                        <th>PESO TOTAL (Kg)</th>
                        <th>DESCRIPCION</th>
                    </tr>
                </thead>
                <tbody id="data_detalles_guia">
                </tbody>
            </table>
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