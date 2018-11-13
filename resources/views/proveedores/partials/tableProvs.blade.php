<div class="col-sm-12 col-xs-12">
	<div class="box box-danger box-solid">
  		<div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-industry"></i> Proveedores</h3>
	        <span class="pull-right">
	        	<a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Nuevo</a>
	        </span>
	    </div>
			<div class="box-body">
			<table class="table data-table table-bordered table-hover">
				<thead class="label-danger">
					<tr>
						<th class="text-center">Nombre completo</th>
						<th class="text-center">Telefono</th>
						<th class="text-center">Correo</th>
						<th class="text-center">Empresa</th>
						<th class="text-center">RUC</th>
						<th class="text-center">Direccion</th>
						<th class="text-center">Observacion</th>
						<th class="text-center">Accion</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($provs as $d)
						<tr>
							<td class="text-capitalize">{{ $d->nombre }}</td>
							<td>{{ $d->telefono }}</td>
							<td>{{ $d->correo }}</td>
							<td class="text-capitalize">{{ $d->empresa }}</td>
							<td>{{ $d->ruc }}</td>
							<td>{{ $d->direccion }}</td>
							<td>{{ $d->observacion }}</td>
							<td>
								<a href="{{ route("proveedores.edit", [$d->id]) }}" class="btn btn-warning btn-sm">
									<span class="">
										<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
									</span>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>