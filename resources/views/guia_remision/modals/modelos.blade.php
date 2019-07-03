
	<div class="modal fade" role="dialog" id="show_guia_{{ $d->id }}">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-arrow-right"></i> Guia <b>Nº <span> {{ $d->serial  }} </span></b></h3>
					</div>
					<div class="panel-body">
                        <table class="table table-hover table-bordered table-striped">
                            <caption>Detalles de la guia</caption>
                            <thead class="bg-primary">
                                <tr>
                                    <th>ITEM</th>
                                    <th>CANTIDAD</th>
                                    <th>PESO TOTAL (Kg)</th>
                                    <th>DESCRIPCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($d->detalleGuia as $dg)
                                    <tr>
                                        <td>{{ $dg->item->nombre }}</td>
                                        <td>{{ $dg->cantidad }}</td>
                                        <td>{{ $dg->peso }} Kg</td>
                                        <td>{{ $dg->descripcion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped table-hover">
                            <caption>Detalles de los productos</caption>
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