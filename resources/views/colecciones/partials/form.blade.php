<div class="form-group col-sm-2 text-left">
	<a href="{{ route('colecciones.ver') }}" class="btn btn-danger btn-lg">
		<i class="fa fa-arrow-right"></i> Listado de colecciones
	</a>
</div>
<div class="col-sm-12">
	<div class="box box-danger box-solid">
		<div class="box-body" id="box-body">

					{{-- seccion de coleccion --}}
					<section id="section_col">
						<div class="col-sm-12">
							<h3 class="label-danger padding_1em"><i class="fa fa-database"></i> <i class="fa fa-plus"></i> Nueva Coleccion</h3>
						</div>

						<div class="form-group col-sm-4">
							<label for="">Nombre </label>
							<input type="text" class="form-control" name="name_col" required="" id="name">
						</div>

						<div class="form-group col-sm-3">
							<label for="">Fecha </label>
							<input type="text" class="form-control fecha" name="fecha_coleccion" required="" id="fecha">
						</div>

						<input type="hidden" name="codigo" value="{{ $col }}" class="form-control" readonly="" id="codigo">

						<div class="form-group col-sm-3">
							<label for="">
								Proveedor
								[<a href="#cp" class="btn-link" data-toggle="modal" data-target="#cp" id="btn_prove">
									<span class="text-primary"><i class="fa fa-plus"></i> Nuevo</span>
								</a>]
								@include('colecciones.modals.cp')
							</label>
							<select name="proveedor_id" class="form-control" required="" id="s_p">
								<option value="">Seleccione</option>
								@foreach($proveedores as $prov)
								<option value="{{ $prov->id }}">{{ $prov->nombre }} / {{ $prov->empresa }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-sm-2" style="margin-top:2em">
							<button class="btn btn-danger btn-flat" type="button" id="btn_save_col">
								<i class="fa fa-save" id="icon-save-coleccion"></i> Guardar
							</button>
						</div>
					</section>

					{{-- seccion de marcas --}}
					<form id="form_mc" action="{{ route('colecciones.store') }}" method="POST">
					<input type="hidden" name="id_coleccion" id="id_col">
					<section id="section_marcas" style="display: none;">
						<div class="col-sm-12">
							<h3 class="label-danger padding_1em"><i class="fa fa-plus"></i> Añadir marcas</h3>
						</div>

						<div class="col-sm-12 text-left" style="border-bottom: solid 0px #D4D4D4; ">
							[<a href="#cm" class="btn-link" data-toggle="modal" data-target="#modal_marca">
								<span class="text-primary"><i class="fa fa-plus"></i> Nueva</span>
							</a>]
						</div>

						<section id="section_marca">

							<div id="div_total_marcas">
								<div class='form-group col-sm-4'>
									<label>Marcas</label>
									<select name='marca_id[]' class='form-control s_m' required='' id="s_m_0">
										<option value=''>Seleccione</option>
										@foreach($marcas as $m)
										<option value='{{ $m->id }}'>{{ $m->name }} | ({{ $m->material->name }})</option>
										@endforeach
									</select>
								</div>

								<div class='form-group col-sm-2'>
									<label>Ruedas</label>
									<select name='rueda[]' class='form-control ru' required=''>
										@for($r = 1; $r < 21; $r++)
										<option value='{{ $r }}'>{{ $r }}</option>
										@endfor
									</select>
								</div>

								<div class='form-group col-sm-2'>
									<label>Precio de almacen</label>
									<input type='number' step="0.01" max="999999999999" min="1" name='precio_almacen[]' class='form-control pa' required='' id="pa_0">
								</div>

								<div class='form-group col-sm-2'>
									<label>Precio de venta establecido</label>
									<input type='number' step="0.01" max="999999999999" min="1" name='precio_venta_establecido[]' class='form-control pve' required='' id="pve_0">
								</div>
							</div>

						</section>

						<div class="form-group col-sm-1 text-left" style="padding: 0.4em;">
							<br>
							<button class="btn btn-primary" type="button" id="btn_añadir_marca">
								<i class="fa fa-plus"></i>
							</button>

						</div>

						<div class="form-group col-sm-12 text-right">
							<button class="btn btn-danger" type="submit" id="btn_save_mar">
								<i class="fa fa-save"></i> Añadir marcas
							</button>
						</div>

					</section>
					</form>

					{{-- seccion de modelos --}}
					<section id="section_modelos" style="display:none">
					 	<div class="col-sm-12">
							<h3 class="label-danger padding_1em"><i class="fa fa-database"></i> <i class="fa fa-plus"></i> Añadir Modelos (Caja)</h3>
						</div>

						<div class="form-group col-sm-12">
		            <div class="alert alert-info">
		              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		              <span class="text-center">
		                <i class="fa fa-info"></i>
		                Si desea cambiar la cantidad de cajas, <b>seleccione en cada modelo la cantidad</b>, sino dejar tal cual
		              </span>
		            </div>
		        </div>

						<div class="form-group col-sm-4">
							<label for="">Seleccione marca</label>
							<a class="btn-link" id="link_mas_marcas" data-toggle="tooltip" data-placement="top" title="Ir al panel para añadir marcas">
				         <span class="text-primary"><i class="fa fa-plus"></i> Añadir mas marcas</span>
				      </a>
				      <select name="mar_mod" class="form-control" required="" id="col_mar">
							</select>
						</div>

						<div class="form-group col-sm-4">
							<label for="">---</label><br>
							<button class="btn btn-primary btn-flat" type="button" id="btn_carga_mar">
								<i class="fa" id="icon-cargar-marcas"></i> Cargar
							</button>
						</div>

						<div class="form-group col-sm-4">
							<label for="">Ruedas</label>
							<input type="text" class="form-control" name="rueda" readonly="" id="mar_rueda">
						</div>

						<hr>

					</section>


					<!-- formulario de modelos -->
					<form id="form_modelos">
						{{ csrf_field() }}
						<input type='hidden' name='marca_id' id="marca_id">
						<input type="hidden" name="rueda" id="cant_ruedas">
						<input type="hidden" name="id_coleccion" id="id_col2">

						<section id="sm" style="display: none;">
			    			<div class="div_total">
				    			<div class='form-group col-sm-2'>
									<label class='control-label' for='name'>Nombre modelo: *</label>
										<input type='text' name='name[]' class='form-control nombre_modelo' id="nombre_modelo_0" required=''>
								</div>
								<div class='form-group col-sm-2'>
									<label class='control-label'>Cantidad Monturas: *</label>
									<select name='montura[]' class='form-control' required=''>
											<option value='1'>1</option>
											<option value='2'>2</option>
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
											<option value='6'>6</option>
											<option value='7'>7</option>
											<option value='8'>8</option>
											<option value='9'>9</option>
											<option value='10'>10</option>
											<option value='11'>11</option>
											<option value='12' selected>12</option>
									</select>
								</div>
								<div class='form-group col-sm-2' id="div_estuches" style="display: none;">
									<label class='control-label'>Estuches: *</label>
									<select class='form-control' required='' id="select_estuche">
											<option value='1'>1</option>
											<option value='2'>2</option>
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
											<option value='6'>6</option>
											<option value='7'>7</option>
											<option value='8'>8</option>
											<option value='9'>9</option>
											<option value='10'>10</option>
											<option value='11'>11</option>
											<option value='12' selected>12</option>
									</select>
								</div>
								<div class='form-group col-sm-2'>
                    <label>Descripcion </label>
                    <input type='text' name='descripcion_modelo[]' class='form-control'>
                </div>
                <div class='form-group col-sm-2'>
                    <label>Cajas </label>
                    <select name='caja[]' class='form-control'>
	                      <option value='' selected></option>
	                      <option value='1'>1</option>
	                      <option value='2'>2</option>
	                      <option value='3'>3</option>
	                      <option value='4'>4</option>
	                      <option value='5'>5</option>
	                      <option value='6'>6</option>
	                      <option value='7'>7</option>
	                      <option value='8'>8</option>
	                      <option value='9'>9</option>
	                      <option value='10'>10</option>
	                      <option value='11'>11</option>
	                      <option value='12'>12</option>
	                      <option value='13'>13</option>
	                      <option value='14'>14</option>
	                      <option value='15'>15</option>
	                      <option value='16'>16</option>
	                      <option value='17'>17</option>
	                      <option value='18'>18</option>
	                      <option value='19'>19</option>
	                      <option value='20'>20</option>
                    </select>
                </div>
							</div>
						</section>

							<div class='form-group col-sm-1 text-left' style='padding: 1.8em;'>
								<button class='btn btn-primary' type='button' id='btn_añadir_modelo' style="display:none;">
									<i class='fa fa-plus'></i>
								</button>
							</div>

						<div class="form-group col-sm-12 text-right">
							<br>
							<button class="btn btn-danger" type="submit" id="btn_save_mod" style="display: none;">
								<i class="fa fa-save"></i> Guardar Modelos
							</button>
						</div>
					</form>

					<div class="col-sm-2">
			        <button class="btn btn-success btn-lg" type="button" id="btn_new_col" style="display: none;">
								<i class="fa fa-plus"></i> Nueva Coleccion
							</button>
			    </div>

			</div>
		</div>
	</div>
	@include('marcas.modals.modal_create')
