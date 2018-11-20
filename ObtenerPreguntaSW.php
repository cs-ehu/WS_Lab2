<?php
include("includes/conexiones.php");

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

function obtener($pregunta){  
	$idPregunta = (int) $pregunta;
	$mysqli = mysqli_connect("db714056396.db.1and1.com", "dbo714056396", "LOSfablos1967_", "db714056396");
	if (!$mysqli) {
	    die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
	}
	$sql ="SELECT * FROM preguntas WHERE id = '$idPregunta'";

	$resultado = mysqli_query($mysqli, $sql);
	if(mysqli_num_rows($resultado) >0){
		while($row = mysqli_fetch_array($resultado)){
			$autor= $row['email'];
			$enunciado= $row['enunciado'];
			$correcta= $row['correcta'];
			$haywhile= 'estamos en el while';
		}
		return 'autor-'.$autor.'enunciado-'.$enunciado.'correcta-'.$correcta;
	}else{
		$autor= '';
		$enunciado='';
		$correcta= '';
		return $autor.'enunciado-'.$enunciado.'correcta-'.$correcta;
	}
}      
$server = new soap_server();
$server->configureWSDL("pregunta", "urn:pregunta");
      
$server->register("obtener",
    array("pregunta" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:pregunta",
    "urn:pregunta#obtener",
    "rpc",
    "encoded",
    "Nos da la pregunta si existe");
$server->service($HTTP_RAW_POST_DATA);

?>