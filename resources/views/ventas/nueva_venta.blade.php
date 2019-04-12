@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas </li>
	</ol>
@endsection
@section('content')

	<div class="row">
  	<div class="col-lg-12">
    	<div class="box box-danger box-solid">
    		<div class="box-body" id="box-body">
            <div class="col-lg-12">
              <a class="btn btn-app bg-navy" href="#" data-toggle="tooltip" title="Nueva consignacion" id="btn_nueva_consignacion">
                <i class="fa fa-file"></i> Consignacion
              </a>
              <a class="btn btn-app bg-orange" href="#" data-toggle="tooltip" title="Nueva venta" id="btn_nueva_venta">
                <i class="fa fa-file-text"></i> Venta directa
              </a>
            </div> 
	      </div>
      </div>
    </div>
  </div>    

@endsection
@section("script")
<script>
  
</script>
@endsection