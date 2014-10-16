<!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               DETALLE DE LA CUENTA DE : <?=$cliente['nombre'].' '.$cliente['apellido']?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box box-solid">
                <div class="box box-header">
                    <div class="box-title"> 
                        Nº Cuenta : <?=$ccorriente['id']?>
                        <div class="btn-group">
                            <a class="btn btn-warning"> Debe:  <?=$ccorriente['debe']?> </a>
                            <a class="btn btn-primary"> Haber: <?=$ccorriente['haber']?> </a>
                            <a class="btn btn-info"> Saldo: <?=$ccorriente['saldo']?> </a>
                        </div>
                    </div><!-- termina el titulo -->
                </div>
                    <div class="box-body">
                        <?foreach ($planes as $key => $value) :?>
                             <div class="box box-success collapsed-box">
                                <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                                    <h3 class="box-title">Opcion de Pago Nº <?=$value['id']?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        
                                    </div>
                                </div>
                                <div class="box-body" style="display:none">
                                    <table class="table table-condensed">

                                        <tr>
                                            <th style="width: 20px">Monto</th>
                                            <th style="width: 200px">Fecha de Vencimiento</th>
                                            <th>Fecha de Pago</th>
                                            <th>Cancelar</th>
                                        </tr>

                                    <?php foreach ($value['detalle_pp'] as $k => $v): ?>                             
                                        <tr>
                                            <td> <?=$v['monto']?> </td>
                                            <td> <?=$v['fecha_vencimiento']?> </td>
                                            <td> <?=$v['fecha_pago']?> </td>
                                            <td> <a onclick="cancelar_pago(<?=$v['id']?>)" class="btn btn-success btn-flat">Cancelar</a>  </td>
                                        </tr>
                                    
                                    
                                   <?php endforeach ?>
                                </div><!-- /.box-body -->
                                </table>
                            </div><!-- /.box -->
                       
                        <?endforeach;?>
                    </div>
            </div> <!-- termina la declaracion del box -->
        </section>
                    
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->