<!-- mensaje de info -->
<div class="col-sm-12">
    <div class="alert alert-info">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <span class="text-center">
        <i class="fa fa-info"></i>
        Si desea cambiar la cantidad de cajas, <b>seleccione en cada modelo la cantidad</b>, sino dejar tal cual  
      </span> 
    </div>
</div>

<!-- seccion para añadir y cargar marcas -->
<div class="col-sm-4">
    <label for="">
      Seleccione Marca(*)
      [<a href="#cm" class="btn btn-link btn-xs" data-toggle="modal" data-target="#cm">
        <span class="text-primary"><i class="fa fa-plus"></i> Añadir</span>
      </a>]
    </label>
    <select name="marca_id" id="marca" class="form-control" required="">
        @foreach($coleccion->marcas as $marca)
        <option value="{{ $marca->id }}">{{ $marca->name }} | ({{ $marca->material->name }})</option>
        @endforeach
    </select>
</div>
<div class="col-sm-4" style="margin-top: 1.9em;">
    <button class="btn btn-primary btn-flat" type="button" id="btn_buscar_marca">Cargar</button>
    <span id="rm" style="display:none;" class="text-center">
        <i class="fa fa-refresh fa-pulse fa-fw text-primary"></i>
    </span>
</div>
<div class="col-sm-4">
    <label>Nº de Ruedas</label>
    <input type="text" readonly="" class="form-control" id="ruedas">
</div>

<div class="col-sm-12"><hr></div>

<!-- formulario de modelos -->
<form id="form_modelos2">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type='hidden' name='marca_id' id="marca_id_2">
    <input type="hidden" name="rueda" class="ruedas">
    <input type="hidden" value="{{ $coleccion->id }}" id="coleccion" name="id_coleccion">

    <section id="sm" style="display: none;">
        <div id="div_campos">
            <div class='form-group col-sm-2'>
                <label class='control-label' for='name'>Nombre modelo *</label>
                <input type='text' name='name[]' class='form-control nombre_modelo2' id="nombre_modelo_0" required=''>
            </div>
            <div class='form-group col-sm-2'>
                <label class='control-label'>Monturas *</label>
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
            <div class='form-group col-sm-2'>
              <label class='control-label'>Estuches: *</label>
              <select class='form-control select_estuche' required='' id="se">
                  <option value='0'>0</option>
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
                  <option value='12'>12</option>
              </select>
            </div>
            <div class='form-group col-sm-2'>
                <label>Descripcion </label>
                <input type='text' name='descripcion_modelo[]' class='form-control'>
            </div>
            <div class='form-group col-sm-2'>
                <label>Cajas </label>
                <select name='caja[]' class='form-control'>
                  <option value='' selected></option>
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
                  <option value='12'>12</option>
                  <option value='13'>13</option>
                  <option value='14'>14</option>
                  <option value='15'>15</option>
                  <option value='16'>16</option>
                  <option value='17'>17</option>
                  <option value='18'>18</option>
                  <option value='19'>19</option>
                  <option value='20'>20</option>
                </select>
            </div>
        </div>
        <div class='form-group col-sm-1 text-left' style='padding: 1.8em;'>
          <button class='btn btn-primary' type='button' id='btn_añadir_modelo' style="display:none;">
            <i class='fa fa-plus'></i>
          </button>
        </div>
    </section>

    <div class="form-group col-sm-12">
        <br>
        <span class="pull-right">
            <button class="btn btn-danger" type="submit" id="btn_save_mod" style="display: none;">
                <i class="fa fa-save" id="icon-save-modelo"></i> Guardar Modelos
            </button>
        </span>
    </div>
</form>