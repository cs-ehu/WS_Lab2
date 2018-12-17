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



//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soapclient.
$soapclient1 = new nusoap_client('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl ',true);
//Llamamos la función que habíamos implementado en el Web Service e imprimimos lo que nos devuelve
$result1 = $soapclient1->call('comprobar', array('x'=> $email) );


/*Para crear el wsdl
$soapclient2 = new nusoap_client('ComprobarContra.php');
$result2 = $soapclient2->call('comprobar' );
*/
$soapclient2 = new nusoap_client('http://s546876151.mialojamiento.es/sw/ComprobarContra.php?wsdl ',true);
$result2 = $soapclient2->call('comprobar', array('categoria' => $password, 'ticket' => '1010') );
//$result2 = $soapclient2->call('comprobar', array('categoria' => $password) );
//echo 'resultado es '.$result2;

if($result2 == 'VALIDA' && $result1 == 'SI'){
	session_start();
	$_SESSION['email']= $email;
    $_SESSION['nombre']= $nombre;
	$_SESSION['foto']= $foto;
    $_SESSION['rol']= 'alumno';
    $passHash = password_hash($password , PASSWORD_DEFAULT);
    $sqlComp="SELECT * FROM usuarios WHERE email = '$email' ";
    $resComp =mysqli_query($mysqli, $sqlComp);
    if(mysqli_num_rows($resComp) >= 1){
		header('Location:Registrar.php?errorRegistro=1');
		exit();
    }else{

    
	$sql ="INSERT INTO usuarios (email , nombre , password , foto, logueado, rol ) VALUES 
	('$email' , '$nombre','$passHash','$foto' , 1 , 'alumno')";
	if (!mysqli_query($mysqli ,$sql)){
		header('Location:Registrar.php');
		exit();	}
	header('Location:gestionarPreguntas.php?usuario='.$nombre."&email=".$email."&foto=".$foto."&contadorUsuarios=".$contadorUsuarios);
	exit();
	}	
} else{
	header('Location:Registrar.php?errorRegistro=1');
	exit();
}

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
