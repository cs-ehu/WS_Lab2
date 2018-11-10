<?php
include("includes/conexiones.php");
$email= $_POST['email'];
$emailGet = $_GET['email'];
$preguntas = simplexml_load_file('preguntas2.xml');
echo "<h5>Estas son las preguntas que has hecho, ";
if($email )
	echo $email;
else if($emailGet)
	echo $emailGet;

echo "</h5><table border='1' style='height: 100%; width: 100%;'><tr><th>Pregunta</th><th>Respuesta correcta</th><th>Respuestas incorrectas</th></tr>";
foreach ($preguntas->xpath('//assessmentItem') as $pregunta){
	$autor = $pregunta->attributes()->author;
	if(($email && $autor == $email )|| ($emailGet && $autor == $emailGet) ){
		echo "<tr>";
		echo "<td>".$pregunta->itemBody->p."</td>";
		echo "<td>".$pregunta->correctResponse->value."</td>";
		echo "<td>";
	foreach ($pregunta->incorrectResponses->children() as $incorrecta){			echo $incorrecta."<br/>";
		}
		echo "</td>";
	}
}
echo "</table>";

?>