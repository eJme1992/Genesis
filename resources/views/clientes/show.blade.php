@extends('layouts.app')
@section('title','Cliente / Detalles - '.config('app.name'))
@section('header','Cliente')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Cliente / Detalles </li>
    </ol>
@endsection
@section('content')
    
    @include('partials.flash')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary box-solid">
                <div class="box-body">
                    <h3 class="bg-navy padding_05em">
                        <i class="fa fa-arrow-right"></i> Codigo [{{ $cliente->id }}] - {{ $cliente->nombre_full }} 
                    </h3>

                    <div class="list-group col-lg-3">
                        <b>Tipo de identificacion</b>
                        <p class="list-group-item">{{ $cliente->tipo_id }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>Identificacion</b>
                        <p class="list-group-item">{{ $cliente->identificacion }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>RUC</b>
                        <p class="list-group-item">{{ $cliente->ruc }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>Correo</b>
                        <p class="list-group-item">{{ $cliente->correo }}</p>
                    </div>

                    <div class="list-group col-lg-6">
                        <b>Direccion</b>
                        <p class="list-group-item">{{ $cliente->dir() }}</p>
                    </div>

                    <div class="list-group col-lg-3">
                        <b>Telefono 1</b>
                        <p class="list-group-item"><span>01</span> {{ $cliente->telefono_1 }}</p>
                    </div>
                    
                    <div class="list-group col-lg-3">
                        <b>Telefono 2</b>
                        <p class="list-group-item"><span>+51</span> {{ $cliente->telefono_2 }}</p>
                    </div>                    

                    <h3 class="bg-navy padding_05em col-lg-12">
                        <i class="fa fa-arrow-right"></i>  Ventas
                    </h3>
                    

                </div>
            </div>
            <a class="btn btn-flat btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply"></i> Atras</a>
        </div>
    </div>
@endsection