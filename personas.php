<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php

require('configuracion.php'); //Se conecta a la base de datos
require('funciones.php'); //Llama las funciones que incluyen el template
include('header1.html');//Coloca el encabezado de la pagina

$sql = "SELECT DISTINCT autor FROM foro WHERE identificador=0 AND finalizado=0 ORDER BY autor ASC";
$rs = mysql_query($sql, $con);

?>
<form action="index.php" method="post">
    <?php
    print "<select name='autor' size='1'>";
    while($row = mysql_fetch_assoc($rs))
    {
        print "<option>".$row['autor']."</option>";
    }
    print "</select>";
    ?>

    <input type="submit" name="fin" value="Aceptar">


</form>