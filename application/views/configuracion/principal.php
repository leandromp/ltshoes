 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <?= strtoupper($modulo_nombre=$this->uri->segment(1));?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Configuraciones</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                  <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal"> Agregar Opci&oacute;n  </a><br>
                    <div class="md-col-1">
                    </div>
                    <br>
                    <div class="box">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Localidades</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Zonas</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Talles Calzado</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Talles Ropa</a></li>
                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="box">
                                            <div class="box-header" id="recargar">
                                                <div class="col-md-11"> <h3 class="box-title"><?=strtoupper($modulo_nombre);?></h3> </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body table-responsive">
                                            <? if($localidades): ?>
                                                <table id="example1" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?foreach ($localidades as $key => $value) :?>
                                                            <tr>
                                                                <td><?=$value['id']?></td>
                                                                <td><?=$value['nombre']?></td>                                                     
                                                                <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['id']?>,'<?=$modulo_nombre?>')"> Eliminar </button> </td>
                                                        <?endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <? endif; ?>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                       <? if($zonas): ?>
                                                <table id="example1" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?foreach ($zonas as $key => $value) :?>
                                                            <tr>
                                                                <td><?=$value['id']?></td>
                                                                <td><?=$value['nombre']?></td>                                                     
                                                                <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['id']?>,'<?=$modulo_nombre?>')"> Eliminar </button> </td>
                                                        <?endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <? endif; ?>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                       <? if($talles_calzado): ?>
                                                <table id="example1" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?foreach ($talles_calzado as $key => $value) :?>
                                                            <tr>
                                                                <td><?=$value['valor']?></td>
                                                                <td><?=$value['nombre']?></td>                                                     
                                                                <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['valor']?>,'talles')"> Eliminar </button> </td>
                                                        <?endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <? endif; ?>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">
                                       <? if($talles_ropa): ?>
                                                <table id="example1" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?foreach ($talles_ropa as $key => $value) :?>
                                                            <tr>
                                                                <td><?=$value['valor']?></td>
                                                                <td><?=$value['nombre']?></td>                                                     
                                                                <td><button role="button" class="btn btn-danger" onclick="eliminar(<?=$value['valor']?>,'talles')"> Eliminar </button> </td>
                                                        <?endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>                                                      
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <? endif; ?>
                                    </div><!-- /.tab-pane -->   
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                </div><!--box-->
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="
                    true">&times;</span><span class="sr-only">Cerrar</span></button>

                    <h4 class="modal-title" id="myModalLabel">Agregar Opcion</h4>
                  </div>
                  <div class="modal-body">
                  
                        <div class="form-group">
                        <label> Seleccione el Tipo Configuraci&oacute;n</label>
                            <select id="tipo" class="form-control">
                                <option value="1">Talle Calzado</option>
                                <option value="2">Talle Ropa</option>
                                <option value="3">Localidad</option>
                                <option value="4">Zona</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Valor</label>
                            <input id="valor" class="form-control" type="text">
                        </div>
                        <br>
                      <div class="alert alert-danger alert-dismisable" style="display:none" id="mensaje">
                      <i class="fa fa-ban"></i>
                        
                      </div>

                       <div class="alert alert-success alert-dismisable" style="display:none" id="exito">
                      <i class="fa fa-ban"></i>
                        
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button onclick="agregar_opcion();" type="button" class="btn btn-primary">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>