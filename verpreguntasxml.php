<?php
session_start(); 
if (isset($_SESSION['mail'])){
	$mail = $_SESSION['mail'];
	if($mail=="admin@ehu.es"){
		echo("<script>window.location = 'login.php';</script>");
	}	
}else{
	 echo("<script>window.location = 'login.php';</script>");
}
include "includes/ParametrosDB.php";
include "includes/menu.php";

$xml=simplexml_load_file("preguntas.xml") or die("Error al abrir el xml");
?>
<table border="2">
<thead>
<tr><th>Número</th><th>Autor</th><th>Pregunta</th><th>Respuesta correcta</th></tr>
</thead>
<?php
	$num=1;
	foreach($xml->children() as $assessmentItem){
?>
<tr>
<td> <?php echo $num; ?></td> 
<td> <?php echo $assessmentItem['author']; ?> </td> 
<td> <?php echo $assessmentItem->itemBody->p; ?> </td> 
<td> <?php echo $assessmentItem->correctResponse->value; ?> </td> </tr>
<?php
$num= $num+1;
};
?>
</table>
<?php
include "includes/footer.php";
?>	