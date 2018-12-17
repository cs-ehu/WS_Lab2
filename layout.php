<?php
session_start(); 
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
<script type="text/javascript">
function jugar(){
		   document.getElementById("imagenInicio").style.display ='none';
		   document.getElementById("jugarPorTemasIni").style.display ='none';
		   document.getElementById("registrarNick").style.display ='none';
           document.getElementById("juegoAleatorio").style.display ='block';
		   document.getElementById("juegoAleatorio").innerHTML="";
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else {  // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		      var respuesta = this.responseText;
		      /*if(respuesta.includes("Has realizado todas las preguntas")){

		      document.getElementById("juegoAleatorio").innerHTML=this.responseText + "<form action='layout.php' method='POST' ><input type='submit'  value='Finalizar este juego' name='todasRespondidas' id='todasRespondidas'/></form>";
		      }else{*/
		      document.getElementById("juegoAleatorio").innerHTML=this.responseText;
		      
		  		//}
		    }
		  }
		 var comienzo = document.getElementById('comienzo').value;
		 xmlhttp.open("GET",  "juegoAleatorio.php?comienzo="+comienzo,true );
		 xmlhttp.send();
		
}
function jugarPorTemas(){		   
	window.location="layoutPorTemas.php";
}
function registrarNick(){		   
	window.location="registrarNick.php";
}

</script>
  </head>
  <body>
  	<?php 
if(isset($_POST['finalizar']) || isset($_POST['todasRespondidas'])){
	$_SESSION= array();
}

  	?>
  <div id='page-wrap'>
	
	<?php include('includes/headerNav.php')?>
	<?php include('includes/conexiones.php')?>
    <section class="main" id="s1">
    
	<div id="imagenInicio" onclick="jugar()" <?php if(isset($_GET['nuevaPregunta'])) echo 'style="display: none;width: 45%; float: left;"'; else echo 'style="display: block;width: 45%; float: left;"'?> >		
	<h1 style="position: absolute; margin-left: 120px;">Juego aleatorio!</h1>
	<img src="img/quiz.jpg" alt="" width="auto" height="280"/>
	</div>
	<div id="juegoAleatorio" <?php 
	if(isset($_GET['nuevaPregunta'])) {
		echo 'style="display: block;"'; 
	}
	else echo 'style="display: none;"'?>  >
	<?php
	if(isset($_GET['nuevaPregunta'])) {
		echo '<h4>'.$_GET['comprobarCorrecta'].'</h4>';
		if($_GET['comprobarCorrecta'] == 'correcta'){
			$acierto=1;
			$fallo=0;
		}else{
			$acierto=0;
			$fallo=1;
		}
		if($_GET['meGusta'] == 1) 
		echo "<p>Te ha gustado la pregunta</p>";
		if($_GET['meGusta'] == 2) 
		echo "<p>No te ha gustado la pregunta o no la has valorado</p>";		
	if($_SESSION['nick'] && $_SESSION['nick'] != 'sinNick'){
			$nickComp = $_SESSION['nick'];
			$sql1="SELECT * FROM nickUsuarios WHERE nombre = '$nickComp'";
			$result1 = mysqli_query($mysqli, $sql1);
			if(mysqli_num_rows($result1) > 0){
				while($row= mysqli_fetch_array($result1)){
				$aciertosHistorico = $row['aciertos'];
				$fallosHistorico = $row['fallos'];
				$totalAciertos = $aciertosHistorico + $acierto;
				$totalFallos = $fallosHistorico + $fallo;
				//echo 'columpoio '.$nickComp.' a h '.$aciertosHistorico.' f  h '.$fallosHistorico.' t a '.$totalAciertos.' t f '.$totalFallos;
				$sql2="UPDATE nickUsuarios SET aciertos = '$totalAciertos', fallos = '$totalFallos'  WHERE nombre = '$nickComp' ";
				mysqli_query($mysqli, $sql2);
			}
		}
		}
	}
	?> 
		<h4>Prueba de nuevo<?php if($_SESSION['nick'])echo ', '.$_SESSION['nick'];?>. Suerte!</h4>
		<img src="img/quiz.jpg" alt="" width="auto" height="280" onclick='jugar()'/>

		<form method="post" id='formFinalizar' action="layout.php">
			<input type="submit" name="finalizar" id="finalizar" value="Finalizar este juego">
		</form>	
	</div>
	<div id="jugarPorTemasIni" onclick="jugarPorTemas()" <?php 
	if(isset($_GET['nuevaPregunta'])) {
		echo 'style="display: none;width: 45%; float: right;"'; 
	}
	else echo 'style="display: block;width: 45%; float: right;"'?>  >
	<h1 style="position: absolute; margin-left: 120px;">Jugar por temas!</h1>
	<img src="img/quiz.jpg" alt="" width="auto" height="280"/>
	</div>
	<div id="registrarNick" onclick="registrarNick()" <?php 
	if(isset($_GET['nuevaPregunta'])) {
		echo 'style="display: none;width: 45%; float: right;"'; 
	}
	else echo 'style="display: block;width: 45%; margin-left:auto; margin-right: auto;"'?>  >
	<h1>Registrar Nick!</h1>
	<img src="img/user.png" alt="" width="auto" height="280"/>
	<?php 

	$sql3="SELECT * FROM nickUsuarios ORDER BY (aciertos - fallos) DESC LIMIT 10";
	$result = mysqli_query($mysqli, $sql3);
	
	if(mysqli_num_rows($result) > 0){
		echo '<p>Top ten quizers</p>';
		while($row = mysqli_fetch_array($result)){
			echo '<p>'.$row['nombre']." con un total de ".$row['aciertos'].' aciertos y '.$row['fallos'].' fallos</p>';
		}
	} 
	?>
	</div>
    </section>
    <input type="hidden" name="comienzo" id="comienzo" value="<?php if(!$_SESSION['preguntada']) echo 'no'; else echo 'si'; ?>">
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
