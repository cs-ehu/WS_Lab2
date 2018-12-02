<?
include('includes/conexiones.php');
if(isset($_GET['id_usuario']) && isset($_GET['activo']))
$usuario = $_GET['id_usuario'];
$activo = $_GET['activo']; 
$sql = "UPDATE usuarios SET activa = '$activo' WHERE id_usuario = '$usuario'";
mysqli_query($mysqli, $sql);
mysqli_close();
?>