<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

function comprobar($palabra, $ticket){  
	$lineas = file("toppasswords.txt");
	//$palabra="111567";
	if($ticket == '1010') {
		foreach($lineas as $linea){    
			if (strstr($linea,$palabra)){
			            $valida='INVALIDA';			
			}
		}
		if($valida!='INVALIDA')	$valida='VALIDA';
	} else $valida = 'SIN SERVICIO';	
	return $valida;
}      
$server = new soap_server();
$server->configureWSDL("contra", "urn:contra");
      
$server->register("comprobar",
    array("categoria" => "xsd:string", "ticket" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:contra",
    "urn:contra#comprobar",
    "rpc",
    "encoded",
    "Nos da  si la contra enviada existe");
$server->service($HTTP_RAW_POST_DATA);

?>