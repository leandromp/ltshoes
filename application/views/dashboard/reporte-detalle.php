
        <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <? if(isset($reporte[0]['fecha_vencimiento'])): ?>
                        <th>Fecha de Vencimiento</th>
                        <th>Tipo de Financiacion</th>
                    <? endif; ?>
                </tr>
            </thead>
            <tbody>
               <?foreach ($reporte as $key => $value) :?>
                    <tr>
                        <td> <?= $value['nombre']?>  </td>
                        <td> <?= $value['fecha']?> </td>
                        <td> <?= $value['monto']?> </td>
                        <? if ( isset($reporte[$key]['fecha_vencimiento'])): ?>
                            <td> <?= $value['fecha_vencimiento']?> </td>
                            <td> <?= $value['tipo_pago']?> </td>
                        <? endif; ?>
                      
                <?endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                    
                </tr>
            </tfoot>
        </table>
        <? //endif; ?>
    </div><!-- /.box-body -->
