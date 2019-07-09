<div class="modal fade" id="ver_venta_{{ $d->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">
            <i class="fa fa-arrow-right"></i> Datos de la Venta Nº {{ $d->adicionalFactura->venta->id }}
        </h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-4 list-group">
            <b>Cliente</b>
            <p class="list-group-item">{{ $d->adicionalFactura->venta->cliente->nombre_full }}</p>
        </div>
        <div class="col-lg-4 list-group">
            <b>Estuches</b>
            <p class="list-group-item">{{ $d->adicionalFactura->venta->estatusEstuche() }}</p>
        </div>
        <div class="col-lg-4 list-group">
            <b>Fecha</b>
            <p class="list-group-item">{{ $d->adicionalFactura->venta->fecha }}</p>
        </div>
        <div class="col-lg-12 list-group">
            <b>Direccion</b>
            <p class="list-group-item">{{ $d->adicionalFactura->venta->direccion->full_dir() }}</p>
        </div>

        <div class="list-group col-lg-4">
            <b>Fecha (estado de entrega)</b>
            <p class="list-group-item list-group-item-{{ $d->adicionalFactura->ref_estadic_id == 3 ? 'success' : 'danger'}}">
                {{ $d->adicionalFactura->ref_estadic_id == 3 ? $d->adicionalFactura->fecha_estado : 'Factura no entregada'}}
            </p>
        </div>

        <div class="list-group col-lg-4">
            <b>Estado Factura</b>
            <p class="list-group-item list-group-item-{{ $d->adicionalFactura->ref_estadic_id == 3 ? 'success' : 'danger' }}">
                {{ $d->adicionalFactura->statusAdicional->nombre }}
            </p>
        </div>

        <div class="list-group col-lg-4">
            <b>Tipo de item</b>
            <p class="list-group-item list-group-item-{{ $d->adicionalFactura ? 'info' : 'danger' }}">
                {{ $d->adicionalFactura->item->nombre  }}
            </p>
        </div>

        <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped">
                <thead class="bg-navy disabled">
                    <tr>
                        <th>Modelo</th>
                        <th>Monturas</th>
                        <th>Estuches</th>
                        <th>Precio Montura</th>
                        <th>Precio Modelo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($d->adicionalFactura->venta->movimientoVenta as $mov)
                    <tr>
                        <td>{{ $mov->modelo->name }}</td>
                        <td>{{ $mov->monturas}}</td>
                        <td>{{ $mov->estuches }}</td>
                        <td><b>S/ </b>{{ $mov->precio_montura }}</td>
                        <td><b>S/ </b>{{ $mov->precio_modelo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-inline text-right">
                <b><i class="fa fa-arrow-right"></i>  Total Venta (S/)</b>&nbsp;  
                <input type="text" class="form-control" value="{{ $d->adicionalFactura->venta->total }}" readonly="">
            </div>
            <hr>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>