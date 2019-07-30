@extends('layouts.app')
@section('title','Asignacion de modelos - '.config('app.name'))
@section('header','Asignacion de modelos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Asignacion de modelos </li>
	</ol>
@endsection
@section('content')

        @include('partials.flash')
        
		<!-- Formulario -->
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-danger box-solid">
					<div class="box-body">
						<form class="" action="{{ route('asignaciones.store') }}" method="POST" enctype="multipart/form-data">
							{{ method_field( 'POST' ) }}
							{{ csrf_field() }}

							<div class="col-sm-12">
								<h3 class="label-danger padding_1em"><i class="fa fa-user"></i> <i class="fa fa-arrow-left"></i>
								 	Nueva Asignacion
								</h3>
							</div>

							<div class="form-group col-sm-3">
								<label for="">Vendedor (usuario) </label>
								<select class="select2" name="user_id" required="" style="width: 100%;">
									@foreach($users as $user)
									<option value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-3">
								<label for="">Coleccion </label>
								<select class="select2" name="coleccion" id="coleccion" required="" style="width: 100%;">
									<option>Seleccione..</option>
									@foreach($colecciones as $c)
									<option value="{{ $c->id }}">{{ $c->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-3">
								<label for="">Marcas </label>
								<select class="select2" name="marcas" id="marcas" required="" style="width: 100%;">
								</select>
							</div>

							<div class="form-group col-sm-3">
								<label>-</label><br>
								<button class="btn btn-primary btn_sm" type="button" id="btn_cargar_modelos">
									 Cargar modelos
								</button>
								<hr>
							</div>

							<div class="col-lg-12 div_tablas_modelos">
							    <table class="table table-bordered table-striped">
							        <tr>
							            <td><span id="name_modelos"></span></td>
							        </tr>
							    </table>
							    <table class="table data-table table-bordered table-hover ok" width="100%">
							        <thead class="bg-primary">
							            <tr>
							                <th>[Codigo]</th>
							                <th>Nombre</th>
							                <th>Monturas disponibles</th>
							                <th>Estuches disponibles</th>
							                <th>Precio S/</th>
							                <th>Total S/</th>
							                <th><input type="checkbox" name="check_all_model" value="0" id="check_all_model" onclick="checkAllModelos()"></th>
							            </tr>
							        </thead>
							        <tbody id="data_modelos"></tbody>
							    </table>
							    <hr>
							</div>

							<div class="form-group col-lg-12 form-inline text-right">
							    <p class="text-uppercase pull-left text-info">
							        <i class="fa fa-info-circle"></i> Seleccione solo las monturas a asignar.
							    </p>    
							    <label class="">Total S/</label>
							    <input type="text" class="form-control total_consig" readonly="" name="total">
							    <button type="button" class="btn btn-flat btn-primary" data-toggle="tooltip" title="Calcular total por modelo y total definitivo" onclick="calcularMontoTotal();">
							        <i class="fa fa-arrow-right"></i> Calcular
							    </button>
							</div> 

							@if (count($errors) > 0)
        						<div class="col-sm-12">	
            			             <div class="alert alert-danger alert-important">
            			          	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            				            <ul>
            				            @foreach($errors->all() as $error)
            				              <li>{{$error}}</li>
            				            @endforeach
            				            </ul>  
            			             </div>
            			        </div> 
        			        @endif

        					<div class="form-group text-right col-sm-12">
        						<hr><br>
        			        	<em class="pull-left"><i class="fa fa-info-circle"></i> Seleccione solo las monturas de los modelos que desea asignar</em>
        			        	<a class="btn btn-flat btn-default" href="{{route('asignaciones.index')}}"><i class="fa fa-reply"></i> Atras</a>
        						<button class="btn btn-success btn_save_asig" type="submit" onclick="return confirm('Desea Asignar estos datos al usuario?');">
        							<i class="fa fa-save"></i> Guardar
        						</button>
        					</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection
@section("script")
<script>
	
	$(".btn_save_asig").prop("disabled", true);
	// busqueda de marcas en la coleccion
	$('#coleccion').change(function(event) {
		$.get("../marcasAll/"+event.target.value+"",function(response, dep){
			$("#marcas").empty();
			if (response.length > 0) {
				for (i = 0; i<response.length; i++) {
						$("#marcas").append(
							"<option value='"+response[i].marca.id+"'> "
								+response[i].marca.name+' | '+response[i].marca.material.name+
							"</option>");
				}
			}else{
				mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
			}
			$("#data_modelos").empty();
		});
	});

	// cargar modelos en la vista
	$("#btn_cargar_modelos").click(function(e) {
		e.preventDefault();
		nombre_modelo = "";
		montura_modelo = "";
		precio_montura_modelo = "";

		if ($("#coleccion").val() && $("#marcas").val()) {
			$("#data_modelos").empty();
			$("#name_modelos").empty();

			$.get("../modelosAll/"+$("#coleccion").val()+"/"+$("#marcas").val()+"",function(response, dep){

					$('.data-table').DataTable().destroy();
				    $("#data_modelos").html(response.data);
				    $("#name_modelos").html(response.model);
				    $("#precio_modelos").html(response.precio);
				    $('.data-table').DataTable({
				    	responsive: true,
					    language: {
					      	url:'{{asset("plugins/datatables/spanish.json")}}'
					    }
				    });
			});
		}else{
			mensajes("Alerta!", "Nada para mostrar, debe llenar todos los campos", "fa-warning", "red");
		}
	});

	// copiar y pegar modelo en buscador de la tabla y aplicar la busqueda
    $(".div_tablas_modelos").on("click", ".btn_nm", function(e) {
        e.preventDefault();
        $("table.data-table.ok input[type='search']").empty().val($(this).val());
        $('table.data-table.ok').DataTable().search($(this).val()).draw();    
    });

    // evitar el asignar
    $('.div_tablas_modelos').on("change", ".montura_modelo, .costo_modelo, .check_model", function(e) {
        $(".btn_save_asig").attr("disabled", "disabled");
    });

    // Calcular monto y total
    function calcularMontoTotal(){
        total = 0; error = false;
        if (comprobarCheckModelo() === true) {
	        $.each($("#data_modelos > tr"), function(index, val) {
	            montura = parseInt($(this).find('.montura_modelo').val());
	            precio  = parseFloat($(this).find('.costo_modelo').val());
	            check   = $(this).find('.hidden_model').val();

	            if (check == 1) {
		            if (!Number(montura)) {
		                costo = 0;
		                $(this).find('.costo_modelo').val(0);
		                $(this).find('.preciototal').val(0);
		            }else{
		                costo = montura * precio;
		                if (!Number(costo)) { 
		                    error = true;
		                }else{
		                    $(this).find('.preciototal').val(costo);
		                }
		            }

		            total += costo;
	            }else{
                    $(this).find('.preciototal').val('');
                }
	        });

	        if (error) {
	            mensajes("Alerta!", "El precio o la montura es incorrecta, deben ser solo numeros, verifique", "fa-remove", "red");
	            $(".btn_save_asig").prop("disabled", true);
	            return false;
	        }else{
	            if (Number(total) || total > 0) {
	                $(".btn_save_asig").removeAttr("disabled");
	            }else{
	                mensajes("Alerta!", "El total es incorrecto, verifique", "fa-remove", "red");
	                $(".btn_save_asig").prop("disabled", true);
	            }
	        }

	        $(".total_consig").val(total).animate({opacity: "0.5"}, 400).animate({opacity: "1"}, 400);

    	}
    }

</script>
@endsection
