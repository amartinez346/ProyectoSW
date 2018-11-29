<?php

include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
	if (isset($_POST['submit'])){
		
		$mail=$_POST['mail'];
		$password=$_POST['password'];
		$usuarios = mysqli_query( $con,"select * from usuarios where email ='$mail'");
		
		$cont= mysqli_num_rows($usuarios); //Se verifica el total de filas devueltas
		
		if($cont==1){
			$usuario = mysqli_fetch_array($usuarios);
			if (hash_equals($usuario['contrasena'], crypt($password, 'rl'))) {
				session_start(); 
				$_SESSION['mail']=$mail;
				if($mail=="admin@ehu.es"){
					echo("<script>alert('BIENVENIDO AL SISTEMA')</script>");
					echo("<script>window.location = 'GestionarCuentas.php';</script>");
				}else{
					$row = mysqli_fetch_array($usuarios);
					if ($row['estado']=="bloqueado"){
						echo("<script>alert('Usuario Bloqueado')</script>");
						echo("<script>window.location = 'login.php';</script>");
					}else{
						echo("<script>alert('BIENVENIDO AL SISTEMA')</script>");
						echo("<script>window.location = 'GestionPreguntas.php';</script>");
					}
					
				}
			}

            
		}else{
			echo("<script>alert('ERROR')</script>");
            echo("<script>window.location = 'login.php';</script>");
		}

		
		
		mysqli_close($con); //cierra la conexion
		
	}
	
include "includes/menu_sin_registro.php";	
?>
	<h1>Login</h1>
	
	<br>
	<br>	
	<form id = 'login' name ='login' action = 'login.php' method="POST" enctype="multipart/form-data">
    
	<div>
	<label for="mail"><b>Email</b></label>
    <input type="text" name="mail" id="mail">
	
	<br>
	<br>
    <label for="password"><b>Password</b></label>
    <input type="password" name="password" id="password">
    <br>
	<br>
    <button type="submit" name="submit">Login</button>
	<input type="button" id="recuperar" value="Recuperar Contraseña" name="recuperar" onClick="document.location.href='RecuperarContrasena.php'"/>
	</div>
    </section>
	</form>
	

<?php


include "includes/footer.php"; 

 ?>
