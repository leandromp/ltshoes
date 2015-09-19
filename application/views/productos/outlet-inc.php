<aside class="right-side">
<section class="content">
<div class="box-header" id="recargar">
    <div class="col-md-11"> <h3 class="box-title">
        <?=strtoupper($modulo_nombre);?></h3> 
    </div>
</div><!-- /.box-header -->
<div class="col-lg-12"> 
	<a target="_blank" href="<?=site_url('reportes/ver_reporte_outlet')?>"> <button> Imprimir reporte  </button> </a>
</div>
<div class="box-body table-responsive">
    <? if($productos_outlet): ?>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Fabricante</th>
                <th>descripcion</th>
                <th>Precio Outlet</th>
                <th>tipo</th>
                <th>Talle</th>
            </tr>
        </thead>
        <tbody>
           <?foreach ($productos_outlet as $key => $value) :?>
                <tr>
                    <td><?=$value['codigo']?></td>
                    <td><?=$value['fabricante']?></td>
                    <td><?=$value['descripcion']?></td>
                    <td><?=$value['precio_outlet']?></td>
                    <td><?=$value['tipo']?></td>
                    <td><?=$value['numero']?></td>
            <?endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Fabricante</th>
                <th>descripcion</th>
                <th>precio</th>
                <th>tipo</th>
                <th>Talle</th>
                
            </tr>
        </tfoot>
    </table>
    <? endif; ?>
</div><!-- /.box-body -->
</div><!-- /.box -->
<? if(isset($mensaje)): ?>
    <div class="alert alert-info alert-dismissable"> <?=$mensaje?> </div>
<? endif ?>
<?if(isset($error)): ?>
    <div class="alert alert-danger alert-dismissable"> <?=$error?> </div><br>
<?endif?>
</section>
</aside>
