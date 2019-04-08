@extends('layouts.app')
@section('title','Añadir Modelos - '.config('app.name'))
@section('header','Añadir modelos')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Añadir modelos </li>
    </ol>
@endsection
@section('content')
@include('partials.flash')

<div class="row">
  
    <div class="col-sm-4">
    	@include("colecciones.partials.show.panel_left")
    </div>
    
    <div class="col-sm-8 fondo_form">
        @include("colecciones.partials.show.panel_right")
    </div>
</div>
@include('colecciones.modals.marca.add_marca')
@endsection

@section("script")
<script>
    var cont = 1;
    var cont_mar = 1;
    var validarEstuche = '';

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
                                "<span>Nombre <span class='pull-right'><strong>Cod [00"+val2.id+"]</strong></span></span><br>"+
                                "<input type='text' class='form-control' name='name[]' value='"+val2.name+"' required='required' readonly>"+
                                "<input type='hidden' name='id[]' value='"+val2.id+"'>"+
                                "<span>Descripcion</span><br>"+
                                "<input type='text' class='form-control' name='descripcion_modelo[]' value='"+val2.descripcion_modelo+"' readonly>"+
                                "<span>Monturas [<strong>Actualmente ("+val2.montura+") monturas</strong>]</span>"+
                                "<span class='pull-right'><strong>Estuches ("+val2.estuche+")</strong></span><br>"+
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

    // cargar todas las marcas en modal
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

        if (id_marca == null) {
            mensajes("Alerta!", "La marca esta vacia", "fa-warning", "red");
        }else{
            $.get(ruta, function(res){
                
                if (res.marca.estuche == 1) {
                  $('.select_estuche').removeAttr("disabled").attr('name', 'estuche[]').val(12).attr("selected", true);
              	}else{
              		$('.select_estuche').attr("disabled", "disabled").removeAttr('name').val(0).attr("selected", true);
              	}
                
                $(".ruedas").val(res.rueda);
                $("#ruedas").val(res.rueda);
                $("#marca_id_2").val(res.marca_id);

                $("#btn_añadir_modelo").fadeIn(400, "linear");
                $("#sm").fadeIn(400, "linear");
                $("#btn_save_mod").fadeIn(400, "linear");

            });
        }

        $("#rm").fadeOut(400);
    });

    // añadir mas modelos a la coleccion
    $("#btn_añadir_modelo").click(function(e){
        var contador = cont++;
        
        $("#sm").append("<div id='div_campos"+contador+"'></div>");
        $("#div_campos"+contador+"").html($("#div_campos").html());
        $("#div_campos"+contador+"").append(
          "<div class='form-group col-sm-1 text-left' style='padding: 1.8em;'>"+
              "<button class='btn btn-danger' type='button' id='btn_delete_modelo"+contador+"'>"+
                  "<i class='fa fa-remove'></i>"+
              "</button>"+
          "</div>");

        $('#btn_delete_modelo'+contador+'').click(function(e){
          e.preventDefault();
          $('#div_campos'+contador+'').remove();
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
                $.each($('.nombre_modelo2'),function(index2, val2){
                     if(name == $(val2).val() && id_name !=  $(val2).attr('id')){
                         err++
                         $(this).css('border','red 2px solid');
                     }
                });
            });

            if(err > 0){
                mensajes("Alerta!", "No pueden nombres iguales en los modelos", "fa-warning", "red");
                return false;
            }else{

                var btn = $("#btn_save_mod");
                var token = $("#token").val();
                var ruta = '{{ route('modelos.store') }}';

                btn.addClass("disabled");
                $("#icon-save-modelo").removeClass("fa-save").addClass("fa-spinner fa-spin");

                var form = $(this);

                $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                })
                .done(function(data) {
                    btn.text("Guardado!");
                    $("#icon-save-modelo").removeClass("fa-spinner fa-spin").addClass("fa-save");
                    location.reload(400);
                })
                .fail(function(data) {
                    btn.text("Guardar Modelos");
                    btn.removeClass("disabled");
                    mensajes("Alerta!", "Nombre de modelo ya esta en uso", "fa-warning", "red");
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
                $("#rp").fadeIn(400);
                $("#modal_del").modal('toggle');
                btn.removeClass("disabled");
                location.reload(400);
            })
            .fail(function(data) {
                btn.text("Eliminar Modelos");
                btn.removeClass("disabled");
                mensajes("Alerta!", "intente de nuevo", "fa-warning", "red");
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
                $("#modal_upd").modal('toggle');
                btn.removeClass("disabled");
                location.reload(400);
            })
            .fail(function(data) {
                btn.text("Actualizar Modelos").removeClass("disabled");
                mensajes("Alerta!", "intente de nuevo", "fa-warning", "red");
            })
            .always(function() {
                console.log("complete");
            });

        });

        // añadir marcas
    		$(".btn_acm").click(function(e) {
    			e.preventDefault();
    			var btn = $(".btn_acm");
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
    			    cargarMarcas();
              cargarMarcasEnModal();
              mensajes("Listo!", "Marca añadida a la coleccion", "fa-check", "green");
    			})
    			.fail(function(data) {
    				btn.text("Guardar");
    				btn.removeClass("disabled");
            mensajes("Alerta!", "No se encuentran marcas disponibles, ya fueron añadidas", "fa-warning", "red");
    			})
    			.always(function() {
    				console.log("complete");
    			});

    		});

</script>
@endsection
