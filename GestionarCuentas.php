<?php
session_start();
include "includes/ParametrosDB.php";	
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
	if (isset($_SESSION['mail'])){
		$mail = $_SESSION['mail'];
		if($mail!="admin@ehu.es"){
			echo("<script>window.location = 'login.php';</script>");
		}	
	}else{
		 echo("<script>window.location = 'login.php';</script>");
	}
	
	
include "includes/menu_admin.php";		
			
	$consulta = "SELECT * FROM usuarios";
	
	$resultado = mysqli_query($con, $consulta); 
	if(!$resultado) 
		die("Error: no se pudo realizar la consulta");
	
	echo '<table border="1">';
	echo '<tr bgcolor="#848484">';
	echo '<th>Email</th>';
	echo '<th>Nombre</th>';
	echo '<th>Password</th>';
	echo '<th>Activar/Bloquear</th>';
	echo '<th>Eliminar</th>';
	echo '</tr>';
	while($linea = mysqli_fetch_assoc($resultado)) 
	{ 
		if($linea['email']!="admin@ehu.es"){
			$activo;
				if($linea['estado'] == 'activado'){
					$activo='Bloquear';
				}else{
					$activo='Activar';
				}
				echo '<tr bgcolor="#D8D8D8">'; 
				echo '<td>' . $linea['email'] . '</td><td>' . $linea['nombre'] . '</td><td>' . $linea['contrasena'] . '</td><td> <button type="submit" id="Boton" name="submit" onclick=funcion("Cambiar_estado.php?email='.$linea['email'].'&estado='.$activo.'")>'.$activo.' cuenta</button>  </td>   <td> <button type="submit" id="Boton2" name="Boton2" onclick=funcion_eliminar("'.$linea['email'].'","Eliminar_cuenta.php?email='.$linea['email'].'") >Eliminar cuenta</button>  </td>';
				echo '</tr>'; 
		}
		
	}
	echo '</table>';
	
	
	?>
	
	<script>
	function funcion(link){
		location.href = link;
	}
	function funcion_eliminar(email, link){
		var result = confirm("¿Quieres eliminar la cuenta: " + email + "?");
	if (result) {
    	location.href = link;
	}
		
	}
	
	
	</script>
	
	<?php




include "includes/footer.php";
?>