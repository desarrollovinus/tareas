document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.ui.mouse.js"></script>');
document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.ui.draggable.js"></script>');
document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.ui.position.js"></script>');
document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.ui.resizable.js"></script>');
document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.ui.dialog.js"></script>');
document.write('<script type="text/javascript" src="produccion/development-bundle/ui/jquery.effects.core.js"></script>');


//esta funcion saca la ventana de confirmacion jquery
function abrir_ventana_cargando(titulo)
{
	//se destruye el elemento dialog
	$( "#dialogo:ui-dialog" ).dialog( "destroy" );
	//se remueve el div con id="dialog-confirm" del documento html
	$('#dialogo').remove();
	//en el template hay un div con id="cargando", despues de ese div se agrega otro con id="dialog-confirm"
	$('#cargando').append('<div id="dialogo"></div>');
	//al div que se acaba de crear se le agrega el atributo title="¿Desea borrar este propietario?"
	$('#dialogo').attr('title', titulo);
	//tambien se le agrega el siguiente codigo html entre sus tags de inicio y final
	$('#dialogo').html('<center><img src="produccion/img/prettyLoader/ajax-loader.gif"></center>');
	//se le da formato con la libreria de jquery y se muestra con las opciones siguientes
	$( "#dialogo" ).dialog({
		resizable: false,
		height:80,
		width:420,
		modal: true
	});
}

//esta funcion saca la ventana de confirmacion jquery
function abrir_ventana_mensaje(titulo, mensaje)
{
	//se destruye el elemento dialog
	$( "#dialogo:ui-dialog" ).dialog( "destroy" );
	//se remueve el div con id="dialog-confirm" del documento html
	$('#dialogo').remove();
	//en el template hay un div con id="cargando", despues de ese div se agrega otro con id="dialog"
	$('#cargando').append('<div id="dialogo"></div>');
	//al div que se acaba de crear se le agrega el atributo title="¿Desea borrar este propietario?"
	$('#dialogo').attr('title', titulo);
	//tambien se le agrega el siguiente codigo html entre sus tags de inicio y final
	$('#dialogo').html('<p>' + mensaje + '</p>');
	//se le da formato con la libreria de jquery y se muestra con las opciones siguientes
	$( "#dialogo" ).dialog({
		resizable: false,
		height:200,
		width:420,
		modal: true,
		buttons: {
			OK: function() {
				$('input[type=submit]').removeAttr('disabled');
				//se destruye el elemento dialog
				$( "#dialogo:ui-dialog" ).dialog( "destroy" );
				//se remueve el div con id="dialog-confirm" del documento html
				$('#dialogo').remove();
				//se cierra el elemento flotante
				$( this ).dialog( "close" );
			}
		}
	});
}

//esta funcion saca la ventana de resumen de recorrido jquery
function abrir_ventana_resumen(redirecciona, direccion, titulo, abscisa_salida, abscisa_llegada, tramo_salida, tramo_llegada, hora_salida, hora_llegada)
{
	//se destruye el elemento dialog
	$( "#dialogo:ui-dialog" ).dialog( "destroy" );
	//se remueve el div con id="dialog-confirm" del documento html
	$('#dialogo').remove();
	var tabla = '<table>';
		tabla += '<tr>';
			tabla += '<th>Hora de salida:</th>';
			tabla += '<td>' + hora_salida + '</td>';
			tabla += '<th>Hora de llegada:</th>';
			tabla += '<td>' + hora_llegada + '</td>';
		tabla += '</tr>';
		tabla += '<tr>';
			tabla += '<th>Tramo de salida:</th>';
			tabla += '<td>' + tramo_salida + '</td>';
			tabla += '<th>Tramo de llegada:</th>';
			tabla += '<td>' + tramo_llegada + '</td>';
		tabla += '</tr>';
		tabla += '<tr>';
			tabla += '<th>Abscisa de salida:</th>';
			tabla += '<td>' + abscisa_salida + '</td>';
			tabla += '<th>Abscisa de llegada:</th>';
			tabla += '<td>' + abscisa_llegada + '</td>';
		tabla += '</tr>';
	tabla += '</table>';	
	
	//en el template hay un div con id="cargando", despues de ese div se agrega otro con id="dialogo"
	$('#cargando').append('<div id="dialogo" align="center">' + tabla + '</div>');
	//al div que se acaba de crear se le agrega el atributo title="¿Desea borrar este propietario?"
	$('#dialogo').attr('title', titulo);
	//se le da formato con la libreria de jquery y se muestra con las opciones siguientes
	$( "#dialogo" ).dialog({
		autoOpen: true,
		height: 215,
		width: 850,
		modal: true,
		buttons: {
			OK: function() {
				//se destruye el elemento dialog
				$( "#dialogo:ui-dialog" ).dialog( "destroy" );
				//se remueve el div con id="dialog-confirm" del documento html
				$('#dialogo').remove();
				//se cierra el elemento flotante
				$( this ).dialog( "close" );
				if(redirecciona == true) {
					abrir_ventana_cargando('La salida se guard&oacute; exitosamente');
					location.href = direccion;
				}
			}
		}
	});
}