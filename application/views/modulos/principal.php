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
                    <div class="md-col-1">
                        <a href="<?=site_url($modulo_nombre.'/alta/1')?>"> <button type="button" class="btn btn-success btn-flat"> Nuevo <?=$this->uri->segment(1)?> </button> </a> 
                        <a href="<?=site_url($modulo_nombre.'/permisos')?>"> <button type="button" class="btn btn-success btn-flat">Permisos</button> </a> 
                    </div>
                    <br>
                    <div class="box">
                                <div class="box-header" id="recargar">
                                    <div class="col-md-11"> <h3 class="box-title">Hover Data Table</h3> </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Accion</th>
                                                <th>Icono</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach ($menu as $key => $value) :?>
                                                <tr>
                                                    <td><?=$value['nombre']?></td>
                                                    <td><?=$value['ruta']?></td>
                                                    <td><?=$value['icono']?></td>
                                                    
                                                    <td><a href="<?=site_url($modulo_nombre.'/editar/'.$value['id']);?>"> <button role="button" class="btn btn-default"> Editar </button> </a> </td>
                                                    <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['id']?>,'<?=$modulo_nombre?>')"> Eliminar </button> </td>
                                            <?endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th>Platform(s)</th>
                                                <th>Engine version</th>
                                                <th>CSS grade</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

