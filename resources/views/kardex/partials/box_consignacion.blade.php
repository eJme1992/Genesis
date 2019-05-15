<div class="col-lg-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-arrow-right"></i> En estado de <strong>consignacion</strong></h3>
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
                <thead class="">
                    <tr>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Monturas</th>
                        <th class="text-center">Estuches</th>
                        <th class="text-center">Marca (material)- Coleccion</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($consignaciones as $d)
                        <tr>
                            <td>{{ $d->modelo_id }}</td>
                            <td>{{ $d->modelo->name }}</td>
                            <td>{{ $d->montura }}</td>
                            <td>{{ $d->estuche }}</td>
                            <td class="text-nowrap">
                                {{ $d->modelo->marca->name.' ('.$d->modelo->marca->material->name.') - '.$d->modelo->coleccion->name  }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
