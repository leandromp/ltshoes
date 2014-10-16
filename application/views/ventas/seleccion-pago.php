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
                    <form role="form" method="post" action="<?=site_url('ventas/guardar_opcion_pago')?>" id="clientes-form">
                       <div class="box-header">
                       <h3 class="box-title">Venta Nº <?=$id_venta?></h3> 
                       </div>
                     
                       <div class="box-body">
                           <div class="col-xs-6 form-group">
                                <input type="hidden" id="id_venta" readonly class="form-control" name="id_venta"  value="<? if(isset($id_venta)) echo $id_venta;?>" >
                           </div> 
                           <div class="col-xs-6 form-group">
                                <label for="exampleInputEmail1">Cliente</label>
                                <input id="nombre" class="form-control" readonly type="text" name="nombre" value="<? if(isset($cliente)) echo $cliente['nombre'].' '.$cliente['apellido'];?>" >
                            </div>

                             <div class="col-xs-6 form-group">
                                <label for="exampleInputEmail1">Cliente</label>
                                <input id="id_cliente" class="form-control" readonly type="text" name="id_cliente" value="<? if(isset($cliente)) echo $cliente['id'];?>" >
                            </div>

                            <div class="col-xs-6 form-group">
                                <label for="exampleInputEmail1">Total de la Compra</label>
                                <input id="monto_total" readonly class="form-control" type="text" name="monto_total" value="<?=$total_compra?>" >
                            </div>

                            <div class=" col-xs-6 form-group">
                                <label for="exampleInputEmail1">Opcion de pago</label>
                                <select name="plan-pago" id="plan-pago" onchange="cambiar_plan_pago(<?=$total_compra?>)" class="form-control">
	                                <? foreach ($opciones_pago as $key => $value): ?>
	                                <? if($value['valor']==$opcion_pago)$selected="selected"; else $selected=""; ?>
	                                <option <?=$selected?> value="<?=$value['valor']?>"> <?=$value['nombre']?> </option>
	                                <? endforeach; ?>
                                </select>
                            </div>                    
                            <div class=" col-xs-6 form-group">
                                <label for="exampleInputEmail1">Cantidad de Pagos</label>
                                <input id="cantidad-pagos" class="form-control" type="text" name="cantidad-pagos" value="<?if(isset($cantidad_cuotas)) echo $cantidad_cuotas;?>" >
                            </div>  
                            <div class=" col-xs-6 form-group">
                                <label for="exampleInputEmail1">Monto de cada Cuota</label>
                                <input id="monto-cuota" class="form-control" type="text" name="monto-cuota" value="<?if(isset($monto_cuota)) echo $monto_cuota;?>" >
                            </div>  
                        </div>
                       <div class="box-footer">
                      <button class="btn btn-primary" type="submit">Terminar Venta</button> 
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
</aside>