<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php



//Recibe las variables de la página

//respuesta



require('configuracion.php');

$autor = $_POST["autor"];

$titulo = trim($_POST["titulo"]);

$seccion=$_POST["seccion"];

$mensaje = utf8_encode(trim($_POST["mensaje"]));

$ident = $_POST["identificador"];

$area= $_POST["area"];

$vence= $_POST["vence"];

$avance= $_POST["avance"];

$fin= $_POST["fin"];



//Si no hay responsable o descripción indica está

//situación



if(empty($autor)) $autor = "No se definió responsable";

if(empty($titulo)) $titulo = "No se digito actividad o avance";





//Evitamos que el usuario ingrese HTML



$mensaje = htmlentities($mensaje);



//Calcula el cumplimiento de la tarea como la relación entre el porentaje de avance reportado y

//el porcentaje de los días realmente transcurridos hasta la fecha.



$p_faltante=(strtotime($vence)-time())/86400;

$p_total=(strtotime($vence)-strtotime($fecha))/86400;

$p_ejecutado=($p_total-$p_faltante)/$p_total*100;

$cumplimiento=$avance/$p_ejecutado;



//Se graba el registro completo en la base de datos tareas.



$sql = "INSERT INTO foro (autor, seccion, titulo, mensaje, identificador, fecha, ult_respuesta, area, vence, avance, cumplimiento) ";

$sql.= "VALUES ('$autor','$seccion', '$titulo','$mensaje','$ident',NOW(),NOW(),'$area','$vence','$avance','$cumplimiento')";

$rs = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);

$ult_id = mysql_insert_id($con);





//Si se trata de una anotación de una tarea, se actualizan los datos de la tarea original.



if(!empty($ident))
{
    //Se actualiza los campos de la tarea con la nueva información

    $sql = "UPDATE foro SET respuestas=respuestas+1, ult_respuesta=NOW(), avance='$avance',";
	$sql.= "vence='$vence', area='$area', autor='$autor' WHERE id ='$ident'";
    $rs = mysql_query($sql, $con);


    //Si se ha terminado la tarea, se marca el campo que indica la finalización en la tarea
    //y todas sus anotaciones

    if($fin=="Terminado")
    {
        $sql = "UPDATE foro SET finalizado= '1'";
	    $sql.= "WHERE id='$ident' OR identificador='$ident'";
	    $rs = mysql_query($sql, $con);
    }


    //Calcula el cumplimiento en la ejecución de la tarea

    $sql = "SELECT fecha, vence, avance ";
    $sql.= "FROM foro WHERE id='$ident'";

    $rs = mysql_query($sql, $con);
    $row = mysql_fetch_assoc($rs);

    $p_faltante=(strtotime($row[vence])-time())/86400;
    $p_total=(strtotime($row[vence])-strtotime($row[fecha]))/86400;
    $p_ejecutado=($p_total-$p_faltante)/$p_total*100;
    $cumplimiento=$row[avance]/$p_ejecutado;



    $sql = "UPDATE foro SET cumplimiento='$cumplimiento'";
    $sql.= "WHERE id ='$ident'OR identificador='$ident'";
    $rs = mysql_query($sql, $con);

	Header("Location: foro.php?id=$ident#$ult_id");
	exit();
}

Header("Location: index.php");







?>