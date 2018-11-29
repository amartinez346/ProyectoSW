<?php
include "includes/ParametrosDB.php";
	if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");		
		
	if (isset($_POST['submit']))
		{
			//insertar pregunta
			$mail=$_POST['mail'];
			$pregunta=$_POST['Pregunta'];
			$respuestacorrecta=$_POST['Respuestacorrecta'];
			$Respuestaincorrecta1=$_POST['Respuestaincorrecta1'];
			$Respuestaincorrecta2=$_POST['Respuestaincorrecta2'];
			$Respuestaincorrecta3=$_POST['Respuestaincorrecta3'];
			$Complejidad=$_POST['Complejidad'];
			$Tema=$_POST['Tema'];
			
			$sql="insert into Preguntas(email,pregunta,correcta,incorrecta1,incorrecta2,incorrecta3,complejidad,tema)
				values('$mail','$pregunta','$respuestacorrecta','$Respuestaincorrecta1','$Respuestaincorrecta2','$Respuestaincorrecta3',$Complejidad,'$Tema')";
				
			
											
			if(!mysqli_query($con,$sql))
			{
				//header('Location: preguntaMal.php');
				die('Error: ' . mysqli_error($con));
			}	
		}	

mysqli_close($con);
include "includes/menu.php";		
?>

		<h2>Pregunta almacenada en la BD</h2><br>
		<a href='verPreguntas.php'>Ver preguntas de la BD</a>
		
<?php include "includes/footer.php"; ?>