
	<div class="modal fade" role="dialog" id="show_guia_{{ $d->id }}">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-arrow-right"></i> Guia <b>Nº <span> {{ $d->serial  }} </span></b></h3>
					</div>
					<div class="panel-body">
                        <div class="form-group col-lg-3">
                            <label>Tipo de item</label>
                            <p class="list-group-item">{{ $d->detalleGuia->item->nombre }}</p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Cantidad</label>
                            <p class="list-group-item">{{ $d->detalleGuia->cantidad }}</p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Peso</label>
                            <p class="list-group-item">{{ $d->detalleGuia->peso }}</p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Motivo</label>
                            <p class="list-group-item list-group-item-info">{{ $d->motivo_guia->nombre }}</p>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Descripcion</label>
                            <p class="list-group-item">{{ $d->detalleGuia->descripcion == null ? 'sin detalles' : $d->detalleGuia->descripcion }}</p>
                        </div>

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-navy">
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Montura</th>
                                    <th>Estuche</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($d->modeloGuias as $m)
                                <tr>
                                    <td>[{{ $m->id }}]</td>
                                    <td>{{ $m->modelo->name }}</td>
                                    <td>{{ $m->montura }}</td>
                                    <td>{{ $m->estuche == null ? 'No posee' : $m->estuche }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>