<?php
session_start();
if (isset($_SESSION['mail'])){
	$mail = $_SESSION['mail'];
}else{
	 echo("<script>window.location = 'login.php';</script>");
}
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
			
			if (!preg_match("/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.eus$/",$mail)) {
				die("Error: email no valido"); 
			}
			if(!preg_match("/[0-5]/",$Complejidad)){
				die("Error: complegidad no valida");
			}
			if(is_null($pregunta)){
				die("Error: pregunta vacia ");
			}
			if(is_null($respuestacorrecta)){
				die("Error: respuesta correcta vacia ");
			}
			if (is_null($Respuestaincorrecta1)){
				die("Error: respuesta incorrecta 1 vacia ");
			}
			if(is_null($Respuestaincorrecta2)){
				die("Error: respuesta incorrecta 2 vacia ");
			}
			if(is_null($Respuestaincorrecta3)){
				die("Error: respuesta incorrecta 3 vacia ");
			}
			if(is_null($Tema)){
				die("Error: tema vacio ");
			}
			$sql="insert into preguntas(email,pregunta,correcta,incorrecta1,incorrecta2,incorrecta3,complejidad,tema)
				values('$mail','$pregunta','$respuestacorrecta','$Respuestaincorrecta1','$Respuestaincorrecta2','$Respuestaincorrecta3',$Complejidad,'$Tema')";
				
			
			
			
			$xml = simplexml_load_file('preguntas.xml');
			$assessmentItem = $xml->addChild('assessmentItem');
			
			$assessmentItem->addAttribute('subject',$_POST['Tema']);
			$assessmentItem->addAttribute('author',$_POST['mail']);

			$itemBody = $assessmentItem->addChild('itemBody');
			$p = $itemBody->addChild('p', $_POST['Pregunta']);
			
			$correctResponse = $assessmentItem->addChild('correctResponse');
			$value = $correctResponse->addChild('value', $_POST['Respuestacorrecta']);
			
			$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
			$incorrectResponses->addChild('value', $_POST['Respuestaincorrecta1']);
			$incorrectResponses->addChild('value', $_POST['Respuestaincorrecta2']);
			$incorrectResponses->addChild('value', $_POST['Respuestaincorrecta3']);
			
			$xml->asXML('preguntas.xml');
			
			
			
											
			if(!mysqli_query($con,$sql))
			{
				header('Location: preguntaMal.php');
				//die('Error: ' . mysqli_error($con));
			}	
		}	

mysqli_close($con);
include "includes/menu.php";		
?>

		<h2>Pregunta almacenada en la BD</h2><br>
		<a href='verPreguntas.php'>Ver preguntas de la BD</a>
		
<?php include "includes/footer.php"; ?>