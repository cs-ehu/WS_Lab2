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
<?php include('includes/headerNavVerPreguntas.php')?>
<section class="main obtener" id="s1" style="height: 100%;width: auto;float: none;">
	<div>
<?php
include("includes/conexiones.php");

$sql ="SELECT * FROM preguntas";
$resultado = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($resultado) >0){
echo "<h4>Selecciona una pregunta en base a su identificador por favor</h4><form method='get' action='ObtenerPregunta.php' ><select name='ObtenerPregunta'>";
while ($row = mysqli_fetch_array($resultado)) { 
	echo "<option value=".$row['id'].">Pregunta con identificador:  ".$row['id']."</option>";
}

echo "<br/><br/><input type='hidden' name='email' value='".$_GET['email']."' /><input type='hidden' name='usuario' value='".$_GET['usuario']."' /><input type='hidden' name='foto' value='".$_GET['foto']."' /><input type='hidden' name='contadorUsuarios' value='".$_GET['contadorUsuarios']."' /><input type='submit' value='Consultar pregunta' id='enviarIdPregunta'/></form></select>";
}
else{
	echo "No hay preguntas que mostrar";
}

if (!mysqli_query($mysqli ,$sql)){
	die('Error: '.mysqli_error($mysqli));
}
mysqli_close($mysqli);
?>
</div>
<div>
<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');


if(isset($_GET['ObtenerPregunta'])){
	$idPregunta = (int)$_GET['ObtenerPregunta'];
	$email = $_GET['email'];
	$foto = $_GET['foto'];
	$usuario = $_GET['usuario'];
	$contadorUsuarios = $_GET['contadorUsuarios'];
	//Para crear el wsdl
/*	$soapclient2 = new nusoap_client('ObtenerPreguntaSW.php');
	$result2 = $soapclient2->call('obtener');
*/
$soapclient2 = new nusoap_client('http://s546876151.mialojamiento.es/sw/ObtenerPreguntaSW.php?wsdl ',true);
$result2 = $soapclient2->call('obtener', array('pregunta' => $idPregunta ) );
$autor = explode('enunciado-',$result2 );
$enunciado = explode('correcta-',$autor[1] );

echo '<table border="1" style="width: 100%;"><tr><th>Autor</th><th>Enunciado</th><th>Correta</th></tr><tr><td>'.$autor[0].'</td><td>'.$enunciado[0].'</td><td>'.$enunciado[1].'</td></tr></table>';

}

?>
</div>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>