<div class="modal fade" tabindex="-1" role="dialog" id="detalle_notapedido_{{ $d->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="panel">
                <div class="panel-heading bg-primary">
                    <buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
                    <h3>
                        <i class="fa fa-list-alt"></i> Datos de la nota de pedido 
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Nº Pedido</label>
                            <p class="list-group-item">{{ $d->notapedido->n_pedido }}</p>
                        </div>

                        <div class="col-lg-6">
                            <label>Cliente</label>
                            <p class="list-group-item">{{ $d->notapedido->cliente->nombre_full }}</p>
                        <br>
                        </div>
                        <div class="col-lg-6">
                            <label>Direccion</label>
                            <p class="list-group-item">{{ $d->notapedido->direccion->full_dir() }}</p>
                        </div>

                        <div class="col-lg-6">
                            <label>Total</label>
                            <p class="list-group-item">{{ $d->notapedido->total }}</p>
                        </div>
                    </div>
                </div>      
                <div class="modal-footer">
                    <div class="text-right">
                        <input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>