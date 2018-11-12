<?php
include("includes/conexiones.php");   
if(isset($_POST['email']) && isset($_POST['password'])){
$email= $_POST['email'];
$password = $_POST['password'];
$contadorUsuarios=0;
$sql ="SELECT * FROM usuarios WHERE email='$email' AND password= '$password' ";
$result = mysqli_query($mysqli ,$sql);
if (mysqli_num_rows($result) >0){
$contadorUsuarios= ($contadorUsuarios + 1);
$usuarioLogueado = mysqli_fetch_array($result);
$sqlLog="UPDATE usuarios SET logueado = 1 WHERE email='$email' AND password= '$password'";
mysqli_query($mysqli ,$sqlLog);
header('Location:gestionarPreguntas.php?usuario='.$usuarioLogueado['nombre']."&email=".$usuarioLogueado['email']."&foto=".$usuarioLogueado['foto']."&contadorUsuarios=".$contadorUsuarios);
exit();	
}else{
header('Location:Login.php?errorLogIn=errorLogIn&errorEmail='.$email);
exit();}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>LogIn</title>
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
<?php include('includes/headerNav.php');?>
<?php include('includes/formLogin.php');?>	
<?php mysqli_close($mysqli); ?>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>