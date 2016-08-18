<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
?>
<?php

require('configuracion.php'); //Se conecta a la base de datos
require('funciones.php'); //Llama las funciones que incluyen el template
include('header1.html');//Coloca el encabezado de la pagina
/* Pedimos todos los temas iniciales (identificador==0)
* y los ordenamos por ult_respuesta */
$sql = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta, finalizado ";
$sql.= "FROM foro WHERE identificador=0 and finalizado=0 and autor='Jaime Fajardo' ORDER BY autor";
$rs = mysql_query($sql, $con);

if(mysql_num_rows($rs)>0)
{
	// Leemos el contenido de la plantilla de temas
    $template = implode("", file("temas.html"));
	include('titulos.html');
	while($row = mysql_fetch_assoc($rs))
	{
		$color=($color==""?"#5b69a6":"");
		$row["color"] = $color;
		mostrarTemplate($template, $row);
	}
}
include('footer.html');
?>