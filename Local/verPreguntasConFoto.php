<?php
	if(!($con = mysqli_connect("localhost", "root", "", "Quiz")))		
			die("Error: No se pudo conectar");		

	include "includes/menu.php";	

	
			
	$consulta = "SELECT * FROM preguntas";
	
	$resultado = mysqli_query($con, $consulta); 
	if(!$resultado) 
		die("Error: no se pudo realizar la consulta");
	
	echo '<table border="1">';
	echo '<tr bgcolor="#848484">';
	echo '<th>Autor</th>';
	echo '<th>Enunciado</th>';
	echo '<th>Respuesta correcta</th>';
	echo '<th>Imagen</th>';
	echo '</tr>';
	while($linea = mysqli_fetch_assoc($resultado)) 
	{ 
		echo '<tr bgcolor="#D8D8D8">'; 
		echo '<td>' . $linea['email'] . '</td><td>' . $linea['pregunta'] . '</td><td>' . $linea['correcta'] . '</td><td> <img  width="100" height="100" src= "' . $linea['imagen'] . '"/></td>';
		
		
		echo '</tr>'; 
	}
	echo '</table>';
	include "includes/footer.php";	
	mysqli_close($con);

?>	