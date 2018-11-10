<?php
include("includes/conexiones.php");
$emailGet = $_GET['email'];
$preguntas = simplexml_load_file('preguntas2.xml');
$contadorTodas=0;
$contadorSuyas=0;
foreach ($preguntas->xpath('//assessmentItem') as $pregunta){
	$contadorTodas = $contadorTodas + 1;
	$autor = $pregunta->attributes()->author;
	if($emailGet && $autor == $emailGet ){
		$contadorSuyas = $contadorSuyas + 1;

	}
}
echo $contadorSuyas."/".$contadorTodas;

?>