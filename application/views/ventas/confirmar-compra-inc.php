 <?php  
        $total =0;
        $select="<select id=\"empleado\" class=\"form-control\">";
        foreach ($empleados as $key => $value) {
            $select.="<option value=".$value['id']."> ".$value['nombre']." </option>";
        }
        $select.="</select>";
?>
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       CONFIMAR COMPRA 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header"> <i class="fa fa-user"> </i><h4>&nbsp;Datos del cliente </h4>  </div>
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                        <dt>Numero de Cliente</dt>
                                        <dd><?=$carrito['cliente']['id']?></dd>
                                        <dt>Nombre</dt>
                                        <dd><?=$carrito['cliente']['nombre']?></dd>
                                        <dt>Apellido</dt>
                                        <dd><?=$carrito['cliente']['apellido']?></dd>
                                        <dt>Direccion</dt>
                                        <dd><?=$carrito['cliente']['direccion']?></dd>
                                        <dt>telefono</dt>
                                        <dd><?=$carrito['cliente']['telefono']?></dd>
                                    </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-success"> 
                        <div class="box-header"><i class="fa fa-money"> </i> <h4>&nbsp; Datos de la Compra </h4> </div>
                        <div class="box-body"> 
                            <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>descripcion</th>
                                                <th>Talle</th>
                                                <th>precio</th>
                                                <th>Cantidad</th>
                                                <th>Sub Total</th>
                                   
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?foreach ($carrito['productos'] as $key => $value) :?>
                                                <tr>
                                                    <td><?=$value['codigo']?></td>
                                                    <td><?=$value['descripcion']?></td>
                                                    <td><?='Talle'//value['talle']?></td>
                                                    <td>$ <?=$value['precio']?></td>
                                                    <td><?=$value['cantidad']?></td>
                                                    <td><?=$subtotal=$value['cantidad']*$value['precio']?></td>
                                                    <? $total += $subtotal; ?>
                                            <?endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>descripcion</th>
                                                <th>Talle</th>
                                                <th>precio</th>
                                                <th>Cantidad</th>
                                                <th>Sub Total</th>
                                   
                                            </tr>
                                            <tr> <th> </th> <th> </th> <th> </th> <th> </th> <th> </th><th> <h4> TOTAL DE LA VENTA: </h4></th>  <th><h4>$ <?=$total?></h4> </th> </tr>
                                        </tfoot> 
                                    </table>
                        </div>
                     </div>
                     <div class="box-footer">
                            <div class="col-md-2">
                            <form action="<?=site_url('ventas/guardar_compra');?>" method="post">
                            <label> Seleccione el Metodo de pago </label>
                            <select name="opcion-pago" class="form-control">
                                <option value="0"> Solo Guardar </option>
                                <option value="1"> Plan de pago Mensual </option>
                                <option value="2"> Plan de pago Quincenal </option>
                                <option value="3"> Plan de pago Semanal </option>
                            </select> 
                            <label> Seleccione el vendedor </label>
                            <?= $select;?>
                            <button class="btn btn-primary" >Confirmar Compra</button>
                            </div>
              
                     </div>
                </div>
                </section>

</aside>