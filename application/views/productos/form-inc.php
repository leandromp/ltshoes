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
                <div class="col-md-12">
                  <div class="box box-primary">
                    <form role="form" method="post" action="<?=site_url($modulo_nombre.'/'.$accion)?>" id="productos-form">
                       <div class="box-header">
                       <h3 class="box-title"><?=strtoupper($accion)?></h3> 
                       </div>
                       <div class="box-body">
                          
                              <div class="  form-group">
                                <input id="id" readonly class="form-control" type="hidden" name="id"  value="<? if(isset($producto)) echo $producto['id'];?>" >
                              </div> 
                        
                              <div class=" form-group">
                                  <label for="exampleInputEmail1">Codigo</label>
                                  <input id="codigo" class="form-control" style="text-transform:uppercase;" type="text" name="codigo" value="<? if(isset($producto)) echo $producto['codigo'];?>" >
                              </div>
                              <div class=" form-group">
                                  <label for="exampleInputEmail1">Fabricante</label>
                                  <input id="fabricante" class="form-control" type="text" name="fabricante" value="<? if(isset($producto)) echo $producto['fabricante'];?>" >
                              </div>
                               <div class="form-group">
                                <label for="exampleInputEmail1">Descripcion</label>
                                <input id="descripcion" class="form-control" type="text" name="descripcion" value="<? if(isset($producto)) echo $producto['descripcion'];?>" >
                            </div>
                              <div class="  form-group">
                                <label for="">Tipo</label>
                                <select id="tipo" name="tipo" class="form-control">
                                  <? foreach ($tipo_productos as $key => $value) : ?>
                                      <option <? if($value['nombre']==$producto['tipo']) echo 'selected=selected' ?> ><?= $value['nombre'] ?></option>
                                  <? endforeach; ?>
                                </select>
                            <div class="  form-group">
                                <label for="exampleInputEmail1">Precio</label>
                                <input id="precio" class="form-control" type="text" name="precio" value="<? if(isset($producto)) echo $producto['precio'];?>" >
                            </div>

                             <div class="form-group">
                                        <label>Fecha de Ingreso:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="fecha_ingreso" class="form-control" id="fecha-nac" value="<? if(isset($producto)) echo $producto['fecha_ingreso'];?>"/>
                                        </div><!-- /.input group -->
                            </div><!-- /.form group -->

                      <div class="box-footer">
                      <button class="btn btn-primary" type="submit">Guardar</button> 
                      <a href="<?=site_url($modulo_nombre)?>"> <button class="btn btn-danger" type="button"> Volver </button> </a>
                          <? if(isset($mensaje) and $mensaje!=""): ?>
                                <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                            <? endif ?>
                            <?if(isset($error)): ?>
                                <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                            <?endif?>
                      </div>
                            
                    </form>
                  </div>
                </div><!-- class="col-md-12" -->
                </section>
                            
            </aside><!-- /.right-side -->
        <!--</div>./wrapper -->