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
                        <div class="col-md-11"><a href="<?=site_url($modulo_nombre.'/alta/1')?>"> <button type="button" class="btn btn-success btn-flat"> Cambiar Cliente </button> </a> </div>
                        <div class="col-md-1 pull-right">
                            <a href="<?=site_url('ventas/ver_carrito')?>"> 
                                <button type="button" class="btn btn-app"> 
                                    <span id="cantidad-productos" class="badge bg-yellow">0</span>
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
                                <? if($productos): ?>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>descripcion</th>
                                                <th>precio</th>
                                                <th>tipo</th>
                                                <th>Talles</th>
                                                <th>Cantidad</th>
                                                <th>Agregar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?foreach ($productos as $key => $value) :?>
                                                <tr>
                                                    <td><?=$value['codigo']?></td>
                                                    <td><?=$value['descripcion']?></td>
                                                    <td><?=$value['precio']?></td>
                                                    <td><?=$value['tipo']?></td>
                                                    <td>
                                                        <select>
                                                            <?foreach ($value['talles'] as $k => $v):?>
                                                            <option> <?= $v['numero'];?> </option>
                                                            <?endforeach;?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="cantidad-<?=$value['id']?>" id="cantidad-<?=$value['id']?>" > </td>
                                                    <td><button id="btn-agregar" onclick="agregar_producto_carrito(<?=$value['id']?>);" role="button" class="btn btn-info"> Agregar </button> </a> </td>
                                            <?endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>descripcion</th>
                                                <th>precio</th>
                                                <th>tipo</th>
                                                <th>Talles</th>
                                                <th>Cantidad</th>
                                                <th>Agregar</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <? endif; ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <? if(isset($mensaje)): ?>
                                <div id="mensaje" class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                            <? endif ?>
                            <?if(isset($error)): ?>
                                <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                            <?endif?>
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->