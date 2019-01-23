<form id="form_create_guia" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="modal fade" role="dialog" id="create">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> <i class="fa fa-list-alt"></i> Guia de remision</h3>
					</div>
					<div class="panel-body">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
						<div class="form-group col-sm-6">
							<label>Nº Serie *</label>
							<input type="text" name="serial" class="form-control" placeholder="Nª de serie..." required="" autofocus="">
						</div>

						<div class="form-group col-sm-6">
							<label>Nº Guia *</label>
							<input type="text" name="guia" class="form-control" placeholder="Nª de guia de remision..." required="">
						</div>

						<div class="form-group col-sm-6">
							<label>Motivo de guia *</label>
							<select class="form-control" name="motivo_guia_id" id="motivo_guia">
								@foreach($motivo as $m)
								<option value="{{ $m->id }}">
									{{ $m->nombre }}
								</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label for="">Cliente * </label> 
							<button type="button" data-toggle="modal" data-target="#create_cliente" class="btn btn-link btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i> Nuevo cliente
							</button>
							<select class="form-control" name="cliente_id" required="" id="add_cliente">
								<option value="">seleccione...</option>
								@foreach($clientes as $m)
								<option value="{{ $m->id }}">
									{{ $m->nombre_full }}
								</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-sm-12">
							<label for="">Direccion * [<em>Dep|Prov|Dist|[Detalle]</em>]</label> 
							<button type="button" data-toggle="modal" data-target="#modal_create" class="btn btn-link btn-sm">
								<i class="fa fa-plus" aria-hidden="true"></i> Nueva direccion
							</button>
							<select class="form-control dir_asig" name="direccion_id" required="" id="dir_asig">
								@foreach($direcciones as $m)
								@php $distrito = ""; if($m->distrito){$distrito = $m->distrito->distrito;} @endphp
								<option value="{{ $m->id }}">
									{{ $m->departamento->departamento.' | '.$m->provincia->provincia.' | '.$distrito.' | '.$m->detalle }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-sm-12">
							<h3 style="border-bottom: solid 1px #198F56">Descripci&oacute;n</h3>
						</div>
						<section id='section_modelos'>
							<div id='mas_modelos_1'>
								<div class='form-group col-sm-8'>
									<label>Modelos *</label>
									<select class='form-control select_modelo' name='modelo_id[]' required='' id='select_modelo_1' style='width: 100%;' data-valor="1">
										<option value=''>...</option>
										@foreach($modelos as $m)
										<option value='{{ $m->id }}'>
											{{ $m->modelo->coleccion->name }} | {{ $m->modelo->marca->name.'('.$m->modelo->marca->material->name.')' }} | {{ '['.$m->modelo->id.']' }} | {{ $m->name }}
										</option>
										@endforeach
									</select>
								</div>

								<div class='form-group col-sm-2'>
									<label>Monturas *</label>
									<select class='form-control select_montura' name='montura[]' required='' id='select_montura_1'>
									</select>
								</div>
							</div>
						</section>

						<div class="form-group col-sm-1 pull-right">
							<label>...</label>
							<button class="btn btn-primary" type="button" id="btn_mas_modelos" data-toggle="tooltip" data-placement="top" title="Añadir mas modelos"> 
								<i class="fa fa-plus"></i> 
							</button>
						</div>

					</div>		
					<div class="modal-footer">
						<div class="form-group text-right">
							<input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
							<button type="submit" class="btn btn-success btn_save_guia">
								<i class="fa fa-save"></i> Guardar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>