<?php
include "includes/ParametrosDB.php";
	if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");
	
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	
	if (isset($_POST['submit']))
		{
			//insertar usuario
			$mail=$_POST['mail'];
			$name=$_POST['Nombre'];
			$apellidos=$_POST['Apellidos'];
			$password=$_POST['Contrasena'];
			$hashed_password = crypt($password, 'rl');
			$recovery = generateRandomString(20);

			$sql="insert into usuarios(email,nombre,apellidos,contrasena,recovery)
				values('$mail','$name','$apellidos','$hashed_password','$recovery')";
											
			mysqli_query($con,$sql);	
			
			header("Location: login.php");
		}	

mysqli_close($con);
include "includes/menu_sin_registro.php";		
?>

<form id='registro' name='registro' action='registro.php' method="POST" enctype="multipart/form-data">
		<div>
			Dirección de Correo*:
			<input type="text" class="form-control" id="mail" name="mail" />
		</div>
		<div>
			Nombre*:
			<input type="text" class="form-control" id="Nombre" name="Nombre"/>
		</div>
		<div>
			Apellidos*:
			<input type="text" class="form-control" id="Apellidos" name="Apellidos"/>
		</div>
		<div>
			Contraseña*:
			<input type="password" class="form-control" id="Contrasena" name="Contrasena"/>
		</div>
		<div>
			Repetir Contraseña*:
			<input type="password" class="form-control" id="Contrasena_rep" name="Contrasena_rep"/>
		</div>
		<!--<div class="imagen">
			<input name="file-input" id="file-input" type="file" />
			<br/>
			<img id="imgSalida"/><br>
			<input type="button" id="elim" value="Eliminar Imagen" name="Eliminar Imagen" style="visibility: hidden;"/>
		</div>-->
		<div class="button">
        <button type="submit" id="Boton" name="submit" disabled>Registrarse</button>
		</div>
		<br>
		<div id="error" style="color:#FF0000;">
		
		</div>
</form>




<script src="libreria/jquery-3.3.1.js"></script>
	<script>
	var mail_sw = false;
	var dif_cont = false;
		$(document).ready(function() {
		//Siempre que salgamos de un campo de texto, se chequeará esta función
			$("#registro input").keyup(function() {
				var correcto = false;
		
				var nombre = $("#Nombre").val();
				var apellidos = $("#Apellidos").val();
				var contrasena = $("#Contrasena").val();
				var contrasena_rep =$("#Contrasena_rep").val();
				if(nombre.length >= 1 && apellidos.length >= 1 && contrasena.length >= 8 && contrasena==contrasena_rep){
					correcto = true;
				}
				else{
					correcto = false;
				}

				
				
				var check_mail = checkEmail();
				if(correcto && check_mail && mail_sw && dif_cont) {
					$("#Boton").prop("disabled", false);
				}
				else {
					$("#Boton").prop("disabled", true);
				}
				
			});
		});
		
		
		//Funcion para comprobar el email
		function checkEmail(){
			var correo = $('#mail').val();
			var expresion = /^[a-zA-Z]+[0-9]{3}@ikasle.ehu.eus$/;
			if (expresion.test(correo)){
			$('#mail').css("border", "3px solid green");
				return true;
			}
			else{
				$('#mail').css("border", "3px solid red");
				return false;
			}
		};
		
		
		
		var $mail = $('#mail');
		var $cont = $('#Contrasena');
		
		$mail.change(function () {
			desactivar();
			$.ajax({url: "comprobarMail.php?mail=" + $mail.val(), cache: false, success: function(result){
				if (result == "SI") {
					mail_sw = true;
					document.getElementById("error").innerHTML="";	
				} else {
					mail_sw = false;
					document.getElementById("error").innerHTML="Mail no registrado en SW";
				}
			}});
		});
		
		
		
		$cont.change(function () {
			desactivar();
			var $ticket=1010;
			$.ajax({url: "ComprobarContrasena.php?cont=" + $cont.val()+"&ticket="+$ticket, cache: false, success: function(resultado){
				if (resultado === "VALIDA") {
					dif_cont = true;
					document.getElementById("error").innerHTML="";					
				} else {
					dif_cont = false;
					document.getElementById("error").innerHTML="Contraseña no valida";
				}
			}});
		});
	
		function desactivar() {
			$("#Boton").prop("disabled", true);
		}
			

</script>

<?php include "includes/footer.php"; ?>