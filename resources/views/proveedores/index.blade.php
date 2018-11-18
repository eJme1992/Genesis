@extends('layouts.app')
@section('title','Proveedores - '.config('app.name'))
@section('header','Proveedores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Proveedores </li>
	</ol>
@endsection
@section('content')

	@include('partials.flash')

	{{-- panel boxes --}}
	<div class="row">
	  	
	  	<div class="col-md-4 col-sm-4 col-xs-12">
		  	<div class="info-box">
		    	<span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>
		   		<div class="info-box-content">
		      		<span class="info-box-text">Proveedores</span>
		      		<span class="info-box-number">{{ count($provs) }}</span>
		    	</div>
		  	</div>
		</div>

	</div>

	{{-- tablas --}}
	<div class="row">
  		
		@include("proveedores.partials.tableProvs")

	</div>
	
@endsection