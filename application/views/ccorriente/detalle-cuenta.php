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
                   
                        <?foreach ($planes as $key => $value) :?>
                        <div class="col-md-3">
                            <div class="box box-success collapsed-box">
                                <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                                    <h3 class="box-title">Venta Nº <?=$value['id_venta']?> | <?=$value['fecha']?></h3>
                                    <div class="box-tools pull-right">
                                        <a href="<?=site_url('ccorrientes/ver_detalle_plan/'.$value['id'].'/'.$cliente['id']);?>" class="btn btn-success"><i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?endforeach;?>

                
                   
            </div> <!-- termina la declaracion del box -->
        </section>
                    
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->