<?php
$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "hat0v1al";
$bd_base = "tareas";

$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
mysql_select_db($bd_base, $con);
?>
