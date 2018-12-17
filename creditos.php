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
<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
  </head>
  <body>
  <div id='page-wrap'>
	
	<?php include('includes/headerNav.php')?>
    <section class="main" id="s1">
    
	<div>
		<div class="creditosLyrics">
			<h3>Pilartxo Ruete Serrano<br/>
			Estudiante Ingenier&iacute;a de Software<br/>
			Facultad de Inform&aacute;tica UPV/EHU</h3>
			<div id='datosGeo'>
<?php  
//$datosGeo1= var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
$datosGeo= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));

echo 'Ciudad: '.$datosGeo['geoplugin_city']."<br/>";
echo 'Regi&oacute;n: '.$datosGeo['geoplugin_region']."<br/>";
echo 'Provincia: '.$datosGeo['geoplugin_regionName']."<br/>";
echo 'Pa&iacute;s: '.$datosGeo['geoplugin_countryName']."<br/>";
echo 'Continente: '.$datosGeo['geoplugin_continentName']."<br/>";
echo 'Latitud: '.$datosGeo['geoplugin_latitude']."<br/>";
echo 'Longitud: '.$datosGeo['geoplugin_longitude']."<br/>";
echo 'Moneda: '.$datosGeo['geoplugin_currencyCode']."<br/>";


?>
			</div>
		</div>
		<div class="creditosImg">
			<img src="img/paraSW.jpg" alt="" width="auto" height="400">
		</div>
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
