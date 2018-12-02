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
		     	function cambiarPass(){
		     		var pass1 = document.fcambiar.password.value;
		     		var pass2 = document.fcambiar.password2.value;
		     		if(pass1 == '' || pass2 == ''){
		     			alert('Por favor, rellene todos los campos');
		     		}else if(pass1 != pass2){
		     			alert('Los password tienen que ser iguales');
		     		}else{
		     			document.fcambiar.submit();
		     		}
		     	}
		     </script>
</head>
  <body>
  <div id='page-wrap'>
<?php include('includes/headerNav.php');?>
<section class="main">
	<?php
	if(!isset($_POST['email'])){
		if(isset($_GET['fecha']) && isset($_GET['hora'])){
		date_default_timezone_set("Europe/Madrid");
		$fechaActual =  date("Y/m/d");
		$horaActual = date("h:i:sa");
		$horaMasCinco =date('h:i:sa',strtotime('+4 hour ',strtotime($_GET['hora'])));
		if($fechaActual == $_GET['fecha'] && $horaActual >= $horaMasCinco){
	?>
	<div>
		<form  action="nuevoPass.php" name="fcambiar" method="POST" class="formPregunta">
		<fieldset>
   		  <br/>
		  <label for="email">Email:*</label>
		  <input type="text" name="email" id="email"  value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>" class="inputAncho"  class="inputAncho"  />
		  <br/><br/>
		  <label for="password">Password:*</label>
		   <input type="password" name="password"  id="password" value="" class="inputAncho"   />
		  <br/><br/>
		  <label for="password">Repita el Password:*</label>
		   <input type="password" name="password2"  id="password2" value="" class="inputAncho"   />
		  <br/><br/>
		  <br/>
		  <input type="button" value="Cambiar Password" id="enviarNuevoPass" onclick="cambiarPass()" />
		</fieldset>
		</form>
	</div>
	<?php
		}else{
			echo '<h4>Lo sentimos pero ha caducado esta posibilidad para cambiar su password. Solic&iacute;telo de nuevo si lo desea.</h4>';
		}
		}
	}else{
		include('includes/conexiones.php');
		$pass = $_POST['password'];
		$email = $_POST['email']; 
		$passHash = password_hash($pass , PASSWORD_DEFAULT);
		$sql="UPDATE usuarios SET password = '$passHash' WHERE email = '$email' ";
		mysqli_query($mysqli, $sql);
		mysql_close();
	?>
	<div><h4><a href="Login.php" >Ha cambiado correctamente su password. Puede entrar en la aplicaci&oacute;n.</a></h4></div>
	<?php
	}
	?>
    </section>
<?php mysqli_close($mysqli); ?>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>