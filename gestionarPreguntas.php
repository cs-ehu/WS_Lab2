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
		    <script src="js/jquery.min.js"></script>
		     <script src="js/pregunta.js"></script>
		     <script src="js/cargaImg.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$("#insertarPregunta").click(function(){
		var dataString = $('#fpreguntas').serialize();

        //alert('Datos serializados: '+dataString);
        var form = $('#fpreguntas')[0]; 
		var formData = new FormData(form);

        var imgAdd = $("#imgAdd").val();

        var email = $("#email").val();
		var enunciado = $("#enunciado").val();
		var correcta = $("#correcta").val();
		var incorrecta1 =$("#incorrecta1").val();
		var incorrecta2 =$("#incorrecta2").val();
		var incorrecta3 =$("#incorrecta3").val();
		var complejidad = parseInt($("#complejidad").val());
		var tema =$("#tema").val();
		if(email == "" || enunciado == "" || correcta == "" || incorrecta1 == "" || incorrecta2 == "" || incorrecta3 == ""
			|| complejidad == "" || tema == ""){
			alert("Por favor, introduce todos los campos obligatorios");
		}else{
			var patt1 =/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/;
		    var result = email.match(patt1);
		    if(!result) alert("El email ha de ser terminado en tres cifras y @ikasle.ehu.eus");		
		    else{
		    	if(0>complejidad || complejidad>5)
		    		alert("La complejidad ha de ser entre 0 y 5, ambos inclusive");
		    	else{
		    		if(enunciado.length <10)
		    			alert("El enunciado de la pregunta ha de tener 10 caracteres al menos");
		    		else{

						 $.ajax({
		                    url:'InsertarPreguntaConFotoAjax.php',
		                   /* method:'POST',
		                    data:dataString,*/
		                    data: formData,
    					    type: 'POST',
    						contentType: false, 
    						processData: false, 
		                   success:function(data){
		                    //alert("Ha ido bien a insertar " + data);
		                   var sendEmail = $("#email").serialize();
        					//alert("sendEmail " + sendEmail)
		                     $.ajax({
		                    	url:'VerPreguntasXML_ajax.php',
		                    	method:'POST',
		                    	data: sendEmail,
		                   		success:function(preguntas){
		                   			//alert("ha ido bien ver " + preguntas);
		                   			$("#muestraImg").empty();
		                   			$("#preguntasXML").empty();
		                    		$("#preguntasXML").append(preguntas);
		                   			$('#fpreguntas')[0].reset();
		                   		}
				          		});
		                   }
				          });
		    		}

		    	}
		    }
		    
		}

	});

	$("#verPreguntas").click(function(){
		  document.getElementById("preguntasXML").innerHTML="";
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else {  // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {
		      document.getElementById("preguntasXML").innerHTML=this.responseText;
		    }
		  }
		 var email =document.getElementById("email").value;
		 xmlhttp.open("GET",  "VerPreguntasXML_ajax.php?email="+email,true );
		 xmlhttp.send();
		
	});

	setInterval(function(){
		  document.getElementById("contadorUsuarios").value="";
		   if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else {  // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {

		      document.getElementById("contadorUsuarios").value=this.responseText;
		    }
		  }
		 xmlhttp.open("GET",  "contadorUsuarios.php",true );
		 xmlhttp.send();
	}, 2000
	 );
		setInterval(function(){
		  document.getElementById("contadorPreguntas").value="";
		   if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else {  // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (this.readyState==4 && this.status==200) {

		      document.getElementById("contadorPreguntas").value=this.responseText;
		    }
		  }

		 var email =document.getElementById("email").value;
		 xmlhttp.open("GET",  "contadorPreguntas.php?email="+email,true );
		 xmlhttp.send();
	}, 2000
	 );

});
</script>
  </head>
  <body>
  <div id='page-wrap' style="height: auto;">
	<?php include('includes/headerNav.php')?>
    <section class="main" id="s1" style="height: auto;">
    <input type="button" name="verPreguntas" id="verPreguntas" value="Ver Preguntas">
     <input type="button" name="insertarPregunta" id="insertarPregunta" value="Introducir Pregunta">
	<section class="main"  style="width: 100%; height: 100%;">
		<div>
			<p>Usuarios conectados</p>
			<input type="text" value="" id="contadorUsuarios" style="color:red; font-size: 14px;font-weight: bold;" />
		</div>
	</section>
	<section class="main"  style="width: 100%; height: 100%;">
		<div>
			<p>N&uacute;mero de preguntas tuyas/N&uacute;mero total</p>
			<input type="text" value="" id="contadorPreguntas" style="color:red; font-size: 14px;font-weight: bold;" />
		</div>
	</section>
	<div>
		<form id='fpreguntas' name='fpreguntas' action=""  method="POST" class="formPregunta" enctype="multipart/form-data">
		<fieldset>
   		 <legend>Datos de la pregunta:</legend>
   		  <br/>
		  <label for="email">Email:*</label>
		  <input type="text" name="email" id="email" placeholder="Mickey0003@ikasle.ehu.es" value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>" class="inputAncho" />
		  <br/><br/>
		  <label for="enunciado">Enunciado de la pregunta:*</label>
		   <input type="text" name="enunciado" id="enunciado" value="" class="inputAncho" />
		   <input type="hidden" name="usuario" value="<?php if(isset($_GET['usuario'])) echo $_GET['usuario'];?>" />
		   <input type="hidden" name="fotoUsuario" value="<?php if(isset($_GET['foto'])) echo $_GET['foto'];?>" />
		    <input type="hidden" name="contadorUsuarios" value="<?php if(isset($_GET['contadorUsuarios'])) echo $_GET['contadorUsuarios'];?>" />
		  <br/><br/>
		  <label for="correcta">Respuesta Correcta:*</label>
		   <input type="text" name="correcta"  id="correcta" value="" class="inputAncho" />
		  <br/><br/>
		  <label for="incorrecta1">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta1"  id="incorrecta1" value="" class="inputAncho" />
		  <br/><br/>
		  <label for="incorrecta2">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta2"  id="incorrecta2" value="" class="inputAncho" />
		  <br/><br/>
		  <label for="incorrecta3">Respuesta Incorrecta:*</label>
		   <input type="text" name="incorrecta3"  id="incorrecta3" value="" class="inputAncho" />
		  <br/><br/>
		  <div class="compleTema">
		  <label for="complejidad">Complejidad(0..5):*</label>
		   <input type="text" name="complejidad"  value="" id="complejidad" />
		</div>
		  <div class="compleTema">
		  <label for="tema">Tema(subject)*</label>
		   <input type="text" name="tema"  placeholder="HTML" value="" id="tema" />
		</div>
		  <br/><br/>
		   <label for="imgAdd">Imagen</label>
		   <input type="file" name="imgAdd"   id="imgAdd" size="60" />
		   <div id="muestraImg"></div>
		  <br/><br/>
		  <br/><br/>
		  <!--<input type="button" value="Enviar Solicitud" id="enviarBotonAjax"/>-->
		</fieldset>
		</form>
	</div>

	<section class="main" style="width: 100%; height: 100%;">
		<div id="preguntasXML" >
		
		</div>
    </section>
    </section>

	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
