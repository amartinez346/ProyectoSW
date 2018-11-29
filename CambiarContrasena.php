<?php
include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
	session_start(); 
	$mail=$_SESSION['mail'];
	$codigo=$_SESSION['codigo'];
	
	if (isset($_POST['submit'])){
		$contrasena=$_POST['contrasena'];
		if ($mail=$_POST['mail'] and $codigo=$_POST['codigo']){
			echo "entra";
			$sql="UPDATE usuarios SET contrasena='$contrasena' where email='$mail'";											
			mysqli_query($con,$sql);
			echo("<script>window.location = 'login.php';</script>");
		}	
	}	
	include "includes/menu_sin_registro.php";
 ?>		
		
	<h1>Cambiar Contraseña</h1>
	
	<br>
	<br>	
	<form id = 'cambiar' name ='recuperar' action = 'CambiarContrasena.php' method="POST">
    
		<div>
		<label for="mail"><b>Email</b></label>
		<input type="text" name="mail" id="mail" value="<?php echo($mail);?>">
		<br>
		<br>
		<label for="Contrasena"><b>Contraseña*:</b></label>
		<input type="password" class="form-control" id="contrasena" name="contrasena"/>
		<br>
		<br>
		<label for="Contrasena_rep"><b>Repetir Contraseña*:</b></label>
		<input type="password" class="form-control" id="Contrasena_rep" name="Contrasena_rep"/>
		<br>
		<br>
		<label for="Codigo"><b>Codigo*:</b></label>
		<input type="text" class="form-control" id="codigo" name="codigo"/>
		<br>
		<br>
		<button type="submit" name="submit" id="Boton" disabled>Enviar</button>
		</div>
	</form>


<script src="libreria/jquery-3.3.1.js"></script>
<script>
	$(document).ready(function() {
		//Siempre que salgamos de un campo de texto, se chequeará esta función
		$("#cambiar input").keyup(function() {
			var contrasena = $("#contrasena").val();
			var contrasena_rep =$("#Contrasena_rep").val();
			if(contrasena.length >= 8 && contrasena==contrasena_rep){
					correcto = true;
				}
				else{
					correcto = false;
				}

				if(correcto && dif_cont) {
					$("#Boton").prop("disabled", false);
				}
				else {
					$("#Boton").prop("disabled", true);
				}
		});
	
	});



	var $cont = $('#contrasena');
	$cont.change(function () {
		var $ticket=1010;
		$.ajax({url: "ComprobarContrasena.php?cont=" + $cont.val()+"&ticket="+$ticket, cache: false, success: function(resultado){
			if (resultado === "VALIDA") {
				dif_cont = true;				
			} else {
				dif_cont = false;
			}
		}});
	});
			

</script>	
<?php include "includes/footer.php"; ?>