@extends('layouts.app')
@section('title','Consultas y Modelos - '.config('app.name'))
@section('header','Consultas y Modelos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Consultas y Modelos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	  <div class="row">
	  	<div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

	        <div class="info-box-content">
	          <span class="info-box-text">Consultas y Modelos</span>
	          <span class="info-box-number">{{ count($productos) }}</span>
	        </div>
	        <!-- /.info-box-content -->
	      </div>
	      <!-- /.info-box -->
	    </div>
	  </div><!--row-->

	<div class="row">

  		@include("productos.partials.productos")

	</div>
	@include("productos.modal_users")
	@include("productos.modal_mod")
@endsection
@section('script')
<script>
		// buscar modelos
		function mod(btn_pro){
		  var ruta = "busmod/"+btn_pro.value;
		  $("#rm").fadeIn('slow/400/fast');
		  $("#data1").empty();
		  $.get(ruta, function(res){
		    $.each(res, function(index, val) {
		    	$("#data1").append(
		    		"<div class='list-group'>"+
		    			"<h3 class='text-capitalize'>"+val.marca.name+" | ("+val.marca.material.name+")<span class='pull-right'>Cod [00"+val.id+"]</span></h3>"+
			    		"<li class='list-group-item'>"+
							"<span><b>Nombre: </b>"+" "+val.name+"</span><br>"+
							"<span><b>Descripcion: </b>"+" "+val.descripcion_modelo+"</span><br>"+
							"<span><b>Montura: </b>"+" "+val.montura+"</span><br>"+
							"<span><b>Status: </b>"+" "+val.status.name+"</span>"+
						"</li>"+
		    		"</div>");
		    	});
		  });

		  $("#rm").fadeOut('slow/400/fast');
		}


</script>
@endsection
