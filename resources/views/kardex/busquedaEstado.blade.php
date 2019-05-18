@extends('layouts.app')
@section('title','Kardex - '.config('app.name'))
@section('header','Kardex')
@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="active"> Kardex </li>
    </ol>
@endsection
@section('content')
    @include('partials.flash')

    <div class="row">
        <div class="col-lg-3">
          <div class="info-box">
            <span class="info-box-icon 
                @if($des == "asignacion")bg-green
                @elseif($des == "consignacion")bg-aqua
                @elseif($des == "venta")bg-orange
                @elseif($des == "devolucion")bg-red
                @elseif($des == "almacen")bg-navy
                @endif">
                <i class="fa fa-database"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text text-capitalize">{{ $des }}</span>
              <span class="info-box-number">{{ count($modelos) }}</span>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
            @include('kardex.partials.form_busqueda_estado')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-arrow-right"></i> Modelos en {{ $des }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table data-table table-bordered table-hover">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Monturas</th>
                                <th class="text-center">Estuches</th>
                                <th class="text-center">Marca (material)- Coleccion</th>
                                <th class="text-center">Fecha Reg.</th>
                                <th class="text-center bg-navy"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($modelos as $d)
                                <tr>
                                @if($des <> "almacen")
                                    <td>{{ $d->modelo_id }}</td>
                                    <td>{{ $d->modelo->name }}</td>
                                    <td>{{ !$d->montura ? $d->monturas : $d->montura}}</td>
                                    <td>{{ !$d->estuches ? $d->estuche : $d->estuches  }}</td>
                                    <td>
                                        {{ $d->modelo->marca->name.' ('.$d->modelo->marca->material->name.') - '.$d->modelo->coleccion->name  }}
                                    </td>
                                @else
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->montura}}</td>
                                    <td>{{ $d->estuche }}</td>
                                    <td>
                                        {{ $d->marca->name.' ('.$d->marca->material->name.') - '.$d->coleccion->name  }}
                                    </td>
                                @endif    
                                    <td>{{ $d->createF() }}</td>
                                    <td>
                                        @if($des == "asignacion")
                                            <span>---</span>
                                        @elseif($des == "consignacion")
                                            <span data-toggle="tooltip" title="detalles de la {{ $des }}">
                                                <button type="button" data-toggle="modal" data-target="#detalle_consig" class="btn btn-xs bg-navy bc" data-id="{{ $d->consignacion_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </span>
                                        @elseif($des == "venta")
                                            <span data-toggle="tooltip" title="detalles de la {{ $des }}">
                                                <button type="button" data-toggle="modal" data-target="#detalle_venta" class="btn btn-xs bg-navy bv" data-id="{{ $d->venta_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </span>
                                        @elseif($des == "devolucion")
                                            <span data-toggle="tooltip" title="detalles de la {{ $des }}">
                                                <button type="button" data-toggle="modal" data-target="#detalle_dev" class="btn btn-xs bg-navy bd" data-id="{{ $d->devolucion_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </span>
                                        @elseif($des == "almacen")
                                            <span>---</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include("consignaciones.modals.detalle_consig")
    @include("kardex.modals.detalle_venta")
    @include("kardex.modals.detalle_dev")
@endsection
@section('script')
<script>

    // mostrar y validar campos en consignacion y guia
    $(".bc").click(function(e){
        $("#icon-loading").show();
        $.get('../detalleConsig/'+$(this).data("id"), function(data) {
            
            $('.data-table').DataTable().destroy();
            cargarDataConsignacionYModelos(data);
            $('.data-table').DataTable();

            if (data.consig.guia == null) {
                $("#section_guia").fadeOut(400);
                $("#guia").empty().append("<i class='fa fa-remove text-danger'></i> Guia de remision");
            }else{
                $("#section_guia").fadeIn(400);
                $("#guia").empty().append("<i class='fa fa-check text-success'></i> Guia de remision");
                cargarGuia(data);
            }
            
            $("#icon-loading").hide();
        });
    });

    // mostrar campos de venta
    $(".bv").click(function(e){
        $("#icon-loading-venta").show();
        id = $(this).data("id");
        $.get('../showVenta/'+$(this).data("id"), function(data) {
            
            $('#id_venta_venta').text(id);
            $('#user_venta').text(data.user);
            $('#cliente_venta').text(data.cliente);
            $('#direccion_venta').text(data.direccion);
            $('#fecha_venta').text(data.fecha_venta);
            $('#status_estuche_venta').text(data.status_estuche);
            $('#total_venta').text(data.total)
            ;
            $('.data-table').DataTable().destroy();
            $('#data_venta').empty().append(data.data);
            $('.data-table').DataTable();
            
            $("#icon-loading-venta").hide();
        });
    });

    // mostrar campos de devolucion
    $(".bd").click(function(e){
        $("#icon-loading-dev").show();
        id = $(this).data("id");
        $.get('../showDevolucion/'+$(this).data("id"), function(data) {
            
            $('#id_venta_dev').text(id);
            $('#fecha_dev').text(data.fecha);
            $('#motivo_dev').text(data.motivo);
            ;
            $('.data-table').DataTable().destroy();
            $('#data_dev').empty().append(data.data);
            $('.data-table').DataTable();
            
            $("#icon-loading-dev").hide();
        });
    });

     // busqueda de marcas
    $('#coleccion').change(function(event) {
        $("#marca, #modelo").empty();
        $.get("../marcasAll/"+event.target.value+"",function(response, dep){
            if (response.length > 0) {
                $("#marca").append("<option value=''>Seleccione...</option>");
                for (i = 0; i<response.length; i++) {
                    $("#marca").append(
                        "<option value='"+response[i].marca.id+"'>"
                        +response[i].marca.material.name+' | '+response[i].marca.name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee marcas asociadas", "fa-warning", "red");
            }
        });
    });

    // busqueda de modelos
    $('#marca').change(function(event) {
        $("#modelo").empty();
        $.get("../modelosActivos/"+$("#coleccion").val()+"/"+$("#marca").val()+"",function(response){
            if (response.length > 0) {
                $("#modelo").append("<option value=''>Seleccione...</option>");
                for (i = 0; i<response.length; i++) {
                    $("#modelo").append(
                        "<option value='"+response[i].id+"'>["
                        +response[i].id+'] | '+response[i].name+
                        "</option>"
                    );
                }
            }else{
                mensajes("Alerta!", "No posee modelos asociadas", "fa-warning", "red");
            }
        });
    });

    $('#estado').change(function(event) {
        if ($('#estado').val() == 'almacen') {
            $("#section_almacen").show();
        }else{
            $("#section_almacen").hide();
        }
    });

</script>
@endsection