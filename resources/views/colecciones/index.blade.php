@extends('layouts.app')
@section('title','Coleccion - '.config('app.name'))

@section('content')

	@include('partials.flash')

	{{-- tablas --}}
	<div class="row">
		@include("colecciones.partials.form")
	</div>

@endsection

@section('script')
	<script>
		var cont = 1;
		var cont_mar = 1;

		// cargar todas las marcas
		function cargarMarcas(){
			$(".s_m").empty();
			var ruta = '{{ route("allM") }}';
		  	$.get(ruta, function(res){
		  		$.each(res, function(index, val) {
		    		$(".s_m").append("<option value='"+val.id+"'>"+val.name+ " | ("+val.material.name+")</option>");
		    	});
		  	});
		}

		// cargar las marcas de dicha coleccion
		function cargarColMar(){
			$("#col_mar").empty();
			var ruta = '{{ route("col_mar") }}';
		  	$.get(ruta, function(res){
		  		$.each(res, function(index, val) {
		    		$("#col_mar").append("<option value='"+val.marca.id+"'>"+val.marca.name+ " | ("+val.marca.material.name+")</option>");
		    	});
		  	});
		}

		// cargar proveedores
		function cargarProv(){
			$("#s_p").empty();
			var ruta = '{{ route("allP") }}';
		  	$.get(ruta, function(res){
		  		$.each(res, function(index, val) {
		    		$("#s_p").append("<option value='"+val.id+"'>"+val.nombre+" / "+val.empresa+"</option>");
		    	});
		  	});
		}

		// cargar marca y mostrar campos de modelos
		$("#btn_carga_mar").click(function(e){
			e.preventDefault();
		    $("#sm2").empty();

			var id_marca = $("#col_mar").val();
			var id_col = $("#id_col2").val();
			var ruta = 'buscarM/'+id_marca+'/'+id_col+'';
			$.get(ruta, function(res){

			if (res.msj != null){

		    	$("#sm").fadeOut(400, "linear");
		    	$("#btn_añadir_modelo").fadeOut(400, "linear");
		    	$("#btn_save_mod").fadeOut(400, "linear");
				alert("ya ha sido llenada esta marca");

			}else{

		    	$("#mar_rueda").val(res.rueda);
		    	$("#cant_ruedas").val(res.rueda);
		    	$("#marca_id").val(res.marca_id);

		    	$("#btn_añadir_modelo").fadeIn(400, "linear");
		    	$("#sm").fadeIn(400, "linear");
		    	$("#btn_save_mod").fadeIn(400, "linear");

		    }

		  	});
		});

		// añadir mas marcas a la coleccion
		$("#btn_añadir_marca").click(function(e){
			e.preventDefault();

			var contM = cont_mar++;

			$('#btn_delete_marca'+contM+'').click(function(e){
              e.preventDefault();

              $('.div_total_marcas'+contM+'').remove();
              contM--;

            });

			$("#section_marca").append(
					"<div class='div_total_marcas"+contM+"'>"+
						"<div class='form-group col-sm-5'>"+
							"<label>Marcas</label>"+
							"<select name='marca_id[]' class='form-control s_m' required='' id='s_m_"+contM+"'>"+
								"<option value=''>Seleccione</option>"+cargarMarcas()+
							"</select>"+
						"</div>"+
						"<div class='form-group col-sm-3'>"+
							"<label>Ruedas</label>"+
							"<select name='rueda[]' class='form-control ru' required=''>"+
								"<option value='1'>1</option>"+
								"<option value='2'>2</option>"+
								"<option value='3'>3</option>"+
								"<option value='4'>4</option>"+
								"<option value='5'>5</option>"+
								"<option value='6'>6</option>"+
								"<option value='7'>7</option>"+
								"<option value='8'>8</option>"+
								"<option value='9'>9</option>"+
								"<option value='10'>10</option>"+
								"<option value='11'>11</option>"+
								"<option value='12'>12</option>"+
								"<option value='13'>13</option>"+
								"<option value='14'>14</option>"+
								"<option value='15'>15</option>"+
								"<option value='16'>16</option>"+
								"<option value='17'>17</option>"+
								"<option value='18'>18</option>"+
								"<option value='19'>19</option>"+
								"<option value='20'>20</option>"+
							"</select>"+
						"</div>"+
						"<div class='form-group col-sm-2 text-left' style='padding: 0.4em;'>"+
							"<br>"+
							"<button class='btn btn-danger' type='button' id='btn_delete_marca"+contM+"'>"+
								"<i class='fa fa-remove'></i>"+
							"</button>"+
						"</div>"+
					"</div>"
				);
			$('#btn_delete_marca'+contM+'').click(function(e){
              e.preventDefault();

              $('.div_total_marcas'+contM+'').remove();
              contM--;

            });
		});

		// añadir mas modelos a la coleccion
		$("#btn_añadir_modelo").click(function(e){
			var contador = cont++;

			$('#btn_delete_modelo'+contador+'').click(function(e){
              e.preventDefault();

              $('.div_total'+contador+'').remove();
              contador--;

            });

			$("#sm").append(
					"<div class='div_total"+contador+"'>"+
					"<div class='form-group col-sm-3'>"+
						"<label class='control-label' for='name'>Nombre modelo: *</label>"+
							"<input type='text' name='name[]' class='form-control nombre_modelo' id='nombre_modelo_"+contador+"' required=''>"+
					"</div>"+
					"<div class='form-group col-sm-2'>"+
						"<label class='control-label'>Cantidad Monturas: *</label>"+
							"<select name='montura[]' class='form-control' required=''>"+
								"<option value='1'>1</option>"+
								"<option value='2'>2</option>"+
								"<option value='3'>3</option>"+
								"<option value='4'>4</option>"+
								"<option value='5'>5</option>"+
								"<option value='6'>6</option>"+
								"<option value='7'>7</option>"+
								"<option value='8'>8</option>"+
								"<option value='9'>9</option>"+
								"<option value='10'>10</option>"+
								"<option value='11'>11</option>"+
								"<option value='12' selected>12</option>"+
							"</select>"+
					"</div>"+
					"<div class='form-group col-sm-5'>"+
						"<label>Descripcion </label>"+
							"<textarea name='descripcion_modelo[]' class='form-control'></textarea>"+
					"</div>"+
					"<div class='form-group col-sm-1 text-left' style='padding: 1.8em;'>"+
						"<button class='btn btn-danger' type='button' id='btn_delete_modelo"+contador+"'>"+
							"<i class='fa fa-remove'></i>"+
						"</button>"+
					"</div>"
					);

			$('#btn_delete_modelo'+contador+'').click(function(e){
              e.preventDefault();

              $('.div_total'+contador+'').remove();
              contador--;
            });

		});


		// nueva coleccion (recargar)
		$("#btn_new_col").click(function(e){
			location.reload(5000);
		});


		// guardar marcas
		$(".btn_cm").click(function(e) {
			e.preventDefault();
			var btn = $(".btn_cm");
			var token = $("#token").val();
			var ruta = '{{ route("saveM") }}';

			btn.text("Espere un momento...");
			btn.addClass("disabled");

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {name: $("#marca_name").val(), observacion: $('#marca_observacion').val(), material_id: $('#marca_material_id').val(), precio: $("#precio_marca").val()},
			})
			.done(function(data) {
				$("#modal_marca").modal('toggle');
			    btn.text("Guardar");
			    btn.removeClass("disabled");
			    cargarMarcas();
			})
			.fail(function(data) {
				msj = data.responseText;
				msj = msj.replace(/\{|\}|\"|\[|\]/gi," ");
				msj2 = msj.replace(/\,/gi,"\n\n");
				btn.text("Guardar");
				btn.removeClass("disabled");
				alert(msj2.toUpperCase());
			})
			.always(function() {
				console.log("complete");
			});

		});

		// guardar proveedores
		$(".btn_cp").click(function(e) {
			e.preventDefault();
			var btn = $(".btn_cp");
			var token = $("#token").val();
			var ruta = '{{ route("saveP") }}';

			btn.text("Espere un momento...");
			btn.addClass("disabled");

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {nombre_pro: $("#nombre_pro").val(), telefono: $("#telefono").val(), correo: $("#correo").val(), empresa:$("#empresa").val(), ruc:$("#ruc").val(), direccion: $("#direccion").val(), observacion: $("#observacion").val() },
			})
			.done(function(data) {
				$("#cp").modal('toggle');
			    btn.text("Guardar");
			    btn.removeClass("disabled");
			    cargarProv();
			})
			.fail(function(data) {
				msj = data.responseText; 
				separador = ",";
				msj = msj.replace(/\{|\}|\"|\[|\]/gi," ");
				msj2 = msj.replace(/\,/gi,"\n");
				alert(msj2.toUpperCase());
				btn.text("Guardar");
				btn.removeClass("disabled");
			})
			.always(function() {
				console.log("complete");
			});

		});


		// guardar coleccion
		$("#btn_save_col").click(function(e) {
			e.preventDefault();
			var btn = $("#btn_save_col");
			var token = $("#token").val();
			var ruta = '{{ route("saveCol") }}';

			btn.text("Espere un momento...");
			btn.addClass("disabled");

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {name: $("#name").val(), fecha_coleccion: $("#fecha").val(), codigo: $("#codigo").val(), proveedor_id: $("#s_p").val() },
			})
			.done(function(data) {
				$("#id_col").val(data.id);
				$("#id_col2").val(data.id);
				$("#msj_col").fadeIn(400, "linear");

				$("#fecha").attr("readonly", "readonly");
				$("#fecha").removeClass("fecha");
				$("#name").attr("readonly", "readonly");
				$("#s_p").attr("disabled", "disabled");
				$("#btn_prove").addClass("hide");
				btn.addClass("hide");

				$("#section_marcas").fadeIn(400, "linear");
			})
			.fail(function(data) {
				msj = data.responseText; 
				separador = ",";
				msj = msj.replace(/\{|\}|\"|\[|\]/gi," ");
				msj2 = msj.replace(/\,/gi,"\n\n");
				btn.text("Guardar");
				btn.removeClass("disabled");
				alert(msj2.toUpperCase());
			})
			.always(function() {
				console.log("complete");
			});

		});

		// guardar marcas relacionadas a la coleccion
		$("#form_mc").on("submit", function(e) {
			e.preventDefault();
			var err = 0;

			$.each($('.s_m'),function(index, val){
				name = $(val).val();
				id_name = $(val).attr('id');
				campo = this.id;
				//console.log('val1 :'+$(val).valal())
				//console.log(id1)
				$.each($('.s_m'),function(index2, val2){
					//console.log('v2 :'+$(v2).val())
					 if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
						 err++
						 $(this).css('border','red 2px solid');
					 }
				});
			});

			if(err > 0){
					alert("No pueden haber 2 marcas iguales")
					return false;
			}else{
				var btn = $("#btn_save_mar");
				var token = $("#token").val();
				var ruta = '{{ route("colecciones.store") }}';
				var form = $("#form_mc").serialize();

				btn.text("Espere un momento...");
				btn.addClass("disabled");

				$.ajax({
					url: ruta,
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'JSON',
					data: form,
				})
				.done(function(data) {
					$("#msj_mar").fadeIn(400, "linear");
					$("#form_mc").remove();
					cargarColMar();
					$("#section_modelos").fadeIn(400, "linear");
					$("#btn_new_col").fadeIn(400, "linear");

				})
				.fail(function(data) {
					btn.text("Guardar marcas");
					btn.removeClass("disabled");
					alert("error! intente de nuevo");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});

		// guardar modelos
		$("#form_modelos").on("submit", function(e) {
			e.preventDefault();
			var err = 0;

			$.each($('.nombre_modelo'),function(index, val){
				name = $(val).val();
				id_name = $(val).attr('id');
				campo = this.id;
				//console.log('val1 :'+$(val).valal())
				//console.log(id1)
				$.each($('.nombre_modelo'),function(index2, val2){
					//console.log('v2 :'+$(v2).val())
					 if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
						 err++
						 $(this).css('border','red 2px solid');
					 }
				});
			});

			if(err > 0){
					alert("No pueden haber nombres iguales en los modelos")
					return false;
			}else{

				var btn = $("#btn_save_mod");
				var token = $("#token").val();
				var ruta = '{{ route('modelos.store') }}';

				btn.text("Espere un momento...");
				btn.addClass("disabled");

				var form = $(this);

				$.ajax({
					url: ruta,
					headers: {'X-CSRF-TOKEN': token},
					type: 'POST',
					dataType: 'JSON',
					data: form.serialize(),
				})
				.done(function(data) {
					$("#sm").empty();
					$("#btn_añadir_modelo").fadeOut(400, "linear");
					$("#msj_mod").fadeIn(400, "linear");
					btn.text("Guardar Modelos");
					btn.removeClass("disabled");
					btn.fadeOut(400, "linear");
					cont = 0;
				})
				.fail(function(data) {
					btn.text("Guardar Modelos");
					btn.removeClass("disabled");
					alert("error! intente de nuevo");
				})
				.always(function() {
					console.log("complete");
				});
			}

		});
	</script>
@endsection
