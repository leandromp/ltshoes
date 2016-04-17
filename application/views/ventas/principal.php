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
            <div class="md-col-1"><a href="<?=site_url($modulo_nombre.'/alta/1')?>"> <button type="button" class="btn btn-success btn-flat"> <i class="fa fa-plus-square"> </i> Nueva <?=$this->uri->segment(1)?> </button> </a> </div>
            <br>
            
            <div class="box">
                        <div class="box-header" id="recargar">
                            <div class="col-md-11"> <h3 class="box-title"><?=strtoupper($modulo_nombre);?></h3> </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                        <? if($ventas): ?>
                            <table id="example1" class="table table-bordered table-striped dataTable"  data-order='[[ 1, "desc" ]]' >
                                <thead>
                                    <tr>
                                    	<th>Venta Nº</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Cliente</th>
                                        <th>Telefono</th>
                                        <th>Eliminar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?foreach ($ventas as $key => $value) :?>
                                        <tr>
                                        	<td><?=$value['id']?></td>
                                            <? $temp = explode('-',$value['fecha']); ?>
                                            <td><?=$temp[2].'-'.$temp[1].'-'.$temp[0]?></td>
                                            <td><?=$value['monto']?></td>
                                            <td><?=$value['nombre'].''.$value['apellido']?></td>
                                            <td><?=$value['telefono']?></td>
                                            
                                            <td><button role="button" class="btn btn-danger" onclick="combo(<?=$value['id']?>)"> Eliminar </button> </td>
                                             <td><a href="<?=site_url('reportes/imprimir_comprobante_pago/'.$value['id'])?>" target="_blank"><button role="button" class="btn" > <i class="fa fa-print"> </i> </button> </td></a>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Cliente</th>
                                        <th>Telefono</th>
                                        
                                        <th>Eliminar</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <? endif; ?>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                        <? if(isset($mensaje)): ?>
                        <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
                        <? endif ?>
                        <?if(isset($error)): ?>
                            <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
                        <?endif?>
                        <div>
                    </div><!-- /.box -->
            
        </section>
                    
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
