<div class="col-sm-12">
	<div class="box box-info box-solid">
  		<div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-circle"></i> Ruedas</h3>
	    </div>
			<div class="box-body">
			<table class="table data-table table-bordered table-hover" style="font-size: smaller;">
				<thead class="label-info">
					<tr>
						<th class="text-center">Codigo</th>
						<th class="text-center">Modelo</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Nº Ruedas</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($modelos as $d)
						<tr>
							<td>{{ $d->codigo }}</td>
							<td>{{ $d->name }}</td>
							<td>{{ $d->descripcion_modelo }}</td>
							<td>{{ $d->ruedas($d->id) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>