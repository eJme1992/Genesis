<div class="col-sm-12 col-xs-12">
	<div class="box box-success box-solid">
  		<div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-empire"></i> Marcas</h3>
	        <span class="pull-right">
				<button type="button" data-toggle="modal" data-target="#modal_marca" aria-expanded="false" aria-controls="modal_marca" class="btn btn-success">
					<i class="fa fa-plus" aria-hidden="true"></i> Nueva marca
				</button>
			</span>
	    </div>
			<div class="box-body">
				<span id="reg" style="display:none;" class="text-center">
					<i class="fa fa-refresh fa-pulse fa-fw fa-2x text-success"></i>
				</span>
			<table class="table data-table table-bordered table-hover table-condensed">
				<thead class="label-success">
					<tr>
						<th class="text-center">Codigo</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Material</th>
						<th class="text-center">Precio</th>
						<th class="text-center">Observacion</th>
						<th class="text-center">Asociadas a</th>
						<th class="text-center">Fecha de creacion</th>
						<th class="text-center">Acciones</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($marcas as $d)
						<tr>
							<td class="text-capitalize">{{$d->codigo}}</td>
							<td class="text-capitalize">{{$d->name}}</td>
							<td class="text-capitalize">{{$d->material->name}}</td>
							<td class="text-capitalize">{{$d->precio}}</td>
							<td class="text-capitalize">{{$d->observacion}}</td>
							<td class="text-capitalize">
								@foreach($d->colecciones as $col)
										<a href="{{ route('colecciones.show',[$col->id]) }}" class="btn btn-link"
											data-toggle="tooltip" data-placement="top" title="Añadir mas modelos">
											<span><i class="fa fa-arrow-right"></i> {{$col->name}}</span>
										</a>
								@endforeach
							</td>
							<td>{{ $d->fcreated() }}</td>
							<td>
								<span class="col-sm-6">
									<button type="button" id="btn_marca" value="{{ $d->id }}"
									data-toggle="modal" data-target="#modal_edit"
									aria-expanded="false" aria-controls="modal_edit"
									class="btn btn-warning btn-sm" onclick="MostrarMarca(this);">
										<span class="">
											<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
										</span>
									</button>
								</span>
								<span class="col-sm-6">
									<form action="{{ route('marcas.destroy', [$d->id]) }}" method="POST">
										{{ method_field( 'DELETE' ) }}
              							{{ csrf_field() }}
              							<button class="btn btn-sm btn-danger confirmar" type="submit" onclick="return confirm('Desea eliminar la marca con todas sus dependencias S/N?');"><i class="fa fa-trash"></i></button>
									</form>
								</span>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
