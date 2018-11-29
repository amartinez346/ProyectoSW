<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

require_once('libreria/lib/nusoap.php');
require_once('libreria/lib/class.wsdlcache.php');

$soapclient = new nusoap_client( 'http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl',true);
$result = $soapclient->call('comprobar', array('x'=>$_GET['email']));
print_r($result);

?>