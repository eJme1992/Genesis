<div class="modal fade" tabindex="-1" role="dialog" id="detalle_consig">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel">
                <div class="panel-heading bg-navy text-center">
                    <buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
                    <h3>
                        <i class="fa fa-list-alt"></i> Datos de la consignacion 
                        <i class='fa fa-spinner fa-pulse' id="icon-loading" style="display: none;"></i>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row list-group">
                        
                        <div class="col-lg-6">
                            <label class="">Cliente</label>
                            <p class="list-group-item"><strong id="cliente"></strong></p>
                        </div>
                                    
                        <div class="col-lg-3">
                            <label class="">Fecha de envio</label>
                            <p id="fecha_envio" class="list-group-item"></p>
                        </div>

                        <div class="col-lg-3">
                            <label>---</label>
                            <p id="guia" class="list-group-item"></p>
                            <br>
                        </div>

                        <section id="section_guia" style="display: none;">
                            <div class="col-lg-12">
                                <h4 class="padding_1em bg-navy disabled"><i class="fa fa-list-alt"></i> Datos de la Guia</h4>
                            </div>

                            <div class="col-lg-3">
                                <label>Nº Serie</label> 
                                <p class="list-group-item" id="serie"></p>
                            </div>
                            <div class="col-lg-3">
                                <label>Tipo de iTem</label> 
                                <p class="list-group-item" id="ref_item_id"></p>
                            </div>
                            <div class="col-lg-3">
                                <label>Cantidad</label> 
                                <p class="list-group-item" id="cantidad"></p>
                            </div>
                            <div class="col-lg-3">
                                <label>Peso</label> 
                                <p class="list-group-item"><span id="peso"></span> KG.</p>
                                <br>
                            </div>

                            <div class="col-lg-6">
                                <label>Direccion de salida</label> 
                                <p class="list-group-item" id="dir_salida"></p>
                            </div>
                            <div class="col-lg-6">
                                <label>Direccion de llegada</label> 
                                <p class="list-group-item" id="dir_llegada"></p>
                                <br>
                            </div>

                            <div class="col-lg-12">
                                <label>Descripcion</label> 
                                <p class="list-group-item" id="descripcion"></p>
                                <br>
                            </div>
                        </section>

                        <div class="col-lg-12">
                            <h4 class="padding_1em bg-navy disabled"><i class="fa fa-list-alt"></i> Modelos</h4>
                        </div>      

                        <div class="col-lg-12">
                            <table class="table table-bordered table-striped table-hover data-table">
                                <thead class="bg-navy">
                                    <tr>
                                        <th>[Codigo]</th>
                                        <th>Nombre</th>
                                        <th>Monturas</th>
                                        <th>Estuches</th>
                                        <th class="bg-primary">Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="data_modelos"></tbody>
                            </table>
                        </div> 
                    
                    </div>
                </div>      
                <div class="modal-footer">
                    <div class="text-right">
                        <input type="button" class="btn btn-danger cerrar" data-dismiss="modal" value="Cerrar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>