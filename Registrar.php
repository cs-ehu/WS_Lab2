<?php
include("includes/conexiones.php");   
if(isset($_POST['email'])){
$email= $_POST['email'];
$nombre = $_POST['nombre'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$contadorUsuarios =(int) $_POST['contadorUsuarios'];
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
} else{if($foto=="")$foto="quiz.jpg";}
$sql ="INSERT INTO usuarios (email , nombre , password , foto, logueado ) VALUES 
('$email' , '$nombre','$password','$foto' , 1 )";
if (!mysqli_query($mysqli ,$sql)){
	header('Location:Registrar.php');
	exit();	}
header('Location:gestionarPreguntas.php?usuario='.$nombre."&email=".$email."&foto=".$foto."&contadorUsuarios=".$contadorUsuarios);
exit();	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Registro</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		    <script src="js/jquery.min.js"></script>
		     <script src="js/pregunta.js"></script>
		     <script src="js/cargaImg.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
<?php include('includes/headerNav.php');
include('includes/formRegistrar.php')
?>	
<?php mysqli_close($mysqli); ?>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
