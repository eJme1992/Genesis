<form id="form_create_guia" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="modal fade" role="dialog" id="create_guia">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="panel panel-success">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-plus"></i> <i class="fa fa-list-alt"></i> Guia de remision</h3>
					</div>
					<div class="panel-body">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
						
                        @include("guia_remision.partials.guia")
                        @include("guia_remision.partials.detalle_guia")
						
						<div class="form-group col-lg-12">
							<h3 style="border-bottom: solid 1px #198F56">Modelos a enviar</h3>
						</div>
						<section id='section_modelos'>
							<div id='mas_modelos_1'>
								<div class='form-group col-sm-6'>
									<label>Modelos *</label>
									<select class='form-control select_modelo' name='modelo_id[]' required='' id='select_modelo_1' style='width: 100%;' data-valor="1">
										<option value=''>...</option>
										@foreach($modelos as $m)
										<option value='{{ $m->id }}'>
											{{ $m->coleccion->name }} | {{ $m->marca->name.'('.$m->marca->material->name.')' }} | {{ '['.$m->id.']' }} | {{ $m->name }}
										</option>
										@endforeach
									</select>
								</div>

								<div class='form-group col-lg-2'>
									<label>Monturas *</label>
									<select class='form-control select_montura' name='montura[]' required='' id='select_montura_1'>
									</select>
								</div>
								
								<div class='form-group col-lg-2'>
									<label>Estuches *</label>
									<select class='form-control select_estuche' name='estuche[]' id='select_estuche_1'>
									</select>
								</div>
							</div>
						</section>

						<div class="form-group col-lg-1 pull-right">
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