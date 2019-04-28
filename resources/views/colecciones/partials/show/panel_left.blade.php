<div class="panel panel-default">
  <div class="panel-heading">
    <h3>
      <span style="padding: 0.4em; color:#525ad0; border-bottom: solid 1px #525ad0; border-radius:1em;">Codigo 000{{ $coleccion->id }}</span>
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
            @if($marcas->precio_almacen)
            <div class="col-sm-12">
                <i class="fa fa-arrow-right"></i>
                <span>
                    <strong data-toggle="tooltip" data-placement="top" title="Precio de almacen">[PA]</strong> 
                    S/ {{ $marcas->precio_almacen }} 
                </span> |
                <i class="fa fa-arrow-right"></i> 
                <span>
                    <strong data-toggle="tooltip" data-placement="top" title="Precio de venta establecido">[PVE]</strong> 
                    S/ {{ $marcas->precio_venta_establecido }}
                </span>
                <p></p>
            </div>
            @endif
            <div class="col-sm-9">
              <i class="fa fa-arrow-right"></i> 
              {{ $marcas->marca->name }} | 
              ({{ $marcas->marca->material->name }}) | 
              <strong>E <i class="fa {{ $marcas->marca->estuche == 1 ? 'fa-check text-success' : 'fa-remove text-danger'}}"></i></strong>
            </div>
            <div class="col-sm-3 text-right">
              <form action="{{ url('marcas/'.$marcas->marca->id.'/'.$coleccion->id.'/destroy') }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Desea eliminar la marca con todas sus dependencias y modelos? S/N?');"><i class="fa fa-trash"></i>
                </button>
              </form>
              <p></p>
            </div>
          @endif
          <div class="col-sm-6" style="color:#525ad0;">
              <i class="fa fa-arrow-right"></i> Modelos({{ $marcas->marca->mc($coleccion->id, $marcas->marca->id) }})
          </div>
          
          <div class="col-sm-6">
              @if($marcas->marca->mc($coleccion->id, $marcas->marca->id) > 0)
                  <div class="text-right">
                    <button type="button" id="btn_upd_mod" value="{{ $marcas->marca->id }}"
                      data-toggle="modal" data-target="#modal_upd"
                      class="btn btn-warning btn-xs" onclick="UpdateModelo(this);">
                        <i class="fa fa-edit"></i>
                    </button>
                    
                    <button type="button" id="btn_del_mod" value="{{ $marcas->marca->id }}"
                      data-toggle="modal" data-target="#modal_del"
                      class="btn btn-danger btn-xs" onclick="DeleteModelo(this);">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
              @endif
          </div>

          <div class="col-lg-12 text-{{ $marcas->marca->modelosDisponibles($coleccion->id, $marcas->marca->id) > 0 ? 'success' : 'danger' }}">
                <i class="fa fa-arrow-right"></i> Modelos disponibles {{ $marcas->marca->modelosDisponibles($coleccion->id, $marcas->marca->id) }}
                <br> 
          </div>
        </div>
      </span>
      <br>
      @endforeach
      @include("colecciones.modals.coleccion.modal_del")
      @include("colecciones.modals.coleccion.modal_upd")
  </div>
</div>