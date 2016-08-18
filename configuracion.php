<?php
require ('session.php'); // antes de conectar a la base de datos pregunta si hay alguna session existente
$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "";
$bd_base = "tareas";
$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
mysql_select_db($bd_base, $con);
?>
