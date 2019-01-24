<form id="form_create_guia" action="" method="POST">
{{ csrf_field() }}
	<div class="modal fade" role="dialog" id="modelos_guia">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="panel panel-info">
					<div class="panel-heading text-center">
						<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
						<h3><i class="fa fa-list-alt"></i> Guia <b>Nº <span id="n_guia"></span></b></h3>
					</div>
					<div class="panel-body">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">	
						<section id='section_modelos'>
							<div id='mas_modelos_1'>

								<div class='form-group col-sm-8'>
									<h2><b>Modelos</b></h2>
									<h3 class="text-capitalize" id="mostrar_mod"></h3>
								</div>

								<div class='form-group col-sm-2'>
									<h2>...</h2>
									<h3 class="flecha"></h3>
								</div>

								<div class='form-group col-sm-2'>
									<h2><b>Monturas</b></h2>
									<h3 id="mostrar_mont"></h3>
								</div>

							</div>
						</section>

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
</form>