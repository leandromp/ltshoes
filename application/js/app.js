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
