<div class="modal fade" id="show_modelos_{{ $v->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-arrow-right"></i> Modelos adquiridos</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover table-striped">
            <thead class="bg-navy disabled">
                <tr>
                    <th>Codigo modelo</th>
                    <th>Nombre</th>
                    <th>Monturas</th>
                    <th>Estuches</th>
                    <th>Precio montura</th>
                    <th>Precio total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($v->movimientoVenta as $m)
                <tr>
                    <td>[{{ $m->id }}]</td>
                    <td>{{ $m->modelo->name }}</td>
                    <td>{{ $m->monturas }}</td>
                    <td>{{ $m->estuches == null ? 'No posee' : $m->estuches }}</td>
                    <td class="text-primary"><b>S/ </b> {{ $m->precio_montura }}</td>
                    <td class="text-primary"><b>S/ </b> {{ $m->precio_modelo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">            
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>