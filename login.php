<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'apps');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
     // username and password sent from form

     $usuario = mysqli_real_escape_string($db, $_POST['usuario']);
     $pass = md5(mysqli_real_escape_string($db, $_POST['pass']));

     $sql = "SELECT
        	    usuarios.Pk_Id_Usuario
            FROM
        	   usuarios
            INNER JOIN permisos ON permisos.Fk_Id_Usuario = usuarios.Pk_Id_Usuario
            INNER JOIN tbl_aplicaciones ON permisos.Fk_Id_Aplicacion = tbl_aplicaciones.Pk_Id_Aplicacion
            WHERE
            	tbl_aplicaciones.Pk_Id_Aplicacion = 8
                AND usuarios.Usuario = '$usuario'
                AND usuarios.`Password` = '$pass'";

     $result = mysqli_query($db, $sql);

     $count = mysqli_num_rows($result);

     // If result matched $myusername and $mypassword, table row must be 1 row

     if($count == 1) {
        $_SESSION['usuario'] = $usuario;
        header("location: index.php");
     }else {
         $error = 'Error usuario y/o contraseña incorrectos';
     }
  }
  ?>

  <head>
      <title>HATOVIAL S.A. - BITACORA DE LA GESTIÓN PREDIAL</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:18px;
         }

         label {
            font-weight:bold;
            width:100px;
            font-size:16px;
         }

         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>Usuario  :</label><input type = "text" name = "usuario" class = "box"/> <br /><br />
                  <label>Contraseña  :</label><input type = "password" name = "pass" class = "box" /><br/>
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?= (isset($error)) ? $error : '' ; ?></div><br>
                  <input type = "submit" value = " Submit "/><br />
               </form>

            </div>

         </div>

      </div>

   </body>
</html>
