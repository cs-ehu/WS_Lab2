<?
session_start();
include('includes/conexiones.php');
//Destruimos las variables que guardan las preguntas que ya se han hecho en la sesión
if(isset($_GET['comienzo']) && $_GET['comienzo'] =='no') $_SESSION= array();
$condiciones = " ";
$a=0;
foreach($_SESSION['preguntada'] as $key => $value)
{
//echo 'key '.$key . ' = ' . ' value '. $value.'<br>';
	$a++;
	if($a == 1)
		$condiciones = $condiciones." WHERE NOT id=".$value." ";
	else
     $condiciones = $condiciones." AND NOT id=".$value." ";
}

$sql="SELECT * FROM preguntas   ".$condiciones."";
$result =mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)>0){
$numResults = mysqli_num_rows($result);
$i=0;
$random = rand(1, $numResults);
$preguntada= array();
$seRepite = "NO";
if(!$_SESSION['preguntada'])$_SESSION['preguntada'] = array();
//else echo "Estamos en sesion ".$_SESSION['preguntada'].'<br>';
while ($row = mysqli_fetch_array($result)) {
	$i= $i+1;
	if($i==$random){
		$preguntada= $row['enunciado'];
		$_SESSION[$row['id']]= $preguntada;
		array_push($_SESSION['preguntada'], $row['id']);
		if(isset( $_POST['comprobarId'])){
			if(isset($_POST['nick']) && $_POST['nick'] != 'sinNick'){
				$recogeNick =$_POST['nick'];
	    		$nickFoto =explode('fotoNick',$recogeNick);
	    		$nick= $nickFoto[0];
	    		$foto=$nickFoto[1];
	    		$_SESSION['nick']=$nick;
	    		$_SESSION['fotoNick']=$foto;
				}
			if($_POST['comprobarCorrecta'] == $_POST['elijo']){
				if($_POST['like'])
				echo '<script>window.location="layout.php?nuevaPregunta=1&comprobarCorrecta=correcta&meGusta=1";</script>';
				else
				echo '<script>window.location="layout.php?nuevaPregunta=1&comprobarCorrecta=correcta&meGusta=2";</script>';

			}else{
				if($_POST['like'])
				echo '<script>window.location="layout.php?nuevaPregunta=1&comprobarCorrecta=incorrecta&meGusta=1";</script>';
				else
				echo '<script>window.location="layout.php?nuevaPregunta=1&comprobarCorrecta=incorrecta&meGusta=2";</script>';
			}
		
		}else{
		echo "<form style='text-align:left;' method='POST' action='juegoAleatorio'><input type='hidden' value='".$row['id']."' name='comprobarId'/><input type='hidden' value='".$row['correcta']."' name='comprobarCorrecta'/><img src='img/".$row['img']."' width='50' height='auto' style='float:left;' /><p>Pregunta: ".$row['enunciado']."</p><br/><br/>";		
		echo "<label>A- ".$row['incorrecta1'].'</label><input type="checkbox" name="elijo" value="'.$row['incorrecta1'].'" style="width: 20px;"/> <br/><br/>';
		echo "<label>B- ".$row['incorrecta2'].'</label><input type="checkbox" name="elijo" value="'.$row['incorrecta2'].'" style="width: 20px;"/> <br/><br/>';		
		echo "<label>C- ".$row['correcta'].'</label><input type="checkbox" name="elijo" value="'.$row['correcta'].'" style="width: 20px;"/> <br/><br/>';	
		
		echo "<label>D- ".$row['incorrecta3'].'</label><input type="checkbox" name="elijo" value="'.$row['incorrecta3'].'" style="width: 20px;"/> <br/><br/>';
		if(isset($_GET['comienzo']) && $_GET['comienzo'] =='no'){
			echo '<label>Selecciona tu nick si ya te has registrado</label><select name="nick" style="width: 250px;height: 20px;border-radius: 12px;"><option value="sinNick">Jugar sin nick</option>';
			$sql="SELECT  * FROM nickUsuarios";
    				$resultado = mysqli_query($mysqli, $sql);
    				if(mysqli_num_rows($resultado) > 0){
    					while($row = mysqli_fetch_array($resultado)){
    						echo "<option value='".$row['nombre']."fotoNick".$row['foto']."'>".$row['nombre']."</option>";
    					}
    				}
    		echo '</select><br/><br/>';
		}
		echo '<img src="img/like.png" width="50" height="auto"/><input type="checkbox" name="like" value="1" style="width: 20px;"/> <br/><br/>';

		echo '<input type="checkbox" name="dislike" value="2" style="width: 20px;"/><img src="img/dislike.png" width="50" height="auto"/> <br/><br/>';
			echo '<input type="submit" value="Comprobar" id="comprobar" /></form>';
		}

	}
}
}else{  
	echo '<script>window.location="layout.php"</script>'.'Has realizado todas las preguntas. Buen trabajo!'."<form action='layout.php' method='POST' ><input type='submit'  value='Finalizar este juego' name='todasRespondidas' id='todasRespondidas'/></form>";
}

mysqli_close();
?>