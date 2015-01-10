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
                    <div id="agregar_linea" class="md-col-1"><button onclick="agregar_talle(<?=$producto['id']?>,0)" type="button" class="btn btn-success btn-flat"> Agregar Talle </button>  </div>
                    <br> 
                    
                    <div class="box">
                                <div class="box-header" id="recargar">
                                    <div class="col-md-11"> <h3 class="box-title">PRODUCTO :<?=$producto['descripcion'];?> | CODIGO <?=$producto['codigo']?></h3> </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                    
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Talle</th>
                                                    <th>cantidad</th>
                                                    <th>Guardar</th>
                                                    <th>Eliminar</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <? if($talles): ?>
                                               <?foreach ($talles as $key => $value) :?>
                                                    <tr id="filaA<?=$value['id']?>">
                                                        <td id="talleA<?=$value['id'];?>"> <?=$value['numero']?></td>
                                                        <td><input id="cantidadA<?=$value['id']?>" value="<?=$value['cantidad']?>"> </td>
                                                        <td><button role="button" class="btn btn-info" onclick="guardar_talle('A<?=$value['id']?>',<?=$producto['id']?>,0)"> Guardar </button> </td>
                                                        <td><button role="button" class="btn btn-danger" onclick="eliminar_talle_id('<?=$value['id']?>')"> Eliminar </button> </td>
                                                    </tr>
                                                <?endforeach;?>
                                             <? endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Talle</th>
                                                    <th>cantidad</th>
                                                    <th>Guardar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                       
                                        
                                        <a href="<?=site_url($modulo_nombre)?>"> <button class="btn btn-danger" type="button"> Volver </button> </a>
                                   
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