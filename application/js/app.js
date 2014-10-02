function eliminar (id,controlador)
{
	$.post(URL_BASE+controlador+'/eliminar',{id:id},function(data){
		switch (data)
		{
			case '1':
				alert("Se ah eliminado con exito el registro");
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

function agregar_producto_carrito(id)
{
	alert(id);
	//var cantidad="#cantidad-"+id;
	var cantidad=$("#cantidad-"+id).val();
	//alert(cantidad);
	$.post(URL_BASE+'ventas/agregar_producto',{id:id,cantidad:cantidad},function(data){

	});
}

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