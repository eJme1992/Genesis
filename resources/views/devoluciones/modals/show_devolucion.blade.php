<div class="modal fade" id="show_devolucion_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-navy">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Modelos devueltos</h4>
      </div>
      <div class="modal-body">

        <div class="list-group col-lg-3">
            <b>Cod. Venta</b>
            <p class="list-group-item">{{ $d->venta_id }}</p>
        </div>

        <div class="list-group col-lg-3">
            <b>Fecha</b>
            <p class="list-group-item">{{ $d->fecha }}</p>
        </div>

        <div class="list-group col-lg-6">
            <b>Motivo</b>
            <p class="list-group-item">{{ $d->motivo }}</p>
        </div>
        
        <h3 class="bg-navy padding_05em col-lg-12">
            <i class="fa fa-arrow-right"></i> Modelos devueltos 
        </h3>

        <table class="table table-bordered table-hover table-striped">
            <thead class="bg-navy disabled">
                <tr>
                    <th>Codigo</th>
                    <th>Modelo</th>
                    <th>Monturas</th>
                    <th>Estuches</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d->movDevolucion as $mov)
                <tr>
                    <td>{{ $mov->modelo_id }}</td>
                    <td>{{ $mov->modelo->name }}</td>
                    <td>{{ $mov->monturas }}</td>
                    <td>{{ $mov->estuches }}</td>
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
