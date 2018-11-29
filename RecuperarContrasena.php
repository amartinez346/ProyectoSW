<?php

include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
	

	if (isset($_POST['submit'])){
			
		$mail=$_POST['mail'];
		$subject='Recuperar Contraseña';
		$usuarios = mysqli_query( $con,"select * from usuarios where email ='$mail'");
		$cont= mysqli_num_rows($usuarios);
		if($cont==1){
			$usuario = mysqli_fetch_array($usuarios);
			$codigo=$usuario['recovery'];
			session_start(); 
			$_SESSION['mail']=$mail;
			$_SESSION['codigo']=$codigo;
			mail($mail,$subject,$codigo);
			echo("<script>window.location = 'CambiarContrasena.php';</script>");
		}
	}	
	include "includes/menu_sin_registro.php";
 ?>		
		
	<h1>Recuperar Contraseña</h1>
	
	<br>
	<br>	
	<form id = 'recuperar' name ='recuperar' action = 'RecuperarContrasena.php' method="POST" enctype="multipart/form-data">
    
	<div>
	<label for="mail"><b>Email</b></label>
    <input type="text" name="mail" id="mail">
    <br>
	<br>
    <button type="submit" name="submit">Enviar</button>
	</div>
    </section>
	</form>


	
<?php


include "includes/footer.php"; 

 ?>