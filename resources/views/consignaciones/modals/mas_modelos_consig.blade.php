<form id="form_añadir_modelos_consig" method="POST">
{{ csrf_field() }} {{ method_field('PUT') }}
<div class="modal fade" id="añadir_modelos_consig">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">
                <i class="fa fa-arrow-right"></i> Añadir mas modelos a la consignacion
            </h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-lg-3">
                <label for="">Coleccion </label>
                <select class="form-control" name="coleccion" id="añadir_coleccion" required="">
                    <option>Seleccione..</option>
                    @foreach($colecciones as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-3">
                <label for="">Marcas </label>
                <select class="form-control" name="marcas" id="añadir_marcas" required="">
                </select>
            </div>

            <div class="form-group col-lg-3">
                <label>-</label><br>
                <button class="btn btn-primary btn-flat" type="button" id="btn_cargar_modelos">
                     Cargar modelos
                </button>
                <hr>
            </div>

            <div class="col-lg-12 div_tablas_modelos">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><span id="añadir_name_modelos"></span></td>
                    </tr>
                </table>
                <table class="table data-table table-bordered table-striped table-hover ok" width="100%">
                    <thead class="bg-primary">
                        <tr>
                            <th>[Codigo]</th>
                            <th>Nombre</th>
                            <th>Monturas disponibles</th>
                            <th>Estuches disponibles</th>
                            <th>Precio S/</th>
                            <th>Total S/</th>
                            <th><input type="checkbox" name="check_all_model" value="0" id="check_all_model" onclick="checkAllModelos()"></th>
                        </tr>
                    </thead>
                    <tbody id="data_añadir_modelos"></tbody>
                </table>
                <hr>
            </div>

            <div class="form-group col-lg-12 form-inline text-right">
                <p class="text-uppercase pull-left text-info">
                    <i class="fa fa-info-circle"></i> Seleccione solo las monturas a consignar.
                </p>    
                <label class="">Total S/</label>
                <input type="text" class="form-control total_consig" readonly="" name="total">
                <button type="button" class="btn btn-flat btn-primary" data-toggle="tooltip" title="Calcular total por modelo y total definitivo" onclick="calcularMontoTotal();">
                    <i class="fa fa-arrow-right"></i> Calcular
                </button>
            </div>   
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn_save_añadir"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>