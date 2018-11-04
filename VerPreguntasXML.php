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
	<section class="main" id="s1" style="width: 100%; height: 100%;">
		<div>
		<?php
		$preguntas = simplexml_load_file('preguntas2.xml');
		echo "<table border='1' style='height: 100%; width: 100%;'><tr><th>Autor</th><th>Pregunta</th><th>Respuesta correcta</th></tr>";
		foreach ($preguntas->xpath('//assessmentItem') as $pregunta){
			echo "<tr>";
			echo "<td>".$pregunta->attributes()->author."</td>";
			echo "<td>".$pregunta->itemBody->p."</td>";
			echo "<td>".$pregunta->correctResponse->value."</td>";
		}
		echo "</table>";

		?>
		</div>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>