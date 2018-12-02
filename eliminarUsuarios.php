<?
include('includes/conexiones.php');
if(isset($_GET['id_usuario'])){
$usuario = $_GET['id_usuario'];
$sql = "DELETE FROM usuarios WHERE id_usuario = '$usuario'";
mysqli_query($mysqli, $sql);
mysqli_close();
}
?>