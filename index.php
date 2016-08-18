<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php

require('configuracion.php'); //Se conecta a la base de datos
require('funciones.php'); //Llama las funciones que incluyen el template
include('header1.html');//Coloca el encabezado de la pagina

if (isset($_GET['area'])) { $area = $_GET["area"];} else { $area = 'Todas';}
if (isset($_POST['personas'])) { $personas= $_POST["personas"]; }
if (isset($_POST['autor'])) { $personas= $_POST["autor"]; }



/* Pedimos todos los temas iniciales (identificador==0)
* y los ordenamos por ult_respuesta */
$sql = "SELECT id, seccion, autor, titulo, fecha, respuestas, ult_respuesta, vence, avance, finalizado, ";




if(!empty($autor))
{
    $sql.= "cumplimiento FROM foro WHERE autor= '$autor' AND identificador=0 AND finalizado=0 ORDER BY vence ASC";
    print "<p ALIGN='CENTER'>".$autor."<P>";
}
elseif ($area=="Todas")
{
    $sql.= "cumplimiento FROM foro WHERE identificador=0 AND finalizado=0 ORDER BY vence ASC";
}
elseif($area=="Terminados")
{
    $sql.= "cumplimiento FROM foro WHERE identificador=0 AND finalizado=1 ORDER BY vence ASC";
}
else
{
    $sql.= "cumplimiento FROM foro WHERE identificador=0 AND finalizado=0  AND area='$area' ORDER BY vence ASC";
}

$rs = mysql_query($sql, $con);



//print $rs;
//print mysql_num_rows($rs);

if(mysql_num_rows($rs)>0)
{
	// Leemos el contenido de la plantilla de temas
	//$template = implode("", file("temas.html"));
	include('titulos.html');


    while($row = mysql_fetch_assoc($rs))
	{
        $cumplimiento=$row['cumplimiento']*100;
        if ($cumplimiento<=90)
        {
            $color='#FFE0E0';
        }
        elseif ($cumplimiento > 90  and $cumplimiento <= 120 )
        {
            $color= '#FFFFCC';
        }
        elseif ($cumplimiento > 120)
        {
            $color= '#B8FFB8';
        }

        if($row['finalizado']==1)
        {
            $color = '#B8FFB8';
        }
        else
        {
            $row["color"] = $color;
        }

        $falta=(strtotime($row['vence'])-time())/86400;



        //mostrarTemplate($template, $row);

        ?>

        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="<?php print $color ?>">

            <tr>
                <td width="15%" align="center">
                    <a href="foro.php?id=<?php print $row[id]; ?>">
                        <font color="black">
                        <?php print $row['seccion']; ?>
                        </font>
                    </a>
                </td>


                <td width="40%" align="left">

                    <a href="foro.php?id=<?php print $row[id]; ?>">
                        <font color="black">
                        <?php print $row['titulo']; ?>
                        </font>
                    </a>

                </td>

                <td width="15%" align="center">
                    <font size="-2" color="black"><b>
                    <?php print $row['autor']; ?>
                    </b><br>
                    Cump: <?php if ($row['finalizado']==1)
                                {
                                    print "Cumplido";
                                }
                                Else
                                {
                                    print number_format($cumplimiento)."%";
                                }
                            ?>

                    </font>
                </td>
                <td width="15%" align="center">
                    <font size="-2" color="black"><b>
                    <?php print $row['respuestas']; ?>
                    </b><br>
                    <?php
                        if ($row['finalizado']==1)
                        {
                            print "------------";
                        }
                        Else
                        {
                            print "Ult. nota:".$row['fecha'];
                        }
                    ?>

                </td>

                <td width="15%" align="center">
                    <font size="2" color="black"><b>
                    Fin: <?php print $row['vence']; ?>
                    </b><br>



                   <font size="3" color="black">


                    <b>
                    <?php
                        if ($row['finalizado']==1)
                        {
                            print "Fin:".$row['fecha'];
                        }
                        Else
                        {
                            print "Faltan: ".number_format($falta)." d&iacute;as";
                        }
                    ?>
                    </b>
                    <font size="2" color="black">

                    </font>
                </td>
            </tr>
        </table>
        <?php
	}
}
include('footer.html');
?>
