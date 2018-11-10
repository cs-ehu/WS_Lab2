<?php
include("includes/conexiones.php");
$email= $_POST['email'];
$enunciado = $_POST['enunciado'];
$usuario = $_POST['usuario'];
$fotoUsuario = $_POST['fotoUsuario'];
$correcta = $_POST['correcta'];
$incorrecta1 = $_POST['incorrecta1'];
$incorrecta2 = $_POST['incorrecta2'];
$incorrecta3 = $_POST['incorrecta3'];
$complejidad = (int) $_POST['complejidad'];
$contadorUsuarios = (int) $_POST['contadorUsuarios'];
$tema = $_POST['tema'];
if(preg_match("/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/", $email) && (0<$complejidad) && ($complejidad<6) && $enunciado != ""  && $correcta != "" && $incorrecta1 != "" && $incorrecta2 != ""  && $incorrecta3 != ""  && $tema != ""){
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
$sql ="INSERT INTO preguntas (email , enunciado , correcta , incorrecta1, incorrecta2, incorrecta3, complejidad, tema, img) VALUES 
('$email' , '$enunciado','$correcta', '$incorrecta1', '$incorrecta2', '$incorrecta3', '$complejidad','$tema','$foto' )";

if (!mysqli_query($mysqli ,$sql)){
	echo "<p> <a href='pregunta.php'>Volver a intentarlo </a></p>";
	die('Error: '.mysqli_error($mysqli));
}
echo "1 record added";
echo "<p> <a href='VerPreguntasConFoto.php?usuario=".$usuario."&foto=".$fotoUsuario."&email=".$email."&contadorUsuarios=".$contadorUsuarios."'> Ver preguntas</a></p>";

}else{
	echo "No se ha podido insertar la nueva pregunta.";
	echo "<p> <a href='VerPreguntasConFoto.php?usuario=".$usuario."&foto=".$fotoUsuario."&email=".$email."&contadorUsuarios=".$contadorUsuarios."'> Ver preguntas</a></p>";
} 
mysqli_close($mysqli);


//XML

$xml = simplexml_load_file('preguntas.xml');
$assessmentItem = $xml->addChild('assessmentItem');
$assessmentItem->addAttribute('subject',$_POST['tema']);
$assessmentItem->addAttribute('author',$_POST['email']);
$itemBody = $assessmentItem->addChild('itemBody');
$itemBody->addChild('p',$_POST['enunciado']);

$correctResponse = $assessmentItem->addChild('correctResponse');
$value = $correctResponse->addChild('value',$_POST['correcta']);

$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
$incorrectResponses->addChild('value', $_POST['incorrecta1']);
$incorrectResponses->addChild('value', $_POST['incorrecta2']);
$incorrectResponses->addChild('value', $_POST['incorrecta3']);


//echo $xml->asXML();
$xml->asXML('preguntas2.xml');

if($xml === false) echo "Ha habido alg&uacute;n error en el documento xml";
else echo "<p> <a href='preguntas2.xml?usuario=".$usuario."&foto=".$fotoUsuario."&email=".$email."'>Ver preguntas XML</a></p>";
?>
