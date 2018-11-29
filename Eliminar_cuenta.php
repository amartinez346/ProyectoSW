<?php

include "includes/ParametrosDB.php";
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");


$mail=(string)$_GET['email'];



	$sql= "DELETE FROM usuarios WHERE email='$mail'";
	mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: GestionarCuentas.php'); 
    exit;

   






?>