<?php 
include("includes/conexiones.php");   
if(isset( $_GET['email'])){
	$email= $_GET['email'];	$sql="SELECT * FROM usuarios  WHERE email='$email'";

$result = mysqli_query($mysqli ,$sql);
if (mysqli_num_rows($result) >0){
	$row= mysqli_fetch_array($result);
	$id=$row['id_usuario'];
	$sql2="UPDATE usuarios SET logueado = 0 WHERE id_usuario='$id'";
	$result2 = mysqli_query($mysqli ,$sql2);
	if (mysqli_num_rows($result) >0) 
	header("Location: layout.php");
}
}
?>