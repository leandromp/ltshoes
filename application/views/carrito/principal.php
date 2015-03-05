<? $total = 0; ?>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <?= strtoupper($modulo_nombre=$this->uri->segment(1));?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
               <!-- Main content -->
                <section class="content">
                   <section class="col-md-12">
                        <div class="col-md-1"><a href="<?=site_url('ventas/seleccionar_cliente/'.$carrito['cliente']['id'])?>"> <button type="button" class="btn btn-success btn-flat"> Agregar Productos </button> </a> </div>                 
                        <div class="col-md-1 pull-right">
                            <a href="<?=site_url('ventas/ver_carrito')?>"> 
                                <button type="button" class="btn btn-app"> 
                                    <span id="cantidad-productos" class="badge bg-yellow"></span>
                                    <i class="fa fa-shopping-cart"> </i>Ver Carrito 
                                </button> 
                            </a> 
                        </div>
                    </section><br><br><br><br>
                            <div class="box">
                                <div class="box-header" id="recargar">
                                    <div class="col-md-11"> <h3 class="box-title"><?=strtoupper($modulo_nombre);?></h3> </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <? if(isset($carrito['productos'])) : ?>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>descripcion</th>
                                                <th>Talle</th>
                                                <th>precio</th>
                                                <th>Cantidad</th>
                                                <th>Sub Total</th>
                                                <th> Eliminar </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?foreach ($carrito['productos'] as $key => $value) :?>
                                                <tr id="<?=$value['id']?>">
                                                    <td><?=$value['codigo']?></td>
                                                    <td><?=$value['descripcion']?></td>
                                                    <td><?='Talle'//value['talle']?></td>
                                                    <td>$ <?=$value['precio']?></td>
                                                    <td><?=$value['cantidad']?></td>
                                                    <td><?=$subtotal=$value['cantidad']*$value['precio']?></td>
                                                    <? $total += $subtotal; ?>
                                                    <td><button id="btn-agregar" onclick="eliminar_producto_carrito(<?=$value['id']?>);" role="button" class="btn btn-danger"> Eliminar </button> </a> </td>
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
                                                <th> Eliminar </th>
                                            </tr>
                                            <tr> <th> </th> <th> </th> <th> </th> <th> </th> <th> </th><th> <h4> TOTAL DE LA VENTA: </h4></th>  <th><h4 id="total_venta">$ <?=$total?></h4> </th> </tr>
                                        </tfoot> 
                                    </table>
                                    </div><!-- /.box-body -->
                                        <div class="box-footer" > <a href="<?=site_url('ventas/confirmar_compra');?>" class="btn btn-primary" >Confirmar Compra</a> </div><br>
                                    </div><!-- /.box -->
                                    <? else: ?>
                                    <div class="alert alert-warning"> No existen productos cargados en el Carrito </div>
                                    <? endif; ?>
                                
                            <? if(isset($mensaje)): ?>
                                <div id="mensaje" class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                            <? endif ?>
                            <?if(isset($error)): ?>
                                <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                            <?endif?>
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->