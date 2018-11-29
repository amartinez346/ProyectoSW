<?php
require_once('libreria/lib/nusoap.php');
require_once('libreria/lib/class.wsdlcache.php');

$soapclient = new nusoap_client('http://sw325f.000webhostapp.com/Proyecto/libreria/lib/samples/servicioContrasena.php?wsdl',true);
$resultado = $soapclient->call('contrasena', array('x'=>$_GET['cont'],'y'=>$_GET['ticket']));
echo $resultado;
?>