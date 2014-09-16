<? $accion=$this->uri->segment(2); ?>
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
                <div class="col-md-6">
                    <div class="box box-primary">
                    <form role="form" method="post" action="<?=site_url($modulo_nombre.'/'.$accion)?>">
                       <div class="box-header">
                       <h3 class="box-title"><?=strtoupper($accion)?></h3> 
                       </div>
                       <div class="box-body">
                          <div class="form-group">
                                <input id="id" readonly class="form-control" type="hidden" name="id" placeholder="id del modulo" value="<? if(isset($modulo)) echo $modulo['id'];?>" >
                          </div> 
                           <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del modulo" value="<? if(isset($modulo)) echo $modulo['nombre'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Apellido</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del modulo" value="<? if(isset($modulo)) echo $modulo['nombre'];?>" >
                            </div>

                            <div class="form-group">
                                        <label>Fecha de Nacimiento:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->

                            <div class="form-group">
                                <label for="exampleInputEmail1">Dirección</label>
                                <input id="accion" class="form-control" type="text" name="accion" placeholder="Accion" value="<? if(isset($modulo)) echo $modulo['ruta'];?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefóno</label>
                                <input id="icono" class="form-control" type="text" name="icono" placeholder="Icono" value="<? if(isset($modulo)) echo $modulo['icono'];?>">
                            </div>
                            <?if(isset($error) and $error!=""):?>
                             <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-ban"></i>
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                              <b>Alerta!</b> <?=$mensaje?>
                            </div>
                            <?endif;?>
                            <div class="box-footer">
                            <button class="btn btn-primary"  type="submit">Enviar</button> 
                            <a href="<?=site_url($modulo_nombre)?>"> <button class="btn btn-danger" type="button"> Volver </button> </a>
                            </div>
                       </div>

                    </form>
                    </div>
                </div>
                </section>
                            
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->