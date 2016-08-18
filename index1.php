S
<?php
        session_start();
		//require('configuracion.php'); //Se conecta a la base de datos
        include 'funciones.php';
        $link= Conectarse();

if(isset($_SESSION["tipo"])){
switch($_SESSION["tipo"]){
						case 1: header("location: panel.php");
						break;
						case 2: header("location: menu_insp.php");
						break;
						case 3: header("location: monitorBitacora.php");
						break;
					}
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<title></title>
	</head>
	<body>

		<div id="pag">
			<div class="log">
				<div class="logo"><img src="images/logo.jpg" width="445" height="120" alt="desarrollo" style="margin-top:5px;"></div>
				<form id="form" method="post" action="loginVal.php">
					<div id="frm_ind">
						<div class="titulos">Login:</div>
						<div class="campos"><input type="text" id="login" name="login"></div>
						<div class="titulos">Password:</div>
						<div class="campos"><input type="password" id="pass" name="pass"></div>
						<div class="boton"><input type="submit" id="ing"  value="Ingresar" name="ing" class="bot"/></div>
					</div>
				</form>
				<div id="contenido">
					<?php
						if (isset($_SESSION["log"])) {
							if ($_SESSION["log"]==1){
								echo 'Usuario o contrase&ntilde;a inconrrectos';
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
