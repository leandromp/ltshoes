<div id="cuerpo"> <!-- Right side column. Contains the navbar and content of the page -->
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
                    </div>
                    <br>
                     <form role="form" method="post" action="<?=site_url('modulos/permisos/1');?>">
                    <div class="box">
                                <div class="box-header" id="recargar">
                                    <div class="col-md-11"> <h3 class="box-title">Permisos para el perfil</h3>
                                        
                                     </div>
                                     <div class="col-md-6 form-group">
                                        <select name="perfil_id" id="perfil" onchange="cambiar_perfil();">
                                            <option value="0">Ninguno</option>
                                            <? foreach ($perfiles as $k => $v):?>
                                            <? if(!isset($perfil_seleccionado)) $perfil_seleccionado=0?>
                                            <option <?if($perfil_seleccionado==$v['id']) echo 'selected'?> value="<?=$v['id']?>"> <?=$v['perfil_nombre']?> </option>
                                            <?endforeach;?>
                                        </select>
                                        </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Alta</th>
                                                <th>Baja</th>
                                                <th>Modificacion</th>
                                                <th>Consulta / Listado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach ($permisos as $key => $value) :?>
                                                <tr>
                                                    <td><?=$value['nombre']?></td>
                                                    <td><input name="<?=$value['modulo_id']?>-1" type="checkbox" <? if($value['alta']==1) echo 'checked'?> > </td>
                                                    <td><input name="<?=$value['modulo_id']?>-2" type="checkbox" <? if($value['baja']==1) echo 'checked'?> >  </td>
                                                    <td><input name="<?=$value['modulo_id']?>-3" type="checkbox" <? if($value['modificacion']==1) echo 'checked'?> >  </td>
                                                    <td><input name="<?=$value['modulo_id']?>-4" type="checkbox" <? if($value['consulta']==1) echo 'checked'?> >  </td>
                                                </tr>    
                                            <?endforeach;?>
                                        </tbody>
                                        
                                        <tfoot>
                            
                                        </tfoot>
                                    </table>
                                <div class="box-footer">
                                <button class="btn btn-primary"  type="submit">Guardar Cambios</button> 
                                <a href="<?=site_url($modulo_nombre)?>"> <button class="btn btn-danger" type="button"> Volver </button> </a>
                                </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <? if(isset($mensaje)): ?>
                                <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                            <? endif ?>
                            <?if(isset($error)): ?>
                                <div class="alert alert-danger alert-dismissable"> <?=$error?> </div>
                            <?endif?>
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
</div><!-- cierra el div cuerpo contenedor -->