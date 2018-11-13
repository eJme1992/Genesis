<div class="col-md-12">
	<div class="box box-success box-solid">
  		<div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-empire"></i> Consultas y Modelos</h3>
	        <span class="pull-right">
				<a href="{{ route('colecciones.index') }}" class="btn btn-success">
					<i class="fa fa-plus" aria-hidden="true"></i> Nueva Coleccion
				</a>
			</span>
	    </div>
			<div class="box-body">
				<span id="reg" style="display:none;" class="text-center">
				<i class="fa fa-refresh fa-pulse fa-fw fa-2x text-success"></i>
			</span>
			<table class="table data-table table-bordered table-hover" style="font-size: smaller;">
				<thead class="label-success">
					<tr>
						<th class="text-center">Cod Coleccion</th>
						<th class="text-center">Coleccion</th>
						<th class="text-center">Marca(s) y Modelo(s)</th>
						<th class="text-center">Fecha Almacen</th>
						<th class="text-center">Reporte</th>
						{{-- <th class="text-center">Accion</th> --}}
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($productos as $d)
						<tr>
							<td>00{{ $d->coleccion->id }}</td>
							<td>{{ $d->coleccion->name }}</td>
							<td>
								@foreach($d->coleccion->cm as $marcas)
									<span class="col-sm-4"><i class="fa fa-arrow-right"></i>  {{ $marcas->marca->name }}</span>
									<span class="col-sm-4">Ruedas ({{ $marcas->rueda }}) </span>
			            <span class="col-sm-3"> Modelos({{ $marcas->marca->mc($d->coleccion->id, $marcas->marca->id) }})</span>
									<br>
		            @endforeach
								<div class="col-sm-12">
									<span class="pull-right">
										<button type="button" id="btn_pro" value="{{ $d->coleccion_id }}"
										data-toggle="modal" data-target="#mod"
										aria-expanded="false" aria-controls="mod"
										class="btn btn-default" onclick="mod(this);">
										<span class="">
											<i class="fa fa-eye"></i>
										</span>
										</button>
									</span>
								</div>
							</td>
							<td>{{ $d->fecha_almacen }}</td>
							<td>
								<form action="{{ url('pdfPro/'.$d->id) }}" method="GET">
								{{ csrf_field() }}
									<button type="submit" class="btn btn-danger btn-sm" id="imprimir" name="id">
										<i class="fa fa-file-pdf-o"></i> PDF
									</button>
								</form>
							</td>
							<td>
								{{-- <a href="{{ route('productos.edit',[$d->id]) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a> --}}

								{{-- <span class="pull-right">
									<form action="{{ route('productos.destroy', [$d->id]) }}" method="POST">
										{{ method_field( 'DELETE' ) }}
              							{{ csrf_field() }}
              							<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Desea eliminar el producto con todas sus dependencias S/N?');"><i class="fa fa-trash"></i></button>
									</form>
								</span> --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
