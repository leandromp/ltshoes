function eliminar (id,controlador)
{
	$.post(URL_BASE+controlador+'/eliminar',{id:id},function(data){
		switch (data)
		{
			case '1':
				alert("Se ah eliminado con exito el registro");
				if(controlador=='talles')
				{
					controlador='configuraciones'
				}
				window.location.href=URL_BASE+controlador;
				break;
			case '2':
				alert("hubo un error al intentar ejecutar la accion, avise al administrador del sistema");
				break;

				
		}
	});
}

function cambiar_perfil()
{
	var perfil=$("#perfil").val();
	$.post(URL_BASE+'modulos/cambiar_perfil',{perfil:perfil},function(data){
		$("#cuerpo").html(data);
	});
}
/***************************** FUNCIONES PARA EL CARRITO DE COMPRA ************************************************/
function agregar_producto_carrito(id)
{
	//alert(id);
	//var cantidad="#cantidad-"+id;
	var cantidad=$("#cantidad-"+id).val();
	var talle=$("#talle-"+id).val();
	var stock=$("#stock-"+id).html();
	$("#btn-agregar").hide();
	$.post(URL_BASE+'ventas/agregar_producto',{id:id,cantidad:cantidad,talle:talle,stock:stock},function(data){
		switch(data.res)
		{
			case 1:
				$("#btn-agregar").show();
				$('#cantidad-'+id).val('');
				$("#cantidad-productos").html(data.cantidad)
				break
			case 2:
				$("#btn-agregar").show();
				alert('las cantidad no pueden ser menores o iguales a 0');
				break;
			case 4:
				$("#btn-agregar").show();
				alert('la cantidad es mayor al stock actual no se puede agregar');
				break;
		}
	},'json');
}

function eliminar_producto_carrito(id)
{
	$.post(URL_BASE+'ventas/eliminar_producto_carrito',{id:id},function(data){
		switch (data.res)
		{
			case 1: 
				$("#example1").load();
				break;
			default:
				alert('ocurrio un problema');
		}
	},'json');
}


/******************************************************************************************************************/


function agregar_talle(producto_id,i)
{
	
	$.post(URL_BASE+'productos/dame_talles',{producto_id:producto_id},function(data) {
		i=i+1;
		var select='<select id=talle'+i+'>';
		$.each(data, function(index, val) {
			 select=select+'<option value="'+val.id+'">'+val.numero+'</option>';
		});
		
		 select = select + '</select>'
		$("#example1").append('<tr id="fila'+i+'"><td>'+select+'</td><td><input id="cantidad'+i+'" name="combo'+i+'" value="0"> </td><td><button role="button" class="btn btn-info" onclick="guardar_talle('+i+','+producto_id+',1)"> Guardar </button> </td><td><button role="button" class="btn btn-danger" onclick="eliminar_talle('+i+')"> Eliminar </button> </td></tr>');
		$("#agregar_linea").html('<button onclick="agregar_talle('+producto_id+','+i+')" type="button" class="btn btn-success btn-flat"> Agregar Talle </button>')
	},'json');

	
}

function eliminar_talle(id_linea)
{
	$("#fila"+id_linea).remove();
}

function eliminar_talle_id(id)
{

	$.post(URL_BASE+'productos/eliminar_talle',{id:id},function(data){
		switch(data)
		{
			case '1':
				eliminar_talle('A'+id);
				break;
			case '2':
				alert('ocurrio un error avise al administrador');
				break;
		}
	});

}

function guardar_talle(i,id_producto,opcion)
{

	if(opcion==0)
		var talle = $("#talle"+i).text();
	else
		var talle = $("#talle"+i).val();

	var cantidad = $("#cantidad"+i).val();

	$.post(URL_BASE+'productos/guardar_talle',{id_producto:id_producto,talle:talle,cantidad:cantidad},function(data){
		switch(data)
		{
			case '1':
				alert('Datos guardados correctamente');
				break;
			case '2':
				alert('debe ingresar una cantidad mayor a 0');
				break;
		}
	});
}

function cambiar_plan_pago(monto)
{
	var opcion_id=$("#plan-pago").val();
	var monto_cuota;
	var cantidad_cuotas;

	switch(opcion_id)
	{
		case '1':
			monto_cuota = cacular_monto_cuotas(monto,16);
			$("#cantidad-pagos").val(16);
			$("#monto-cuota").val(monto_cuota);
		break;
		case '2':
			monto_cuota = cacular_monto_cuotas(monto,8);
			$("#cantidad-pagos").val(8);
			$("#monto-cuota").val(monto_cuota);
		break;
		case '3':
			monto_cuota = cacular_monto_cuotas(monto,4);
			$("#cantidad-pagos").val(4);
			$("#monto-cuota").val(monto_cuota);
		break;
	}
}

function cacular_monto_cuotas(monto,cuotas)
{
	var temp=monto/cuotas;
	return temp;
}

/*************************************************************************************************/

function cancelar_pago(id)
{
	/* falta actualizar la cuenta corriente */
	var fecha = $("#fecha"+id).val();
	var monto = $("#monto"+id).val();
	var id_empleado = $("#empleado").val();
	$.post(URL_BASE+'ccorrientes/cancelar_pago',{id:id,monto:monto,fecha:fecha,id_empleado:id_empleado},function(data){
		switch (data.res)
		{
			case '1':
				$("#exito").append('Se guardaron los datos con exito');
				$("#exito").show();
				setTimeout(function(){
				$("#exito").hide();
				location.reload();
				},5000);
				
			break;
			case '2':
				$("#mensaje").append('No se puede enviar ningun campo vacio, intentelo de nuevo');
				$("#mensaje").show();
			setTimeout(function(){
				$("#mensaje").hide();
			},3000);
			break;
		}
			
	},'json');
}
/**************************************************************************************************/
function cambiar_cantidad(id_producto)
{
	var nombre = '#talle-'+id_producto+' option:selected';
	var talle = $(nombre).val();
	$.post(URL_BASE+'ventas/mostrar_stock',{talle:talle,producto_id:id_producto},function(data){
		
		$("#stock-"+id_producto).html(data);
	},'json');
	//alert (talle);
}

function dashboard_tablas(id)
{
	var valor="";
	switch(id)
	{
		case 1:
			valor = "Ver detalles de : Ventas";
		break;
		case 2:
			valor = "Ver detalles de : Compras";
		break;
	}
	$("#titulo-reporte").html(valor);
	$("#titulo-reporte").attr("name",id);
}

function ver_resultados_reportes()
{
	var id_tabla = $("#titulo-reporte").attr("name");
	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
	$.post(URL_BASE+'reportes/mostrar_reporte',{desde:desde,hasta:hasta,id_tabla:id_tabla},function(data){
		switch(data)
		{
			default:
				$("#example1").html('');
				$("#example1").append(data);
			break;
			case '2':
				alert('debe seleccionar al menos un tipo de reporte de los de arriba');
			break;
			case '3':
				alert('la fecha desde debe ser menor que la fecha hasta');
			break;
		}
	});
}

function informe_moras()
{
	$.post(URL_BASE+"reportes/ver_moras",{},function(data){
		$("#example1").html('');
		$("#example1").append(data);
	});
}



/***************************************************************************************************************/
function agregar_opcion()
{
	var tipo = $("#tipo").val();
	var valor = $("#valor").val();
	$.post(URL_BASE+'configuraciones/agregar_opcion',{valor:valor,tipo:tipo},function(data){
			switch(data)
			{
				case '1':
					$("#exito").append('Se guardaron los datos con exito');
					$("#exito").show();
					setTimeout(function(){
					$("#exito").hide();
					location.reload();
					},5000);
				break;
				default :
					$("#mensaje").append('No se puede enviar ningun campo vacio, intentelo de nuevo');
					$("#mensaje").show();
				setTimeout(function(){
					$("#mensaje").hide();
				},3000);
				break;
			}
	});
}