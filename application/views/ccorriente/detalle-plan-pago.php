 <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               DETALLE DEL PLAN
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
         <section class="content">
         <div class="box box-solid">
	         <div class="box box-body">
		         <table class="table table-bordered">
		         	<tr>
		         		<th> Numero de pago </th>
		         		<th> Monto </th>
		         		<th> Monto Pagado </th>
		         		<th> Fecha Vencimiento </th>
		         		<th> Fecha Pago </th>
		         		<th> Cancelar </th>
		         	</tr>
		         	<?
		         		$total_adeudado=0;
		         		$total_pagado=0; 
		         	?>
					<?php foreach ($detalle_pp as $k => $v): ?>       
					<?
						$total_adeudado+=$v['monto'];
						$total_pagado+=$v['monto_pago'];
					 ?>                      
					    <tr>
					    	<th> <?=$v['id']?> </th>
					        <td> <?=$v['monto']?> </td>
					        
					         <td> <?= $v['monto_pago']; ?> </td>
					         <td> <?= $this->varios_library->rotar_fecha($v['fecha_vencimiento']);?> </td>
					        <td> <?= $this->varios_library->rotar_fecha($v['fecha_pago']);?> </td>
					        <td> <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal<?=$v['id']?>">
								  Cancelar
								</button> 
							</td>
					    </tr>                                                      
					 <?php endforeach ?>
					 <tr>  <td> <b>Total:</b> <td> <?= $total_adeudado;?> </td> <td> <b>Pagado:</b> </td> <td> <?=$total_pagado?> </td> <td>Deuda:</td> <td> <?= $temp=$total_adeudado-$total_pagado?> </td></tr>
					 </table>
				</div>
				<div class="box box-footer">
				<td><a href="<?=site_url('ccorrientes/ver_detalle_cuenta/'.$id_cliente);?>"> <button role="button" class="btn btn-info"> Volver a Cuenta Corriente </button> </a> </td>
				</div>
			</div>
			</section>

			<?php
				$select="<select id=\"empleado\" class=\"form-control\">";
				foreach ($empleados as $key => $value) {
					$select.="<option value=".$value['id']."> ".$value['nombre']." </option>";
				}
				$select.="</select>";
			?>
			
			<?php foreach ($detalle_pp as $k => $v): ?>                
			<!-- Modal -->
			<div class="modal fade" id="myModal<?=$v['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="
			        true">&times;</span><span class="sr-only">Close</span></button>

			        <h4 class="modal-title" id="myModalLabel">Cancelar Pago <?=$v['id']?></h4>
			      </div>
			      <div class="modal-body">
			      
				      	<div class="form-group">
				      	<label> Seleccione el Cobrador </label>
				       	<?=$select;?>
				       	</div>
			       	   	<div class="form-group">
                        <label for="exampleInputEmail1">Monto del Pago</label>
                        <input id="monto<?=$v['id']?>" class="form-control" type="text" name="monto" value="<?=$v['monto']?>">
                        </div>
                        
                        <div class="form-group">
                                        <label>Fecha de Pago</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="fecha" value="<?=date('d/m/Y')?>" class="form-control" id="fecha<?=$v['id']?>" />
                                        </div><!-- /.input group -->
                         </div><!-- /.form group -->
                        <br>
				      <div class="alert alert-danger alert-dismisable" style="display:none" id="mensaje">
				      <i class="fa fa-ban"></i>
				      	
				      </div>

			      	   <div class="alert alert-success alert-dismisable" style="display:none" id="exito">
				      <i class="fa fa-ban"></i>
				      	
				      </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button onclick="cancelar_pago(<?=$v['id']?>)" type="button" class="btn btn-primary">Guardar Cambios</button>
			      </div>
			    </div>
			  </div>
			</div>
			<?php endforeach ?>
</aside>