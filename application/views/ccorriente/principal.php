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
                    <!--<div class="md-col-1"><a href="<?=site_url($modulo_nombre.'/alta/1')?>"> <button type="button" class="btn btn-success btn-flat"> Nuevo <?=$this->uri->segment(1)?> </button> </a> </div>-->
                    <br>
                    
                    <div class="box">
                                <div class="box-header" id="recargar">
                                    <div class="col-md-11"> <h3 class="box-title">Hover Data Table</h3> </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <? if($clientes): ?>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Documento</th>
                                                <th>Telefono</th>
                                                <th>Cuenta Corriente</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?foreach ($clientes as $key => $value) :?>
                                                <tr>
                                                    <td><?=$value['nombre']?></td>
                                                    <td><?=$value['apellido']?></td>
                                                    <td><?=$value['dni']?></td>
                                                    <td><?=$value['telefono']?></td>
                                                    <td><a href="<?=site_url($modulo_nombre.'/ver_detalle_cuenta/'.$value['id']);?>"> <button role="button" class="btn btn-default"> Cuenta Corriente </button> </a> </td>
                                                    
                                            <?endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Documento</th>
                                                <th>Telefono</th>
                                                <th>Cuenta Corriente</th>
                                              
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <? endif; ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->