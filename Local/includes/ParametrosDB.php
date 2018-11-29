<?php
	$local=1; //0 para la aplicación en 000WebHost
	if ($local==1){
		$server="localhost";
		$user="root";
		$pass="";
		$basededatos="quiz";
	}
	else{
		$server="localhost";
		$user="id7142744_admin";
		$pass="admin";
		$basededatos="id7142744_quiz";
	}
?>