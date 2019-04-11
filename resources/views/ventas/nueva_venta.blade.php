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
      <a class="btn btn-app bg-navy col-lg-5" href="{{ route('ventas.index') }}">
        <i class="fa fa-file"></i> Consignacion
      </a>
      <a class="btn btn-app bg-purple col-lg-5" href="{{ route('ventas.index') }}">
        <i class="fa fa-file-text"></i> Venta directa
      </a>
		</div>
	</div>

@endsection
@section("script")
<script>

</script>
@endsection