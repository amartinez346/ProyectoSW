<?php

include "includes/ParametrosDB.php";
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");


$mail=(string)$_GET['email'];
$estado=(string)$_GET['estado'];


if(strcmp($estado, "Activar")==0){
	$sql= "UPDATE usuarios SET estado='activado' WHERE email='$mail'";
	mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: GestionarCuentas.php'); 
    exit;

}


if(strcmp($estado, "Bloquear")==0) {
	$sql= "UPDATE usuarios SET estado='bloqueado' WHERE email='$mail'";
	mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: GestionarCuentas.php'); 
    exit;

}
   






?>