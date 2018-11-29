<?php
session_start();
include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
	if (isset($_SESSION['mail'])){
		$mail = $_SESSION['mail'];
		if($mail=="admin@ehu.es"){
			echo("<script>window.location = 'login.php';</script>");
		}	
	}else{
		 echo("<script>window.location = 'login.php';</script>");
	}
	
	
include "includes/menu.php";	
?>
	<div>
		<p id="numeropreguntas"></p>
	</div>
		<br>
		<form id='fpreguntas' name='fpreguntas' method="POST" enctype="multipart/form-data">
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
		<!--
		<div class="imagen">
			<input name="file-input" id="file-input" type="file" />
			<br/>
			<img id="imgSalida"/><br>
			<input type="button" id="elim" value="Eliminar Imagen" name="Eliminar Imagen" style="visibility: hidden;"/>
		</div>
		-->
		<br>
         <input type="button" id="crear"  value="Crear Pregunta" disabled> 
		 <input type="button" id="ver" value="Ver Preguntas">
		
		<br><br>
		<div id="tabla">
			
		
		
		
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
		num_preguntas("preguntas.xml");
		setInterval(function(){num_preguntas("preguntas.xml");}, 2000);

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
				$("#crear").prop("disabled", false);
			}
			else {
				$("#crear").prop("disabled", true);
				}

			});	


			
				
				
				document.getElementById("ver").onclick = function() {visualizar("preguntas.xml")};	
				
				//funcion tabla
				function visualizar(url){
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							txt="<table border='1'><tr><th>Numero</th><th>Autor</th><th>Pregunta</th><th>Respuesta correcta</th></tr>";
							x=xhttp.responseXML.documentElement.getElementsByTagName("assessmentItem");
							var aut=document.getElementById("mail").value;
							var numero =1;
							for (i=0;i<x.length;i++)
							{
								//comprobar email autor
								var autor=x[i].getAttribute("author");								
								if (autor==aut){
									txt=txt + "<tr><td>"+numero+"</td>";									
									xx=x[i].getAttribute("author");
									{
										try
										{
											txt=txt + "<td>" + xx + "</td>";
										}
										catch (er)
										{
											txt=txt + "<td>&nbsp;</td>";
										}
									}
									
									xx=x[i].getElementsByTagName("p");
									{
										try
										{
										txt=txt + "<td>" + xx[0].firstChild.nodeValue + "</td>";
										}
										catch (er)
										{
										txt=txt + "<td>&nbsp;</td>";
										}
									}
									
									xx=x[i].getElementsByTagName("value");
									{
										try
										{
											txt=txt + "<td>" + xx[0].firstChild.nodeValue + "</td>";
										}
										catch (er)
										{
											txt=txt + "<td>&nbsp;</td>";
										}
									}
									txt=txt + "</tr>";
									numero=numero+1;
								}
							}
							txt=txt + "</table>";
							document.getElementById('tabla').innerHTML=txt;
						}
					}
					xhttp.open("GET",url,true);
					xhttp.send();
				};
				
				
				
			$("#crear").click(function() {				
				$.ajax({
					
					type:"POST",
					url: "insertarPreguntalab5.php",
					data: $("#fpreguntas").serialize(),
					dataType: "text",
					cache:false,
					success: function(mensaje){
						document.getElementById("fpreguntas").reset();
						$('#crear').attr("disabled", true);
						visualizar("preguntas.xml");
						setInterval(function(){visualizar("preguntas.xml");}, 2000);
					}				
				})	
			})	
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


		
		
		
		function num_preguntas(url){
			var parcial=0;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					x=xhttp.responseXML.documentElement.getElementsByTagName("assessmentItem");
					var aut2=document.getElementById("mail").value;
					var total=x.length;
					for (i=0;i<x.length;i++)
					{
						var autor2=x[i].getAttribute("author");
						if (autor2==aut2){
							parcial=parcial+1;
						}		
					}
					texto="Mis preguntas/Todas las preguntas: "+parcial+"/"+total;
					document.getElementById("numeropreguntas").innerHTML=texto;
				}
			}
			xhttp.open("GET",url,true);
			xhttp.send();	
		};
		
		
		
	</script>
</body>
</html>