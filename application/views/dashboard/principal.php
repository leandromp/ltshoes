 <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
<section class="content-header">

                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?= round($semana_po,2) ?> %
                                    </h3>
                                    <p>
                                        Ventas en relacion a la semana anterior
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="javascript:void(0)" class="small-box-footer" onclick="dashboard_tablas(1)">
                                    Ver mas informaci&oacute;n <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= round($semana_po,2) ?> %
                                    </h3>
                                    <p>
                                        Cobranzas en relacion a la semana anterior
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer" onclick="dashboard_tablas(2)">
                                    Ver mas informaci&oacute;n <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?= $cantidad_productos ?>
                                    </h3>
                                    <p>
                                        Productos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-dropbox"></i>
                                </div>
                                <a href="javascript:void(0)" class="small-box-footer">
                                    Ver mas informaci&oacute;n <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?= $cantidad_clientes ?>
                                    </h3>
                                    <p>
                                        Clientes
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Ver mas informaci&oacute;n <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>

                        <div class="box">
                            <div class="box-header" id="recargar">
                                <div class="col-md-11"> <h3 id="titulo-reporte" name="" class="box-title">Ver detalles de :</h3> </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                             <div class=" col-xs-6 form-group">
                                        <label>Fecha desde:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="desde" type="text" name="fecha" class="form-control" id="fecha" />
                                        </div><!-- /.input group -->
                            </div><!-- /.form group -->
                             <div class=" col-xs-6 form-group">
                                        <label>Fecha hasta:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="hasta" type="text" name="fecha" class="form-control" id="fecha" />
                                        </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            </div>
                            <div id="exmaple1" class="box-body table-responsive">
                            
                                <table id="example1" class="table table-bordered table-hover">
                                <? if ($reportes): ?>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Documento</th>
                                            <th>Telefono</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?//foreach ($clientes as $key => $value) :?>
                                            <tr>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                        <?//endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Documento</th>
                                            <th>Telefono</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <? endif; ?>
                            </div><!-- /.box-body -->
                             <div class="box-footer">
                              <button class="btn btn-primary" type="" onclick="ver_resultados_reportes()">Ver Resultados</button> 
                              </div>
                        </div><!-- /.box -->
    </section>
</aside>

