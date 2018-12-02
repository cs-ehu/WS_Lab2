<?php
include('includes/conexiones.php');
if(isset($_POST['recuperarPass'])){
$zonahoraria = date_default_timezone_get();
date_default_timezone_set("Europe/Madrid");
$fecha =  date("Y/m/d");
$hora = date("h:i:sa");
$email = $_POST['recuperarPass'];
echo "<h3>".$email." ha solicitado correctamente recuperar password.</h3><h4> Dia: ".$fecha." Hora: ".$hora."</h4>";
require ("mailer/class.phpmailer.php");

$nombre_origen    = "Pilar Ruete"; 
$email_origen     = "pilarruete@gmail.com"; 
//$email_ocultos    = "ilarue90@hotmail.com";

//$email_destino    = "pruete@ceit.es, ".$_SESSION["email"]." ";
//Ha de llegarle al responsable de equipo y al investigador
$email_destino    = $email;


$asunto           = "Recuperar sus datos";

$mensaje          = '<h4>Vaya a este link para recuperar sus datos.</h4><a href="http://s546876151.mialojamiento.es/sw/nuevoPass.php?email='.$email.'&fecha='.$fecha.'&hora='.$hora.'">Recuperar datos</a>';



$formato          = "html"; 

//*****************************************************************// 
$headers  = "From: $nombre_origen <$email_origen> \r\n"; 
$headers .= "Return-Path: <$email_origen> \r\n"; 
$headers .= "Reply-To: $email_origen \r\n"; 
$headers .= "Cc: $email_copia \r\n"; 
//$headers .= "Bcc: $email_ocultos \r\n"; 
$headers .= "X-Sender: $email_origen \r\n"; 
$headers .= "X-Mailer: [Trabajo UPV Sistemas Web] \r\n"; 
$headers .= "X-Priority: 3 \r\n"; 
$headers .= "MIME-Version: 1.0 \r\n"; 
$headers .= "Content-Transfer-Encoding: 7bit \r\n"; 
$headers .= "Disposition-Notification-To: \"$nombre_origen\" <$email_origen> \r\n"; 
//*****************************************************************// 

if($formato == "html") { 
  $headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";  
} else { 
  $headers .= "Content-Type: text/plain; charset=ISO-8859-1 \r\n";  
  } 

if (@mail($email_destino, $asunto, $mensaje, $headers))  { 
  echo "<h4>Usted recibir&aacute; un email que tiene tiempo limitado de respuesta</h4>";  
}else{ 
   echo "Error en el envio del email"; 
} 

}
mysql_close();
?>