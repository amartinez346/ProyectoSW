<?php    
    session_start(); 
	$mail = $_SESSION['mail'];
	include "includes/menu.php";?>

	<h2>Se ha producido algún error, vuelva a interntarlo</h2><br>
	<a href='preguntas.php'>Ir a insertar pregunta</a>
		
<?php include "includes/footer.php"; ?>