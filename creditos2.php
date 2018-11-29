<?php
session_start();
include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
		
include "includes/menu_sin_registro.php";	
?>	
	<h1>ESTE TRABAJO ESTA HECHO POR:</h1>
		<p1> Gorka Salaberria y Aitor Martinez. </p1>
		<p1> Especialistas en Software. </p1>
		<p1> Residentes en Donostia. </p1> <br>
		<img src="imagenes/IMG_20170825_195144.jpg" alt="Sexy man" width="200" height="150">
		<img src="imagenes/20181005_130348.jpg" alt="Sexy man 2" width="200" height="150">
	</div>
<?php include "includes/footer.php"; ?>