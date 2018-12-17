<?php
include("includes/conexiones.php");   
if(isset($_POST['email']) && isset($_POST['password'])){
$email= $_POST['email'];
$password = $_POST['password'];
$passHash = $password;//password_hash($password , PASSWORD_DEFAULT);
$contadorUsuarios=0;
//$sql ="SELECT * FROM usuarios WHERE email='$email' AND password= '$password' ";
$sql ="SELECT * FROM usuarios WHERE email='$email'  ";
$result = mysqli_query($mysqli ,$sql);
if (mysqli_num_rows($result) >0){
$usuarioLogueado = mysqli_fetch_array($result);
$passwordDB = $usuarioLogueado['password'];
if($usuarioLogueado['rol'] == 'alumno'){
	if(password_verify($passHash, $passwordDB)){
		session_start();
		$contadorUsuarios= ($contadorUsuarios + 1);
		$sqlLog="UPDATE usuarios SET logueado = 1 WHERE email='$email' ";
		mysqli_query($mysqli ,$sqlLog);
		$_SESSION['email']= $email;
		$_SESSION['rol']= $usuarioLogueado['rol'];
		header('Location:gestionarPreguntas.php?usuario='.$usuarioLogueado['nombre']."&email=".$usuarioLogueado['email']."&foto=".$usuarioLogueado['foto']."&contadorUsuarios=".$contadorUsuarios);
		exit();	
	}	
}else if($usuarioLogueado['rol'] == 'admin'){
	if($usuarioLogueado['password'] == $password){
		session_start();
		$contadorUsuarios= ($contadorUsuarios + 1);
		//$sqlLog="UPDATE usuarios SET logueado = 1 WHERE email='$email' and password= '$password'";
		//mysqli_query($mysqli ,$sqlLog);
		$_SESSION['email']= $email;
		$_SESSION['rol']= $usuarioLogueado['rol'];
		header('Location:GestionarCuentas.php?usuario='.$usuarioLogueado['nombre']."&email=".$usuarioLogueado['email']."&foto=".$usuarioLogueado['foto']."&contadorUsuarios=".$contadorUsuarios);
		exit();	
	}
}
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
		     <script type="text/javascript">
		     $(document).ready(function(){
		     	//if
		     	$('#recuperar').click(function(){
		     		var email = $('#recuperarPass').val();
		     		if(email != '')
		            $('#formRecuperar').submit();
		     		//alert('hola'+ email );
		     	});
		     });

		     
		     </script>
  </head>
  <body>
  	<div id="fb-root"></div>
<script>
 (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2&appId=1654290134819043';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
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