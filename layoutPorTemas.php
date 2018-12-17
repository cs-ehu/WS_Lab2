<?php
session_start(); 
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
</head>
<body>
<div id='page-wrap'>
	<?php include('includes/headerNav.php')?>
   <?php include('includes/conexiones.php')?>

    <section class="main" >
    	<?php 
    	if(!isset($_POST['temaSelect']) && !isset($_POST['comprobarTemas'])){
    	?>
    	<div>
    		<form class="formPregunta" method="POST" action="layoutPorTemas.php">	<label>Selecciona tu nick si ya te has registrado</label>

    			<select name="nick" style="width: 250px;height: 20px;border-radius: 12px;"><option value='sinNick'>Jugar sin nick</option>
    				<?php 
    				$sql="SELECT  * FROM nickUsuarios";
    				$resultado = mysqli_query($mysqli, $sql);
    				if(mysqli_num_rows($resultado) > 0){
    					while($row = mysqli_fetch_array($resultado)){
    						echo "<option value='".$row['nombre']."fotoNick".$row['foto']."'>".$row['nombre']."</option>";
    					}
    				}

    				?>
    			</select>
    			<br/><br/>
    			<label >Selecciona el tema de la pregunta</label>
    			<select name="temaSelect" style="width: 250px;height: 20px;border-radius: 12px;">
    				<?php 
    				$sql="SELECT DISTINCT tema FROM preguntas";
    				$resultado = mysqli_query($mysqli, $sql);
    				if(mysqli_num_rows($resultado) > 0){
    					while($row = mysqli_fetch_array($resultado)){
    						echo "<option>".$row['tema']."</option>";
    					}
    				}

    				?>
    			</select>
    			<input type="submit" name="tema" value="Preg&uacute;ntame de este tema!" id="porTemas" />
    		</form>
    	</div>
    <?php }else if(!isset($_POST['comprobarTemas'])){

    	if(isset($_POST['nick']) && $_POST['nick'] != 'sinNick'){
    		$recogeNick =$_POST['nick'];
    		$nickFoto =explode('fotoNick',$recogeNick);
    		$nick= $nickFoto[0];
    		$foto=$nickFoto[1];
    		$_SESSION['nick']=$nick;
    		$_SESSION['fotoNick']=$foto;
    		echo '<img src="img/'.$foto.'" width="40" /><p>Est&aacute; jugando '.$_SESSION['nick']."</p>";
    	}
    	?>
    	<div style="height: auto;">
    		<?php 
    		$tema = $_POST['temaSelect'];
    		$sql="SELECT * FROM preguntas WHERE tema = '$tema' ";
    		$resultado = mysqli_query($mysqli, $sql);
    		if(mysqli_num_rows($resultado)>0){
    			echo "<form  method='POST' action='layoutPorTemas' style='text-align:left;'>";
    			$i=0;
    			while($row = mysqli_fetch_array($resultado)){
    			  if($i < 3){
    				$i++;
    				echo "<p>".$i."-".$row['enunciado']."</p>";
    				echo "<label>".$row['correcta']."</label><input type='checkbox' name='elijo".$i."' value='".$row['correcta']."'  style='width: 20px;' /><br/>";
    				echo "<label>".$row['incorrecta1']."</label><input type='checkbox' name='elijo".$i."' value='".$row['incorrecta1']."'   style='width: 20px;'/><br/>";
    				echo "<label>".$row['incorrecta2']."</label><input type='checkbox' name='elijo".$i."' value='".$row['incorrecta2']."'   style='width: 20px;'/><br/>";
    				echo "<label>".$row['incorrecta3']."</label><input type='checkbox' name='elijo".$i."' value='".$row['incorrecta3']."'  style='width: 20px;' /><br/><br/>";
    				echo "<input type='hidden' name='preguntaId".$i."' value='".$row['id']."' /><input type='hidden' name='complejidad".$i."' value='".$row['complejidad']."' /><input type='hidden' name='correcta".$i."' value='".$row['correcta']."' />";
    				}
    			}
    			echo "<input type='submit' name='comprobarTemas' value='Comprobar' id='comprobarTemas' /></form>";
    		}
    		?>
    	</div>
    <?php }else{
	?>
	<div>
		<h1>Buen trabajo!</h1>
		<?php 
		if(isset($_POST['comprobarTemas'])){
			$preguntasRespondidas=0;
			$acierto=0;
			$fallo=0;
			if($_POST['preguntaId1']){
			$preguntasRespondidas++;
			$id = $_POST['preguntaId1'];
			$correcta = $_POST['correcta1'];
			$elijo = $_POST['elijo1'];
			if($correcta == $elijo) $acierto++;
			else $fallo++;
			$complejidad= (int) $_POST['complejidad1'];
			//echo ' id '.$id.' correcta '.$correcta.' elijo '.$elijo.'complejidad '.$complejidad.'<br>';
			}
			if($_POST['preguntaId2']){
			$preguntasRespondidas++;
			$id2 = $_POST['preguntaId2'];
			$correcta2 = $_POST['correcta2'];
			$elijo2 = $_POST['elijo2'];
			if($correcta2 == $elijo2) $acierto++;
			else $fallo++;
			$complejidad2 =(int) $_POST['complejidad2'];
			//echo ' id '.$id2.' correcta '.$correcta2.' elijo '.$elijo2.'complejidad '.$complejidad2.'<br>';
			}
			if($_POST['preguntaId3']){
			$preguntasRespondidas++;
			$id3 = $_POST['preguntaId3'];
			$correcta3 = $_POST['correcta3'];
			$elijo3 = $_POST['elijo3'];
			if($correcta3 == $elijo3) $acierto++;
			else $fallo++;
			$complejidad3= (int) $_POST['complejidad3'];
			//echo ' id '.$id3.' correcta '.$correcta3.' elijo '.$elijo3.'complejidad '.$complejidad3.'<br>';
			}
			$complejidadTotal= ($complejidad + $complejidad2 + $complejidad3);
		    $complejidadMedia = $complejidadTotal/$preguntasRespondidas;
			echo 'Preguntas respondidas: '.$preguntasRespondidas.'<br/>Complejidad media: '.$complejidadMedia.'<br/>Fallos: '.$fallo.'<br/>Aciertos: '.$acierto ;
			$nickComp=$_SESSION['nick'];
			$sql1="SELECT * FROM nickUsuarios WHERE nombre = '$nickComp'";
			$result1 = mysqli_query($mysqli, $sql1);
			
			if(mysqli_num_rows($result1) > 0){
				while($row= mysqli_fetch_array($result1)){
				$aciertosHistorico = $row['aciertos'];
				$fallosHistorico = $row['fallos'];
				$totalAciertos = $aciertosHistorico + $acierto;
				$totalFallos = $fallosHistorico + $fallo;
				//echo 'aciertosHistorico '.$aciertosHistorico.'<br> fallosHistorico'.$fallosHistorico.'<br> totalFallos '.$totalFallos.'<br> totalAciertos '.$totalAciertos.' fallos '.$fallo.'aciertos '.$acierto;
				$sql2="UPDATE nickUsuarios SET aciertos = '$totalAciertos', fallos = '$totalFallos'  WHERE nombre = '$nickComp' ";
				mysqli_query($mysqli, $sql2);
			}
			}
			
		}
		?>
	</div>
<?php }?>

    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>

</body>
</html>