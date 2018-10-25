<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8" enctype="multipart/form-data">
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
		    <script src="js/jquery.min.js"></script>
		    <!-- <script src="js/preguntaHTML5.js"></script>-->
  </head>
  <body>
  <div id='page-wrap'>
	
	<?php include('includes/headerNav.php')?>
    <section class="main" id="s1">
    
	<div>
		<form id='fpreguntas' name='fpreguntas' action="InsertaPregunta.php"  method="POST" class="formPregunta">
		<fieldset>
   		 <legend>Datos de la pregunta:</legend>
   		  <br/>
		  <label for="email">Email:*</label>
		  <input type="email" name="email" id="email" placeholder="Mickey0003@ikasle.ehu.es" pattern="[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus" value="" class="inputAncho" required />
		  <br/><br/>
		  <label for="enunciado">Enunciado de la pregunta:*</label>
		   <input type="text" name="enunciado" id="enunciado" value="" class="inputAncho" minlength="10" required />
		  <br/><br/>
		  <label for="correcta">Respuesta Correcta:*</label>
		   <input type="text" name="correcta"  id="correcta" value="" class="inputAncho" required />
		  <br/><br/>
		  <label for="incorrecta1">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta1"  id="incorrecta1" value="" class="inputAncho" required />
		  <br/><br/>
		  <label for="incorrecta2">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta2"  id="incorrecta2" value="" class="inputAncho" required />
		  <br/><br/>
		  <label for="incorrecta3">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta3"  id="incorrecta3" value="" class="inputAncho" required />
		  <br/><br/>
		  <div class="compleTema">
		  <label for="complejidad">Complejidad(0..5):*</label>
		   <input type="text" name="complejidad"  pattern="[0-5]" value="" id="complejidad" required />
		</div>
		  <div class="compleTema">
		  <label for="tema">Tema(subject)*</label>
		   <input type="text" name="tema"  placeholder="HTML" value="" id="tema" required />
		</div>
		  <br/>
		   <label for="imgAdd">Imagen</label>
		   <input type="file" name="imgAdd" >
		  <input type="submit" value="Enviar Solicitud" id="enviarBoton">
		</fieldset>
		</form>
	</div>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
