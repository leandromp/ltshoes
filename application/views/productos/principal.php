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
                    <div class="col-md-4">
                        <a href="<?=site_url($modulo_nombre.'/alta/1')?>"> <button type="button" class="btn btn-success btn-flat"> Nuevo <?=$this->uri->segment(1)?> </button> </a> 
                    </div>
                    <div class="col-md-8">
                        <a href="<?=site_url($modulo_nombre.'/ver_outlet')?>"> <button type="button" class="btn btn-default"> Ver Outlet</button></a>
                    </div> 
                    <br>
                    <br>
                    
                    <div class="box">
                        <div class="box-header" id="recargar">
                            <div class="col-md-11"> <h3 class="box-title">
                                <?=strtoupper($modulo_nombre);?></h3> 
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                        <? if($productos): ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Fabricante</th>
                                        <th>descripcion</th>
                                        <th>precio</th>
                                        <th>tipo</th>
                                        <th>Talles</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?foreach ($productos as $key => $value) :?>
                                        <tr id="fila_<?=$value['id']?>" >
                                            <td><?=$value['codigo']?></td>
                                            <td id="fabricante_<?=$value['id']?>" ondblclick="edit(<?=$value['id']?>,'fabricante','producto')"><?=$value['fabricante']?></td>
                                            <td><?=$value['descripcion']?></td>
                                            <td id="precio_<?=$value['id']?>" ondblclick="edit(<?=$value['id']?>,'precio','producto')"><?=$value['precio']?></td>
                                            <td><?=$value['tipo']?></td>
                                            <td><a href="<?=site_url($modulo_nombre.'/talles/'.$value['id']);?>"> <button role="button" class="btn btn-default"> Talles </button> </a> </td>
                                            <td><a href="<?=site_url($modulo_nombre.'/editar/'.$value['id']);?>"> <button role="button" class="btn btn-default"> Editar </button> </a> </td>
                                            <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['id']?>,'<?=$modulo_nombre?>')"> Eliminar </button> </td>
                                        </tr>   
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Fabricante</th>
                                        <th>descripcion</th>
                                        <th>precio</th>
                                        <th>tipo</th>
                                        <th>Talles</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <? endif; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <? if(isset($mensaje)): ?>
                        <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                    <? endif ?>
                    <?if(isset($error)): ?>
                        <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                    <?endif?>
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->