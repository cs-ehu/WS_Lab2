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
<section class="main" id="s1" style="height: auto;width: auto;">
	<div>
<?php
include("includes/conexiones.php");

$sql ="SELECT * FROM preguntas";
$resultado = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($resultado) >0){
echo "<table border='1px'><tr><th>Autor</th><th>Enunciado</th><th>Respuesta correcta</th><th>Respuesta incorrecta 2</th><th>Respuesta incorrecta 3</th><th>Respuesta correcta 3</th><th>Complejidad</th><th>Tema</th><th>Imagen</th></tr>";
while ($row = mysqli_fetch_array($resultado)) { 
	echo "<tr>";
	echo "<td>".$row['email']."</td>"."<td>".$row['enunciado']."</td>"."<td>".$row['correcta']."</td>"."<td>".$row['incorrecta1']."</td>"."<td>".$row['incorrecta2']."</td>"."<td>".$row['incorrecta3']."</td>"."<td>".$row['complejidad']."</td>"."<td>".$row['tema']."</td>"."<td><img src='img/".$row['img']."' width='200' heigth='auto'/></td>";
	echo "</tr>";
}

echo "</table>";
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
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>