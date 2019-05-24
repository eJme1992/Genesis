<div class="modal fade" id="show_modelos_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-navy">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Modelos Asociados</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="bg-navy disabled">
                <tr>
                    <th>Codigo</th>
                    <th>Modelo</th>
                    <th>Monturas</th>
                    <th>Estuches</th>
                    <th>Devolucion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d->movDevolucion as $mov)
                <tr>
                    <td>{{ $mov->modelo_id }}</td>
                    <td>{{ $mov->modelo->name }}</td>
                    <td>{{ $mov->monturas == null ? 'no posee' : $mov->monturas }}</td>
                    <td>{{ $mov->estuches == null ? 'no posee' : $mov->estuches }}</td>
                    <td><b>[{{ $mov->devolucion_id }}]</b></td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>