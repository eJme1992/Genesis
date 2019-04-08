@extends('layouts.app')
@section('title','Crear Coleccion - '.config('app.name'))
@section('header','Crear Coleccion')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Crear Coleccion </li>
	</ol>
@endsection
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
var validarEstuche = '';

// nueva coleccion (recargar)
$("#btn_new_col").click(function(e){
	location.reload(5000);
});

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
	var ruta = '{{ route("col_mar") }}';
	$("#col_mar").empty();
  	$.get(ruta, function(res){
  		$.each(res, function(index, val) {
    		$("#col_mar").append("<option value='"+val.marca.id+"'>"+val.marca.name+ " | ("+val.marca.material.name+")</option>");
    	});
  	});
}

// cargar proveedores
function cargarProv(){
	var ruta = '{{ route("allP") }}';
	$("#s_p").empty();
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
	$("#icon-cargar-marcas").addClass("fa-spinner fa-spin");
	$.get(ruta, function(res){

		if (res.msj != null){

	    	$("#sm").fadeOut(400);
	    	$("#btn_añadir_modelo").fadeOut(400);
	    	$("#btn_save_mod").fadeOut(400);
				mensajes("Alerta!", res.msj, "fa-warning", "red");
				$("#icon-cargar-marcas").removeClass("fa-spinner fa-spin");

		}else{
				$("#icon-span-estuche").empty();
				if (res.marca == 1) {
					$("#select_estuche").attr("name", "estuche[]").removeAttr('disabled').val(12);
					$("#icon-span-estuche").append("E <i class='fa fa-check-circle text-success'></i>");
					validarEstuche = 1;
				}else{
					$("#select_estuche").attr("disabled", "disabled").removeAttr('name').val(0);
					$("#icon-span-estuche").append("E <i class='fa fa-remove text-danger'></i>");
					validarEstuche = 0;
				}

	    	$("#mar_rueda").val(res.coleccion.rueda);
	    	$("#cant_ruedas").val(res.coleccion.rueda);
	    	$("#marca_id").val(res.coleccion.marca_id);

	    	$("#btn_añadir_modelo").fadeIn(400);
	    	$("#sm").fadeIn(400);
	    	$("#btn_save_mod").fadeIn(400);
				$("#icon-cargar-marcas").removeClass("fa-spinner fa-spin");

	    }

  });
});

// añadir mas marcas a la coleccion
$("#btn_añadir_marca").click(function(e){
	e.preventDefault();

	var contM = cont_mar++;

	$("#section_marca").append(
			"<div class='div_total_marcas"+contM+"'>"+
				"<div class='form-group col-sm-4'>"+
					"<label>Marcas</label>"+
					"<select name='marca_id[]' class='form-control s_m' required='' id='s_m_"+contM+"'>"+
						"<option value=''>Seleccione</option>"+cargarMarcas()+
					"</select>"+
				"</div>"+
				"<div class='form-group col-sm-2'>"+
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
				"<div class='form-group col-sm-2'>"+
					"<label>Precio de almacen</label>"+
					"<input type='number' step='0.01' max='999999999999' min='1' name='precio_almacen[]' class='form-control pa' required=''>"+
				"</div>"+
				"<div class='form-group col-sm-2'>"+
					"<label>Precio de venta establecido</label>"+
					"<input type='number' step='0.01' max='999999999999' min='1' name='precio_venta_establecido[]' class='form-control pve' required=''>"+
				"</div>"+
				"<div class='form-group col-sm-1 text-left' style='padding: 0.4em;'>"+
					"<br>"+
					"<button class='btn btn-danger' type='button' id='btn_delete_marca"+contM+"'>"+
						"<i class='fa fa-remove'></i>"+
					"</button>"+
				"</div>"+
			"</div>");

		$('#btn_delete_marca'+contM+'').click(function(e){
	      e.preventDefault();

	      $('.div_total_marcas'+contM+'').remove();
	      contM--;

	    });
});

// añadir mas modelos a la coleccion
$("#btn_añadir_modelo").click(function(e){
	var contador = cont++;

	$("#sm").append(
			"<br><div class='div_total"+contador+"'>"+
			"<div class='form-group col-sm-2'>"+
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
			"<div class='form-group col-sm-2' id='addDivEstuche"+contador+"'>"+
				"<label class='control-label'>Estuches: *</label>"+
					"<select name='estuche[]' class='form-control' required='' id='select_estuche"+contador+"'>"+
						"<option value='0'>0</option>"+
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
			"<div class='form-group col-sm-2'>"+
	        "<label>Descripcion </label>"+
	        "<input type='text' name='descripcion_modelo[]' class='form-control'>"+
	    "</div>"+
      "<div class='form-group col-sm-2'>"+
          "<label class='control-label'>Cajas </label>"+
          "<select name='caja[]' class='form-control'>"+
              "<option value='' selected></option>"+
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
			"<div class='form-group col-sm-1 text-left' style='padding: 1.8em;'>"+
				"<button class='btn btn-danger' type='button' id='btn_delete_modelo"+contador+"'>"+
					"<i class='fa fa-remove'></i>"+
				"</button>"+
			"</div>");

	$('#btn_delete_modelo'+contador+'').click(function(e){
      e.preventDefault();

      $('.div_total'+contador+'').remove();
      contador--;
    });
		
		// validar estuches
		addEstuches(contador);
});


// guardar marcas
$(".btn_cm").click(function(e) {
	e.preventDefault();
	var btn = $(".btn_cm");

	btn.addClass("disabled");
	$("#icon-save-marca").removeClass("fa-save").addClass("fa-spinner fa-spin");

	$.ajax({
		url: '{{ route("saveM") }}',
		headers: {'X-CSRF-TOKEN': $("#token").val()},
		type: 'POST',
		dataType: 'JSON',
		data: {
			name: $("#marca_name").val(),
			observacion: $('#marca_observacion').val(),
			material_id: $('#marca_material_id').val(),
			estuche: $('#estuche').val()
		},
	})
	.done(function(data) {
		$("#modal_marca").modal('toggle');
	    btn.removeClass("disabled");
			$("#icon-save-marca").removeClass("fa-spinner fa-spin").addClass("fa-save");
	    cargarMarcas();
	})
	.fail(function(data) {
		btn.removeClass("disabled");
		$("#icon-save-marca").removeClass("fa-spinner fa-spin").addClass("fa-save");
		mensajes("Alerta!", eachErrors(data), "fa-warning", "red");
	})
	.always(function() {
		console.log("complete");
	});

});

// guardar proveedores
$(".btn_cp").click(function(e) {
	e.preventDefault();
	var btn = $(".btn_cp");

	btn.text("Espere un momento...").addClass("disabled");

	$.ajax({
		url: '{{ route("saveP") }}',
		headers: {'X-CSRF-TOKEN': $("#token").val()},
		type: 'POST',
		dataType: 'JSON',
		data: {
			nombre_pro: $("#nombre_pro").val(),
			telefono: $("#telefono").val(),
			correo: $("#correo").val(),
			empresa:$("#empresa").val(),
			ruc:$("#ruc").val(),
			direccion: $("#direccion").val(),
			observacion: $("#observacion").val()
		},
	})
	.done(function(data) {
		$("#cp").modal('toggle');
	    btn.text("Guardar");
	    btn.removeClass("disabled");
	    cargarProv();
	})
	.fail(function(data) {
		btn.text("Guardar");
		btn.removeClass("disabled");
		mensajes("Alerta!", eachErrors(data), "fa-warning", "red");
	})
	.always(function() {
		console.log("complete");
	});

});


// guardar coleccion
$("#btn_save_col").click(function(e) {
	e.preventDefault();
	btn = $("#btn_save_col");
	btn.addClass("disabled");
	$("#icon-save-coleccion").removeClass("fa-save").addClass("fa-spinner fa-spin");

	$.ajax({
		url: '{{ route("saveCol") }}',
		headers: {'X-CSRF-TOKEN': $("#token").val()},
		type: 'POST',
		dataType: 'JSON',
		data: {
			name: $("#name").val(),
			fecha_coleccion: $("#fecha").val(),
			codigo: $("#codigo").val(),
			proveedor_id: $("#s_p").val()
		},
	})
	.done(function(data) {
		btn.addClass("hide");
		$("#btn_prove").addClass("hide");
		$("#id_col").val(data.id);
		$("#id_col2").val(data.id);
		$("#fecha").attr("readonly", "readonly").removeClass("fecha hasDatepicker");
		$("#name").attr("readonly", "readonly");
		$("#s_p").attr("disabled", "disabled");
		$("#section_marcas").fadeIn(400);
		mensajes("Listo!", "Coleccion creada con exito!", "fa-check", "green");
	})
	.fail(function(data) {
		mensajes("Alerta!", eachErrors(data), "fa-warning", "red");
		$("#icon-save-coleccion").removeClass("fa-spinner fa-spin").addClass("fa-save");
		btn.removeClass("disabled");
	})
	.always(function() {
		console.log("complete");
	});

});

// guardar marcas relacionadas a la coleccion
$("#form_mc").on("submit", function(e) {
	e.preventDefault();
	var err = 0;
	var err_2 = 0;

	$.each($('.s_m'),function(index, val){
		name = $(val).val();
		id_name = $(val).attr('id');
		$.each($('.s_m'),function(index2, val2){
			 if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
				 err++
				 $(this).css('border','red 2px solid');
			 }
		});
	});

	if(err > 0){
			mensajes("Alerta!", "No pueden haber 2 marcas iguales", "fa-warning", "red");
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
			if (data == 1) {
				mensajes("Error!", "El precio de venta establecido no puede ser menor al precio de costo de almacen", "fa-warning", "red");
				btn.text("Guardar marcas").removeClass("disabled");
			}else{
				mensajes("Listo!", "Marcas añadidas a la coleccion", "fa-check", "green");
				cargarColMar();
			  $("#form_mc").remove();
				$("#section_modelos").fadeIn(400);
				$("#btn_new_col").fadeIn(400);

				// añadir href al link de añadir mas marcas
				link = '{{ route("colecciones.show","id_col2") }}';
    		link = link.replace('id_col2', $("#id_col2").val());
				$("#link_mas_marcas").attr('href', link);
			}

		})
		.fail(function(data) {
			btn.text("Guardar marcas").removeClass("disabled");
			mensajes("Alerta!", eachErrors(data), "fa-warning", "red");
		})
		.always(function() {
			console.log("complete");
		});
	}
});

// guardar modelos en la coleccion y marca
$("#form_modelos").on("submit", function(e) {
	e.preventDefault();
	var err = 0;

	$.each($('.nombre_modelo'),function(index, val){
		name = $(val).val();
		id_name = $(val).attr('id');
		$.each($('.nombre_modelo'),function(index2, val2){
			 if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
				 err++
				 $(this).css('border','red 2px solid');
			 }
		});
	});

	if(err > 0){
		mensajes("Alerta!", "No pueden haber nombres iguales en los modelos", "fa-warning", "red");
		return false;
	}else{

		var btn = $("#btn_save_mod");
		var token = $("#token").val();
		var ruta = '{{ route("modelos.store") }}';

		btn.text("Espere un momento...").addClass("disabled");

		var form = $(this);

		$.ajax({
			url: ruta,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'JSON',
			data: form.serialize(),
		})
		.done(function(data) {
			$("#sm").fadeOut(400);
			$(".div_total"+cont+"").empty();
			$("#btn_añadir_modelo").fadeOut(400);
			mensajes("Listo!", "Modelos añadidos a la coleccion", "fa-success", "green");
			btn.text("Guardar Modelos").removeClass("disabled").fadeOut(400);
			cont = 0;
		})
		.fail(function(data) {
			btn.text("Guardar").removeClass("disabled");
			mensajes("Alerta!", eachErrors(data), "fa-warning", "red");
		})
		.always(function() {
			console.log("complete");
		});
	}

});
</script>
@endsection
