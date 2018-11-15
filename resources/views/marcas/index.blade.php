@extends('layouts.app')
@section('title','Marcas - '.config('app.name'))

@section('content')

	@include('partials.flash')
	@if (count($errors) > 0)
      <div class="alert alert-danger alert-important">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
      </div>
    @endif

	{{-- panel boxes --}}
	<div class="row">

	  	@include("marcas.partials.panelBox")

	</div>

	{{-- tablas --}}
	<div class="row">

		@include("marcas.partials.tableMarca")

	</div>

	{{-- modales --}}
	@include('marcas.modals.modal_create')
	@include('marcas.modals.modal_edit')


@endsection

@section('script')
	<script>
		/*function confirmar(){
		  Bootpop.ask('Si elimina esta propiedad seran eliminadas todos sus componentes (marcas, coleccion, modelos)', {
		    title: "Desea Eliminar?",
		    size: 'small',
		    modalHeader: true,
		    bodyClass: 'modal-body',
		    footerClass: 'modal-footer',
		    imageClass : 'img-responsive'
		  });
		}*/

		// buscar marca
		function MostrarMarca(btn_marca){
		  	var ruta = "edit_marca/"+btn_marca.value;
		    $("#re").fadeIn('slow/400/fast');

		  	$.get(ruta, function(res){
		    	$("#id_marca").val(res.id);
		    	$("#name_marca").val(res.name);
		    	$("#observacion_marca").val(res.observacion);
		    	$("#precio_marca_edit").val(res.precio);
		    	$("#material_id").val(res.material_id).attr("selected",true);
		  	});

		  	$("#re").fadeOut('slow/400/fast');
		}

		// buscar coleccion
		function MostrarColeccion(btn_col){
		  var ruta = "bus_col/"+btn_col.value;
		  $("#re_col").fadeIn('slow/400/fast');

		  $.get(ruta, function(res){
		    $("#id_col").val(res.id);
		    $("#name_col").val(res.name);
		    $("#marca_col").val(res.marca_id);
		  });

		  $("#re_col").fadeOut('slow/400/fast');
		}

		// buscar modelo
		function MostrarModelo(btn_mol){
		  $("#colec_mol").empty();
		  var ruta = "bus_mol/"+btn_mol.value;
		  $("#re_mol").fadeIn('slow/400/fast');

		  $.get(ruta, function(res){
		    $("#id_mol").val(res.id);
		    $("#mar_mol").val(res.marca_id);
		    $("#colec_mol").append("<option value='"+res.coleccion.id+"'>"+res.coleccion.name+" - "+res.coleccion.fecha_coleccion+"</option>");
		    $("#name_mol").val(res.name);
		    $("#cod_mol").val(res.codigo);
		    $("#des_mol").val(res.descripcion_modelo);
		  });

		  $("#re_mol").fadeOut('slow/400/fast');
		}

		// actualizar marcas
		$('#form_edit').on("submit", function(ev) {
		  ev.preventDefault();
		  var form = $(this);
		  var ruta = "{{ route('editMarcaSave') }}";
		  var btn = $('.btn_edit_marca');
		  btn.text('Espere...');

		  $.ajax({
		    url: ruta,
		    headers: {'X-CSRF-TOKEN': $("#token").val()},
		    type: 'POST',
		    dataType: 'JSON',
		    data: form.serialize(),
		  })
		  .done(function() {
		    $("#modal_edit").modal('toggle');
		    $("#reg").fadeIn('slow/400/fast').fadeOut(5000);
		    location.reload(2000);
		  })
		  .fail(function(data) {
		    $("#modal_edit").modal('toggle');
		    btn.text('Actualizar');
		    msj = data.responseText; 
			separador = ",";
			msj = msj.replace(/\{|\}|\"|\[|\]/gi," ");
			msj2 = msj.replace(/\,/gi,"\n\n");
			alert(msj2.toUpperCase());
		  })
		});

		// actualizar coleccion
		$('#form_edit_col').on("submit", function(ev) {
		  ev.preventDefault();
		  var form = $(this);
		  var ruta = "{{ route('editCol') }}";
		  var btn = $('.btn_save_col');
		  btn.text('Espere...');

		  $.ajax({
		    url: ruta,
		    headers: {'X-CSRF-TOKEN': $("#token").val()},
		    type: 'POST',
		    dataType: 'JSON',
		    data: form.serialize(),
		  })
		  .done(function() {
		    $("#modal_col").modal('toggle');
		    $("#reg_col").fadeIn('slow/400/fast').fadeOut(5000);
		    location.reload(2000);
		  })
		  .fail(function(msj) {
		      $("#modal_col").modal('toggle');
		      btn.text('Actualizar');
		  })
		});

		// actualizar modelos
		$('#form_edit_mol').on("submit", function(ev) {
		  ev.preventDefault();
		  var form = $(this);
		  var ruta = "{{ route('editMol') }}";
		  var btn = $('.btn_save_mol');
		  btn.text('Espere...');

		  $.ajax({
		    url: ruta,
		    headers: {'X-CSRF-TOKEN': $("#token").val()},
		    type: 'POST',
		    dataType: 'JSON',
		    data: form.serialize(),
		  })
		  .done(function() {
		    $("#modal_mol").modal('toggle');
		    $("#reg_mol").fadeIn('slow/400/fast').fadeOut(5000);
		    location.reload(2000);
		  })
		  .fail(function(msj) {
		      $("#modal_mol").modal('toggle');
		      btn.text('Actualizar');
		  })
		});

		// ----- busqueda de colecciones
		$('#mar').change(function(event) {
		  $.get("buscarM/"+event.target.value+"",function(response, col){
		    $("#colec").empty();
		    for (i = 0; i<response.length; i++) {
		        $("#colec").append("<option value='"+response[i].id+"'> "+response[i].name+" - "+response[i].fecha_coleccion+"</option>");
		    }
		  });
		});

		// ----- busqueda de colecciones edit
		$('#mar_mol').change(function(event) {
		  $.get("buscarM/"+event.target.value+"",function(response, col){
		    $("#colec_mol").empty();
		    for (i = 0; i<response.length; i++) {
		        $("#colec_mol").append("<option value='"+response[i].id+"'> "+response[i].name+" - "+response[i].fecha_coleccion+"</option>");
		    }
		  });
		});
	</script>
@endsection
