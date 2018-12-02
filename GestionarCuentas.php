<?php
session_start();
if(!$_SESSION['email'] || $_SESSION['rol'] != 'admin' ){
	header('Location:Login.php');
	exit();
}
?>
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
		     <script type="text/javascript">
		     	function activarUsuario(id_usuario, activo){
		     		var confirmado = confirm('Seguro que desea modificar el estado de este usuario?');
		     		if(confirmado){
		     			var estadoActivo;
		     			if(activo == 1) estadoActivo= 0;
		     			else estadoActivo =1;
		     		if (window.XMLHttpRequest) {
					    // code for IE7+, Firefox, Chrome, Opera, Safari
					    xmlhttp=new XMLHttpRequest();
					  } else {  // code for IE6, IE5
					    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  xmlhttp.onreadystatechange=function() {
					    if (this.readyState==4 && this.status==200) {
					      location.reload();
					    }
					  }
					 xmlhttp.open("GET",  "modificarUsuarios.php?id_usuario="+id_usuario+"&activo="+estadoActivo,true );
					 xmlhttp.send();
		     		}		     		
		     	}
		     	function eliminarUsuario(id_usuario){
		     		var confirmado =confirm('Seguro que desea eliminar este usuario?');
		     		if(confirmado){
		     		if (window.XMLHttpRequest) {
					    // code for IE7+, Firefox, Chrome, Opera, Safari
					    xmlhttp=new XMLHttpRequest();
					  } else {  // code for IE6, IE5
					    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  xmlhttp.onreadystatechange=function() {
					    if (this.readyState==4 && this.status==200) {
					      location.reload();
					    }
					  }
					 xmlhttp.open("GET",  "eliminarUsuarios.php?id_usuario="+id_usuario,true );
					 xmlhttp.send();
		     		}
		     	}
		     </script>
  </head>

  <body>
  <div id='page-wrap'>
<?php include('includes/headerNav.php')?>
<section class="main obtener" id="s1" style="height: 100%;width: auto;float: none;">
	<div>
<?php
include("includes/conexiones.php");

$sql ="SELECT * FROM usuarios";
$resultado = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($resultado) >0){
echo "<h4>Usuarios registrados</h4><table border='1'><tr><th>Email</th><th>Password</th><th>Imagen</th><th>Activo</th><th>Activar/Bloquear</th><th>Eliminar</th></tr>";
while ($row = mysqli_fetch_array($resultado)) { 
	if($row['activa'] == 1){
		$activo= 'SI';
		$activar='Bloquear';
	}
	else {
		$activo = 'NO';
		$activar = 'Activar';
	}
	echo "<tr><td>".$row['email']."</td><td style='max-width:300px; overflow:hidden;'>".$row['password']."</td><td><img src='img/".$row['foto']."' width='30' height='auto'/></td><td>".$activo."</td><td><input type='button' value='".$activar."' onclick='activarUsuario(".$row['id_usuario'].", ".$row['activa'].")'/></td><td><input type='button' value='Eliminar' onclick='eliminarUsuario(".$row['id_usuario'].")'/></td></tr>";
}
echo '</table>';
}
else{
	echo "No hay usuarios que gestionar";
}

if (!mysqli_query($mysqli ,$sql)){
	die('Error: '.mysqli_error($mysqli));
}
mysqli_close($mysqli);
?>
</div>
<div>
</div>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/ilarue/WS_Lab2' target="_blank">Link GITHUB</a>
	</footer>
</div>
</body>
</html>