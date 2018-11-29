<?php
include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
	if(!isset($_SESSION)) { 
        session_start(); 
    }else{
        session_destroy();
        session_start(); 
    }	
	$mail = $_SESSION['mail'];
include "includes/menu.php";	
?>		

		<form id='fpreguntas' name='fpreguntas' action='insertarPreguntaConFoto.php' method="POST" enctype="multipart/form-data">
		<div>
			Dirección de Correo*:
			<input type="text" class="form-control" id="mail" name="mail" value="<?php echo($mail);?>"/>
		</div>
		<div>
			Enunciado Pregunta*:
			<input type="text" class="form-control" id="Pregunta" name="Pregunta"/>
		</div>
		<div>
			Respuesta Correcta*:
			<input type="text" class="form-control" id="Respuestacorrecta" name="Respuestacorrecta"/>
		</div>
		<div>
			Respuesta Incorrecta 1*:
			<input type="text" class="form-control" id="Respuestaincorrecta1" name="Respuestaincorrecta1"/>
		</div>
		<div>
			Respuesta Incorrecta 2*:
			<input type="text" class="form-control" id="Respuestaincorrecta2" name="Respuestaincorrecta2"/>
		</div>
		<div>
			Respuesta Incorrecta 3*:
			<input type="text" class="form-control" id="Respuestaincorrecta3" name="Respuestaincorrecta3"/>
		</div>
		<div>
			Complejidad Pregunta (0-5)*:
			<input type="text" class="form-control" id="Complejidad" name="Complejidad"/>
		</div>
		<div>
			Tema*:
			<input type="text" class="form-control" id="Tema" name="Tema"/>
		</div>
		<div class="imagen">
			<input name="file-input" id="file-input" type="file" />
			<br/>
			<img id="imgSalida"/><br>
			<input type="button" id="elim" value="Eliminar Imagen" name="Eliminar Imagen" style="visibility: hidden;"/>
		</div>
		<div class="button">
        <button type="submit" id="Boton" name="submit" disabled>Crea tu pregunta</button>
    </div>
</form>

	</div>
	</section>
	<footer class='main' id='f1'>
		<a href='https://github.com/amartinez346/Proyecto'>Link GITHUB</a>
	</footer>
</div>

	<script src="libreria/jquery-3.3.1.js"></script>
	<script>
		$(document).ready(function() {
		//Siempre que salgamos de un campo de texto, se chequeará esta función
		$("#fpreguntas input").keyup(function() {
			var correcto = false;
			var correcto_compl = false;
			var pregunta = $("#Pregunta").val();
			var respuestabien = $("#Respuestacorrecta").val();
			var respuestamal1 = $("#Respuestaincorrecta1").val();
			var respuestamal2 =$("#Respuestaincorrecta2").val();
			var respuestamal3 =$("#Respuestaincorrecta3").val();
			var complejidad = $("#Complejidad").val();
			var tema = $("#Tema").val();
			if(pregunta.length >= 10 && respuestabien.length >= 1 && respuestamal1.length >= 1 && respuestamal2.length >= 1 && respuestamal3.length >= 1 && tema.length >= 1){
				correcto = true;
			}
			else{
				correcto = false;
			}
			
			if( complejidad >= 0 && complejidad <= 5){
				correcto_compl= true;
			}
			else{
				correcto_compl = false;
			}
			
			
			var check_mail = checkEmail();
			if(correcto && check_mail && correcto_compl) {
				$("#Boton").prop("disabled", false);
			}
			else {
				$("#Boton").prop("disabled", true);
				}
			});
		
		$("#elim").click(function(){
			$("#elim").css("visibility", "hidden");		
			document.getElementById("file-input").value=""; 
			document.getElementById("imgSalida").removeAttribute("src"); 
			document.getElementById("imgSalida").removeAttribute("width"); 
			document.getElementById("imgSalida").removeAttribute("height"); 
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
		}
		
		//insertar imagen y hacerla visible
		$(document).ready(function(){

			$(function() {
				$('#file-input').change(function(e) {
				addImage(e);
				});

				function addImage(e){
					var file = e.target.files[0],
					imageType = /image.*/;
			
					if (!file.type.match(imageType))
					return;
		  
					var reader = new FileReader();
					reader.onload = fileOnload;
					reader.readAsDataURL(file);
				}
		  
				function fileOnload(e) {
					var result=e.target.result;
					$('#imgSalida').attr("src",result);
					$('#imgSalida').attr("width",100);
					$('#imgSalida').attr("height",100);
					$("#elim").css("visibility", "visible");
				}
				
			});
		 });
		 
		 
	</script>
</body>
</html>