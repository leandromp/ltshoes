<? $accion=$this->uri->segment(2); ?>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <?= strtoupper($modulo_nombre=$this->uri->segment(1));?>
                    </h1>
                </section>
               
                <!-- Main content -->
                <section class="content">
                <div class="col-md-12">
                    <div class="box box-primary">
                    <form role="form" method="post" action="<?=site_url($modulo_nombre.'/'.$accion)?>" id="clientes-form">
                       <div class="box-header">
                       <h3 class="box-title"><?=strtoupper($accion)?></h3> 
                       </div>
                       <div class="box-body">
                           <div class="form-group">
                                <input id="id" readonly class="form-control" type="hidden" name="id"  value="<? if(isset($cliente)) echo $cliente[0]['id'];?>" >
                           </div> 
                           <div class="col-xs-6 form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" value="<? if(isset($cliente)) echo $cliente[0]['nombre'];?>" >
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="exampleInputEmail1">Apellido</label>
                                <input id="nombre" class="form-control" type="text" name="apellido" value="<? if(isset($cliente)) echo $cliente[0]['apellido'];?>" >
                            </div>

                            <div class=" col-xs-6 form-group">
                                <label for="exampleInputEmail1">Documento (DNI)</label>
                                <input id="dni" class="form-control" type="text" name="dni" value="<? if(isset($cliente)) echo $cliente[0]['dni'];?>" >
                            </div>

                            <div class=" col-xs-6 form-group">
                                        <label>Fecha de Nacimiento:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="fecha" class="form-control" id="fecha" />
                                        </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="col-xs-6 form-group">
                                <label for="">Dirección</label>
                                <input id="direccion" class="form-control" type="text" name="direccion"   value="<? if(isset($cliente)) echo $cliente[0]['direccion'];?>">
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="">Telefóno</label>
                                <input id="telefono" class="form-control" type="text" name="telefono"  value="<? if(isset($cliente)) echo $cliente[0]['telefono'];?>">
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="">Dirección Laboral</label>
                                <input id="direccion_laboral" class="form-control" type="text" name="direccion_laboral"   value="<? if(isset($cliente)) echo $cliente[0]['direccion_laboral'];?>">
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="">Telefóno Laboral</label>
                                <input id="telefono_laboral" class="form-control" type="text" name="telefono_laboral"  value="<? if(isset($cliente)) echo $cliente[0]['telefono_laboral'];?>">
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="">Localidad</label>
                                <select id="localidad" class="form-control" type="text" name="localidad"   value="<? if(isset($cliente)) echo $cliente[0]['localidad'];?>">
                                </select>
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="">Barrio</label>
                                <input id="barrio" class="form-control" type="text" name="barrio"   value="<? if(isset($cliente)) echo $cliente[0]['barrio'];?>">
                            </div>

                            
                              
                       </div>

                       <div class="box-footer">
                      <button class="btn btn-primary"  type="submit">Enviar</button> 
                      <a href="<?=site_url($modulo_nombre)?>"> <button class="btn btn-danger" type="button"> Volver </button> </a>
                      </div>
                            <? if(isset($mensaje)): ?>
                                <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                            <? endif ?>
                            <?if(isset($error)): ?>
                                <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                            <?endif?>

                            
                      
                    </form>
                </div>
                </div><!-- class="col-md-12" -->
                </section>
                            
            </aside><!-- /.right-side -->
        <!--</div>./wrapper -->