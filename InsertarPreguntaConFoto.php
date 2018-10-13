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

if($foto=$_FILES["imgAdd"]["name"]){
$foto=$_FILES["imgAdd"]["name"];
$fototemp=$_FILES["imgAdd"]["tmp_name"];
 ini_set('post_max_size','100M');
 ini_set('upload_max_filesize','100M');
 ini_set('max_execution_time','1000');
 ini_set('max_input_time','1000');
list($ancho,$alto)=getimagesize($fototemp);
$nuevaimg=imagecreatetruecolor(200,180);
$idnuevaimg=imagecreatefromjpeg($fototemp);
imagecopyresized($nuevaimg,$idnuevaimg,0,0,0,0,200,180,$ancho,$alto);
imagejpeg($nuevaimg,"img/".$foto);
} else{
if($foto=="")$foto="quiz.jpg";
}
$sql ="INSERT INTO Preguntas (email , enunciado , correcta , incorrecta1, incorrecta2, incorrecta3, complejidad, tema, img) VALUES 
('$email' , '$enunciado','$correcta', '$incorrecta1', '$incorrecta2', '$incorrecta3', '$complejidad','$tema','$foto' )";

if (!mysqli_query($mysqli ,$sql)){
	echo "<p> <a href='pregunta.html'>Volver a intentarlo </a></p>";
	die('Error: '.mysqli_error($mysqli));



}
echo "1 record added";
echo "<p> <a href='VerPreguntasConFoto.php'> Ver preguntas</a></p>";

mysqli_close($mysqli);
?>
