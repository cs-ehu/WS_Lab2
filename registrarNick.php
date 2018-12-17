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

	<script src="js/jquery.min.js"></script>
    <script src="js/cargaImg.js"></script>
	<script type="text/javascript">
		   	function registrarNick(){
		   		var nick = document.getElementById('nick').value;
		   		if(nick == ''){
		   			alert('Escribe tu nick, por favor');
		   		}else{
		   			document.getElementById('formNick').submit();
		   		}
		   	}

	</script>
</head>
<body>
<div id='page-wrap'>
	<?php include('includes/headerNav.php')?>
   <?php include('includes/conexiones.php')?>

    <section class="main" >
    	<?php if(!isset($_POST['nick'])){?>
    	<div>
    	<h3>Registrar Nick</h3>
    	<form action="registrarNick.php" id="formNick" method="POST" class="formPregunta" enctype="multipart/form-data">
    	<label for="nick">Nick:*</label>
		   <input type="text" name="nick" id="nick" value="" class="inputAncho" />
		  <br/><br/>
		   <input type="file" name="imgAddNick"   id="imgAddNick" size="60" />
		   <div id="muestraImgNick"></div>
		  <input type="button" value="Registrar Nick!" id="registrarNickB" onclick="registrarNick()" />
    	</form>
    	</div>
    <?php }else{
    	$nick = $_POST['nick'];
    	if($foto=$_FILES["imgAddNick"]["name"]){
		$foto=$_FILES["imgAddNick"]["name"];
		$fototemp=$_FILES["imgAddNick"]["tmp_name"];
		 ini_set('post_max_size','100M');
		 ini_set('upload_max_filesize','100M');
		 ini_set('max_execution_time','1000');
		 ini_set('max_input_time','1000');
		list($ancho,$alto)=getimagesize($fototemp);
		$nuevaimg=imagecreatetruecolor(200,180);
		$idnuevaimg=imagecreatefromjpeg($fototemp);
		imagecopyresized($nuevaimg,$idnuevaimg,0,0,0,0,200,180,$ancho,$alto);
		imagejpeg($nuevaimg,"img/".$foto);
	} else{if($foto=="")$foto="user.png";}
	$sql="SELECT * FROM nickUsuarios";
	$resultado = mysqli_query($mysqli, $sql);
	$sePuedeRegistrar=true;
	if(mysqli_num_rows($resultado) > 0 ){
		while($row = mysqli_fetch_array($resultado)){
			if($row['nombre'] == $nick){
				$sePuedeRegistrar=false;
			}
		}
	}
	if($sePuedeRegistrar){
	$sqlIn="INSERT INTO nickUsuarios (foto , nombre , aciertos , fallos) VALUES
		('$foto' , '$nick',0,0)  ";
	mysqli_query($mysqli,$sqlIn);
    	?>
    	<div>
    		<img src="img/<?php echo $foto;?>" width="40" height="auto"/>
    		<h3><?php echo "Enhorabuena, ".$nick."!<br/>Se ha registrado correctamente"?></h3>
    	</div>
    	<?php
    }else{ 
    	?>
    		<div>
    			<h3>Este nick pertence a otro usuario</h3>
    		</div>
    <?php }}?>
    </section>
    <footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>