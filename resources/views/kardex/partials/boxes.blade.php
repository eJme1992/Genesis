<div class="row">
    <div class="col-lg-3">
        <div class="">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Asignados</span>
              <span class="info-box-number">{{ count($asignaciones) }}</span>
            </div>
          </div>
        </div>
        <div class="">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Consignados</span>
              <span class="info-box-number">{{ count($consignaciones) }}</span>
            </div>
          </div>
        </div>
        <div class="">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Ventas</span>
              <span class="info-box-number">{{ count($ventas) }}</span>
            </div>
          </div>
        </div>
        <div class="">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">devoluciones</span>
              <span class="info-box-number">{{ count($devoluciones) }}</span>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-9">
        @include('kardex.partials.form_busqueda_estado')
    </div>
</div>