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
    <?php
    include("includes/conexiones.php");   
    if(isset($_POST['email'])){
	$email= $_POST['email'];
	$nombre = $_POST['nombre'];
	$password = $_POST['password'];
	//if(preg_match("/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/", $email) && (0>$password) && ($complejidad<9) && $nombre != ""  && $password == $password2){
			$sql ="SELECT * FROM usuarios WHERE email='$email' AND password= '$password' ";
			$result = mysqli_query($mysqli ,$sql);
			if (mysqli_num_rows($result) >0){
			$usuarioLogueado = mysqli_fetch_array($result);
			header('Location:pregunta.php?usuario='.$usuarioLogueado['nombre']."&email=".$usuarioLogueado['email']."&foto=".$usuarioLogueado['foto']);			
		}else{
			$error=true;
			header('Location:Login.php?errorLogIn='.$error."&errorEmail=".$email);
		}

			}
   // }
?>
<?php include('includes/headerNav.php');?>
<?php include('includes/formLogin.php');?>	
<?php mysqli_close($mysqli); ?>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
