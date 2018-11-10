<?php
include("includes/conexiones.php");   
$sql ="SELECT * FROM usuarios WHERE logueado = 1 ";
$result = mysqli_query($mysqli ,$sql);
if (mysqli_num_rows($result) >0){
$contadorUsuarios= mysqli_num_rows($result) ;
echo $contadorUsuarios;
}
else echo '0';
?>
