<?php

include("includes/conexiones.php");
$email= $_POST['email'];
$enunciado = $_POST['enunciado'];
$correcta = $_POST['correcta'];
$incorrecta1 = $_POST['incorrecta1'];
$incorrecta2 = $_POST['incorrecta2'];
$incorrecta3 = $_POST['incorrecta3'];
$complejidad = $_POST['complejidad'];
$tema = $_POST['tema'];
$sql ="INSERT INTO Preguntas (email , enunciado , correcta , incorrecta1, incorrecta2, incorrecta3, complejidad, tema) VALUES 
('$email' , '$enunciado','$correcta', '$incorrecta1', '$incorrecta2', '$incorrecta3', '$complejidad','$tema' )";

if (!mysqli_query($mysqli ,$sql)){
	echo "<p> <a href='pregunta.php'>Volver a intentarlo </a></p>";
	die('Error: '.mysqli_error($mysqli));



}
echo "1 record added";
echo "<p> <a href='VerPreguntas.php'> Ver preguntas</a></p>";

mysqli_close($mysqli);
?>
