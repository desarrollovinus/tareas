<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<script type="text/javascript" src="java/fechas.js">
</script>



<style type='text/css'>
   textarea
   {
        white-space: normal;
        overflow: hidden;
        overflow-y: scroll;

   }
 </style>


<?php
require('funciones.php');

$id = $_GET["id"];
$citar = $_GET["citar"];
$row = array("id" => $id);



if($citar==1)

{
	require('configuracion.php');
	$sql = "SELECT seccion, autor, area, vence, titulo, mensaje, avance, identificador AS id FROM foro WHERE id='$id'";
	$rs = mysql_query($sql, $con);



	if(mysql_num_rows($rs)==1) $row = mysql_fetch_assoc($rs);

	$row["autor"] = trim($row["autor"]);
	$row["titulo"] = trim($row["titulo"]);
	$row["mensaje"] = trim($row["mensaje"]);

	if($row["id"]==0) $row["id"]=$id;

}

//$template = implode("", file('formulario.html'));

include('header1.html');

//mostrarTemplate($template, $row);

?>

<table width="90%" border="0">

    <form name="f" action="agregar.php" method="post">
        <input type="hidden" name="identificador" value="<?php print $row["id"] ?>">
        <tr>
            <th>
                VINUS FOR-01-01
            </th>
            <th  align="center">
                Area
            </th>
            <th  align="center">
                Responsable
            </th>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                <!-- <input type="text" name="area" value="<?php print $row["area"] ?>"> -->
                <select name="area" size="1">
                    <option <?php if($row["area"]=="Diseño") print "selected";?>>Diseño</option>
                    <option <?php if($row["area"]=="Social") print "selected";?>>Social</option>
                    <option <?php if($row["area"]=="Ambiental") print "selected";?>>Ambiental</option>
                    <option <?php if($row["area"]=="Predios") print "selected";?>>Predios</option>
                    <option <?php if($row["area"]=="Construcción") print "selected";?>>Construcción</option>
                    <option <?php if($row["area"]=="Operación") print "selected";?>> Operaci&oacute;n</option>
                    <option <?php if($row["area"]=="Jurídica") print "selected";?>>Jur&iacute;dica</option>
                    <option <?php if($row["area"]=="Asesoría") print "selected";?> >Asesor&iacute;a</option>
                    <option <?php if($row["area"]=="Financiera") print "selected";?>>Financiera</option>
                    <option <?php if($row["area"]=="Sistemas") print "selected";?>>Sistemas</option>
                    <option <?php if($row["area"]=="Dirección") print "selected";?>>Direcci&oacute;n</option>
                    <option <?php if($row["area"]=="Otro") print "selected";?>>Otro</option>
                </select>
            </td>
            <td align="center">
                <input type="text" name="autor" value="<?php print $row["autor"] ?>">


            </td>
        </tr>
        <tr>
            <th></th>
            <th align="center">
                Avance
            </th>
             <th align="center">
                Vencimiento
            </th>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                <input type="text" name="avance" value="<?php print $row["avance"] ?>">
            </td>
            <td align="center">
                <input type="date" name="vence" onclick='scwShow(this,event);'  value="<?php print $row["vence"] ?>">
            </td>
        </tr>
        <tr>
            <th></th>
            <th aling="center">
                Secci&oacute;n
            </th>
            <th  align="center">
                Actividad
            </th>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                <input type="text" name="seccion" value="<?php print $row["seccion"] ?>">
            </td>
            <td>
                <textarea name="titulo" cols="105" rows="2" maxlength="200" <?php if($citar==1) print " readonly"; ?> >
                    <?php print $row["titulo"]?>
                </textarea>
            </td>
        </tr>
        <tr>
            <th>
            </th>
            <th  colspan="2" align="center">
                Descripción
            </th>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <textarea name="mensaje" cols="125" rows="5">
                    <?php print $row["mensaje"] ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td colspan="2" align="center">
                <input type="submit" name="grabar" value="Grabar">
                <input type="submit" name="fin" value="Terminado">
            </td>
        </tr>
    </form>
</table>


<?php
include('footer.html');
?>