<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?> 
<?php

require('configuracion.php');

require('funciones.php');

$id = $_GET["id"];

if(empty($id)) Header("Location: index.php");





$sql = "SELECT id, autor, titulo, mensaje, ";

$sql.= "DATE_FORMAT(fecha, '%d/%m/%Y') as enviado FROM foro ";

$sql.= "WHERE id='$id' OR identificador='$id' ORDER BY fecha ASC";

$rs = mysql_query($sql, $con);

include('header1.html');

if(mysql_num_rows($rs)>0)

{

	include('titulos_post.html');

	$template = implode("", file('post.html'));



    $color=="#5b69a6";



    while($row = mysql_fetch_assoc($rs))

	{

        if ($color=="#5b69a6")

        {

            $color="#72A673";

        }

        else

        {

            $color="#5b69a6";

        }



        $row["color"] = $color;





		$row["mensaje"] = nl2br($row["mensaje"]);

		$row["mensaje"] = parsearTags($row["mensaje"]);

		//mostrarTemplate($template, $row);



        ?>



        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="<?php print $row["color"] ?>">

            <tr>

                <td width="25%" valign="top"> <b><a name="<?php print $row["id"] ?>">

                    <?php print $row["autor"] ?></a>

                    </b><br>

                    <font size="-2">Enviado el : <?php print $row["enviado"] ?></font>

	            </td>

                <td>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                            <td><strong><font size="-1">

                                <?php print $row["titulo"] ?>

                                </font></strong>

                            </td>

                            <td width="10%" align="right">

                            [<a href="respuesta.php?id=<?php print $row["id"] ?>&citar=1">ANOTAR</a>]

                            </td>

                        </tr>

                    </table>

                    <hr align="center" width="100%" size="2" noshade>

                    <?php print $row["mensaje"] ?>

                </td>

            </tr>

            <tr>

                <td colspan="2" height="5">

                </td>

            </tr>

        </table>

        <?php



	}

}

include('footer.html');

?>