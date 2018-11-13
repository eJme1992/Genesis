@extends('layouts.app')
@section('title','Añadir Modelos - '.config('app.name'))

@section('content')
@include('partials.flash')

<div class="row">
    <div class="col-sm-4">
    	<div class="panel panel-default">
        <div class="panel-heading">
          <h3>
            <span style="padding: 0.4em; color:#525ad0; border-bottom: solid 1px #525ad0; border-radius:1em;">Codigo {{ $coleccion->codigo }}</span>
          </h3>
        </div>
        <div class="panel-body" style="margin-left: 0.5em;">
          <em>Nombre </em>
          <span class="text-capitalize h4 list-group-item"><i class="fa fa-arrow-right"></i>  {{ $coleccion->name }}</span><br>
          <em>fecha </em>
          <span class="text-capitalize h4 list-group-item"><i class="fa fa-arrow-right"></i>  {{ $coleccion->fecha_coleccion }}</span><br>
          <em>Marcas <span class="label label-primary">{{ $coleccion->cm->count() }}</span></em>
            @foreach($coleccion->cm as $marcas)
            <span class="text-capitalize list-group-item">
              <div class="row">
                @if($marcas->marca->name)
                <div class="col-sm-8">
                  <i class="fa fa-arrow-right"></i>  {{ $marcas->marca->name }} | ({{ $marcas->marca->material->name }})
                </div>
                <div class="col-sm-4 text-right">
                  <form action="{{ url('marcas/'.$marcas->marca->id.'/'.$coleccion->id.'/destroy') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn-link" type="submit" onclick="return confirm('Desea eliminar la marca con todas sus dependencias y modelos? S/N?');"><i class="fa fa-trash text-danger"></i>
                    </button>
                  </form>
                </div>
                @endif
                <div class="col-sm-12" style="color:#525ad0;">
                    <i class="fa fa-arrow-right"></i> Modelos({{ $marcas->marca->mc($coleccion->id, $marcas->marca->id) }})

                    @if($marcas->marca->mc($coleccion->id, $marcas->marca->id) > 0)
                        <div class="pull-right">

                          <button type="button" id="btn_upd_mod" value="{{ $marcas->marca->id }}"
                            data-toggle="modal" data-target="#modal_upd"
                            aria-expanded="false" aria-controls="modal_upd"
                            class="btn-link" onclick="UpdateModelo(this);" data-toggle="tooltip" data-placement="top" title="Actualizar modelos">
                            <i class="fa fa-edit" style="color: orange;"></i>
                          </button>
                          <button type="button" id="btn_del_mod" value="{{ $marcas->marca->id }}"
                          data-toggle="modal" data-target="#modal_del"
                          aria-expanded="false" aria-controls="modal_del"
                          class="btn-link" onclick="DeleteModelo(this);" data-toggle="tooltip" data-placement="top" title="Eliminar modelos">
                              <i class="fa fa-trash text-danger"></i>
                          </button>

                      </div>
                    @endif

                </div>
              </div>
            </span>
            <br>
            @endforeach
            @include("colecciones.modals.modal_del")
            @include("colecciones.modals.modal_upd")
        </div>
      </div>
      <span>
        <a href="{{ route('colecciones.ver') }}" class="btn btn-primary text-left"><i class="fa fa-arrow-left"></i> Atras</a>
        <span id="reloadpage" style="display:none;" class="text-center">
            <i class="fa fa-spinner fa-pulse fa-fw text-primary"></i>
        </span>
      </span>
    </div>
    <div class="col-sm-8 fondo_form">
        <div class="form-group col-sm-4">
            <label for="">
              Seleccione Marca(*)
              [<a href="#cm" class="btn-link" data-toggle="modal" data-target="#cm">
                <span class="text-primary"><i class="fa fa-plus"></i> Añadir</span>
              </a>]
              @include('colecciones.modals.cm2')
            </label>
            <select name="marca_id" id="marca" class="form-control" required="">
                @foreach($coleccion->marcas as $marca)
                <option value="{{ $marca->id }}">{{ $marca->name }} | ({{ $marca->material->name }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-4" style="margin-top: 1.9em;">
            <button class="btn btn-primary btn-sm" type="button" id="btn_buscar_marca">Cargar</button>
            <span id="rm" style="display:none;" class="text-center">
                <i class="fa fa-refresh fa-pulse fa-fw text-primary"></i>
            </span>
        </div>
        <div class="form-group col-sm-4">
            <label>Nº de Ruedas</label>
            <input type="text" readonly="" class="form-control" id="ruedas">
        </div>
        <div class="col-sm-12">

            <!-- formulario de modelos -->
            <form id="form_modelos2" method="POST">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type='hidden' name='marca_id' id="marca_id_2">
                <input type="hidden" name="rueda" class="ruedas">
                <input type="hidden" value="{{ $coleccion->id }}" id="coleccion" name="id_coleccion">

                <section id="sm" style="display: none;">
                    <div class="div_total">
                        <div class='form-group col-sm-3'>
                            <label class='control-label' for='name'>Nombre modelo: *</label>
                                <input type='text' name='name[]' class='form-control nombre_modelo2' id="nombre_modelo_0" required=''>
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
                        <div class='form-group col-sm-5'>
                            <label>Descripcion </label>
                                <textarea name='descripcion_modelo[]' class='form-control'></textarea>
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
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    var cont = 1;
    var cont_mar = 1;

	// cargar todas las marcas
    function DeleteModelo(btn_del_mod){
        $("#data").empty();

        $("#em").fadeIn(400);
        var id_coleccion = $("#coleccion").val();
        var ruta = '../eliminarModelo/'+id_coleccion+'/'+btn_del_mod.value+'';
        $.get(ruta, function(res){
            $.each(res, function(index, val) {
                $.each(val, function(index2, val2) {
                $("#id_col_del").val(val2.coleccion_id);
                $("#id_mar_del").val(val2.marca_id);
                 $("#nombre_de_la_marca").html(
                    "Eliminar todos los de modelos de <span class='text-primary'>"+val2.marca.name+" | ("+val2.marca.material.name+")?</span>");
                    // $("#data").append(
                    //     "<li class='list-group-item'>"+
                    //         "<span><b>Total de modelos: </b>"+" "+val2.name+"</span><br>"+
                    //         "<span><b>Descripcion: </b>"+" "+val2.descripcion_modelo+"</span><br>"+
                    //         "<span><b>Montura: </b>"+" "+val2.montura+"</span><br>"+
                    //         "<span><b>Status: </b>"+" "+val2.status.name+"</span>"+
                    //     "</li>"
                    // );
                });
            });
        });

        $("#em").fadeOut(400);
    }

    // cargar todas las marcas y actualizar modelos
      function UpdateModelo(btn_upd_mod){
          $("#dataM").empty();

          $("#em2").fadeIn(400);

          var id_coleccion = $("#coleccion").val();
          var ruta = '../actualizarModelo/'+id_coleccion+'/'+btn_upd_mod.value+'';
          $.get(ruta, function(res){
              $.each(res, function(index, val) {
                  $.each(val, function(index2, val2) {
                  $("#id_col_upd").val(val2.coleccion_id);
                  $("#id_mar_upd").val(val2.marca_id);
                   $("#nombre_de_la_marca2").html("Marca <span class='text-primary'>"+val2.marca.name+"</span>");
                      $("#dataM").append(
                          "<li class='list-group-item'>"+
                              "<div class='form-group'>"+
                                "<span>Nombre <span class='pull-right'>Cod <i>[00"+val2.id+"]</i></span></span><br>"+
                                "<input type='text' class='form-control' name='name[]' value='"+val2.name+"' required='required' readonly>"+
                                "<input type='hidden' name='id[]' value='"+val2.id+"'>"+
                                "<span>Descripcion</span><br>"+
                                "<input type='text' class='form-control' name='descripcion_modelo[]' value='"+val2.descripcion_modelo+"' readonly>"+
                                "<span>Monturas [<em>Actualmente ("+val2.montura+") monturas</em>]</span><br>"+
                                "<select name='montura[]' class='form-control'>"+
                                        "<option value='' selected>seleccione...</option>"+
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
                                "</select>"+
                                "<span class='pull-right label label-primary'><b>Status: </b>"+" "+val2.status.name+"</span>"+
                              "</div>"+
                          "</li><br>"
                      );
                  });
              });
          });

          $("#em2").fadeOut(400);
      }

    // cargar todas las marcas
    function cargarMarcas(){
        $("#marca").empty();
        var id_coleccion = $("#coleccion").val();
        var ruta = '../buscarMC/'+id_coleccion+'';
        $.get(ruta, function(res){
            $.each(res, function(index, val) {
                $("#marca").append("<option value='"+val.id+"'>"+val.name+" | ("+val.material.name+")</option>");
            });
        });
    }

    // cargar todas las marcas
	function cargarMarcasEnModal(){
		$("#marca_id").empty();
        var id_coleccion = $("#coleccion").val();
        var ruta = '../marDisponible/'+id_coleccion+'';
	  	$.get(ruta, function(res){
	  		$.each(res, function(index, val) {
	    		$("#marca_id").append("<option value='"+val.id+"'>"+val.name+" | ("+val.material.name+")</option>");
	    	});
	  	});
	}

    // cargar marca y mostrar campos de modelos
    $("#btn_buscar_marca").click(function(e){
        e.preventDefault();
        $("#sm").fadeOut(400);
        $("#rm").fadeIn(400);

        var id_marca = $("#marca").val();
        var id_coleccion = $("#coleccion").val();
        var ruta = '../buscarMarcaColeccion/'+id_coleccion+'/'+id_marca+'';
        $.get(ruta, function(res){

            $(".ruedas").val(res.rueda);
            $("#ruedas").val(res.rueda);
            $("#marca_id_2").val(res.marca_id);

            $("#btn_añadir_modelo").fadeIn(400, "linear");
            $("#sm").fadeIn(400, "linear");
            $("#btn_save_mod").fadeIn(400, "linear");

        });

        $("#rm").fadeOut(400);
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
                            "<input type='text' name='name[]' class='form-control nombre_modelo2' id='nombre_modelo_"+contador+"' required=''>"+
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


        // guardar modelos
        $("#form_modelos2").on("submit", function(e) {
            e.preventDefault();
            var err = 0;

            $.each($('.nombre_modelo2'),function(index, val){
                name = $(val).val();
                id_name = $(val).attr('id');
                campo = this.id;
                $.each($('.nombre_modelo2'),function(index2, val2){
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
                    btn.text("Guardado! espere....");
                    btn.removeClass("disabled");
                    location.reload(400);
                })
                .fail(function(data) {
                    btn.text("Guardar Modelos");
                    btn.removeClass("disabled");
                    alert("error! Nombre de modelo ya esta en uso");
                })
                .always(function() {
                    console.log("complete");
                });
            }

        });

        // eliminar modelos
        $("#form_del_modelos").on("submit", function(e) {
            e.preventDefault();

                var btn = $("#btn_save_mod");
                var token = $("#token").val();
                var ruta = '{{ route('modelos.delete') }}';

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
                    $("#rp").fadeIn(400);
                    $("#modal_del").modal('toggle');
                    btn.removeClass("disabled");
                    location.reload(400);
                })
                .fail(function(data) {
                    btn.text("Eliminar Modelos");
                    btn.removeClass("disabled");
                    alert("error! intente de nuevo");
                })
                .always(function() {
                    console.log("complete");
                });

        });

        // actualizar modelos
        $("#form_upd_modelos").on("submit", function(e) {
            e.preventDefault();

                var btn = $(".btn_actualizar_modelos");
                var token = $("#token").val();
                var ruta = '{{ route('updateAll') }}';

                btn.text("Espere un momento...");
                btn.addClass("disabled");

                var form = $(this);

                $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'PUT',
                    dataType: 'JSON',
                    data: form.serialize(),
                })
                .done(function(data) {
                    $("#reloadpage").fadeIn(400);
                    $("#modal_upd").modal('toggle');
                    btn.removeClass("disabled");
                    location.reload(400);
                })
                .fail(function(data) {
                    btn.text("Actualizar Modelos");
                    btn.removeClass("disabled");
                    alert("error! intente de nuevo");
                })
                .always(function() {
                    console.log("complete");
                });

        });

        // añadir marcas
    		$(".btn_cm").click(function(e) {
    			e.preventDefault();
    			var btn = $(".btn_cm");
    			var token = $("#token").val();
    			var ruta = '{{ route("saveMC") }}';

    			btn.text("Espere un momento...");
    			btn.addClass("disabled");

    			$.ajax({
    				url: ruta,
    				headers: {'X-CSRF-TOKEN': token},
    				type: 'POST',
    				dataType: 'JSON',
    				data: {marca: $("#marca_id").val(), rueda: $('#ru').val(), coleccion: $('#coleccion').val()},
    			})
    			.done(function(data) {
    				$("#cm").modal('toggle');
    			    btn.text("Guardar");
    			    btn.removeClass("disabled");
              alert("Marca Añadida a la coleccion");
    			    cargarMarcas();
              cargarMarcasEnModal();
    			})
    			.fail(function(data) {
    				btn.text("Guardar");
    				btn.removeClass("disabled");
    				alert("error! no hay marcas disponibles");
    			})
    			.always(function() {
    				console.log("complete");
    			});

    		});

</script>
@endsection
