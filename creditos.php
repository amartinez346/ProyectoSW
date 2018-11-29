<?php
include "includes/ParametrosDB.php";
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
    session_start();    
	if (isset($_SESSION['mail'])){
		$mail = $_SESSION['mail'];
		if($mail=="admin@ehu.es"){
			echo("<script>window.location = 'login.php';</script>");
		}	
	}else{
		 echo("<script>window.location = 'login.php';</script>");
	}	
include "includes/menu.php";	
?>	
	<h1>ESTE TRABAJO ESTA HECHO POR:</h1>
	<div>
		Gorka Salaberria y Aitor Martinez. 
		Especialistas en Software. 
		 Residentes en Donostia. <br>
		<img src="imagenes/IMG_20170825_195144.jpg" alt="Sexy man" width="200" height="150">
		<img src="imagenes/20181005_130348.jpg" alt="Sexy man 2" width="200" height="150">
		<table id="GeoResults"></table>
	</div>
<?php include "includes/footer.php"; ?>