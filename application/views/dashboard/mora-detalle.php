
        <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>telefono</th>
                    <th>Monto</th>
                    <th>Dias Atrasado</th>
                   
                </tr>
            </thead>
            <tbody>
               <?foreach ($reporte as $key => $value) :?>
                    <tr>
                        <td> <?= $value['nombre']?>  </td>
                        <td> <?= $value['apellido']?> </td>
                        <td> <?= $value['direccion']?> </td>
                        <td> <?= $value['telefono']?> </td>
                        <td> <?= $value['monto']?> </td>
                        <td> <?= $value['dias_mora']?> </td>
                      
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