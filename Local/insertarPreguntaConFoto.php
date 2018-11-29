<?php
include "includes/ParametrosDB.php";
	if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");		
		
	if (isset($_POST['submit'])){
			$dir_destino = 'C:/xampp/htdocs/lab2/ProyectoSW/Local/imagenes_bd/';
			$dir='imagenes_bd/';
			
			//insertar pregunta
			$mail=$_POST['mail'];
			$pregunta=$_POST['Pregunta'];
			$respuestacorrecta=$_POST['Respuestacorrecta'];
			$Respuestaincorrecta1=$_POST['Respuestaincorrecta1'];
			$Respuestaincorrecta2=$_POST['Respuestaincorrecta2'];
			$Respuestaincorrecta3=$_POST['Respuestaincorrecta3'];
			$Complejidad=$_POST['Complejidad'];
			$Tema=$_POST['Tema'];
			
			echo "entra1";
			if ($_FILES['file-input']['size'] == 0){
				echo "entra2";
				$imagen_subida=$dir ."pordefecto.jpg";
				$sql="insert into Preguntas(email,pregunta,correcta,incorrecta1,incorrecta2,incorrecta3,complejidad,tema,imagen)
						values('$mail','$pregunta','$respuestacorrecta','$Respuestaincorrecta1','$Respuestaincorrecta2','$Respuestaincorrecta3',$Complejidad,'$Tema','$imagen_subida')";
			}else{
				echo "entra3";
				$imagen_subida= $dir_destino . basename($_FILES['file-input']['name']);
				if(!is_writable($dir_destino)){
					echo "no tiene permisos";
				}else{
					if(is_uploaded_file($_FILES['file-input']['tmp_name'])){
						/*echo "Archivo ". $_FILES['file-input']['name'] ." subido con éxtio.\n";
						echo "Mostrar contenido\n";
						echo $imagen_subida;*/
						echo "entra";						
						if (move_uploaded_file($_FILES['file-input']['tmp_name'], $imagen_subida)) {
							$imagen_subida= $dir . basename($_FILES['file-input']['name']);
							$sql="insert into Preguntas(email,pregunta,correcta,incorrecta1,incorrecta2,incorrecta3,complejidad,tema,imagen)
								values('$mail','$pregunta','$respuestacorrecta','$Respuestaincorrecta1','$Respuestaincorrecta2','$Respuestaincorrecta3',$Complejidad,'$Tema','$imagen_subida')";
						}
					}	
					
	
				}				
			}
			
			if(!mysqli_query($con,$sql)){
				//die("Error: No se pudo conectar");
				header('Location: preguntaMal.php');
			}
			
	}

mysqli_close($con);
include "includes/menu.php";		
?>

		<h2>Pregunta almacenada en la BD con foto</h2><br>
		<a href='verPreguntasConFoto.php'>Ver preguntas de la BD</a>
		
<?php include "includes/footer.php"; ?>