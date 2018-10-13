<?php

include("includes/conexiones.php");
$sql ="SELECT * FROM Preguntas";
$resultado = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($resultado) >0){
	echo "<table border='1px'><tr><th>Autor</th><th>Enunciado</th><th>Respuesta correcta</th><th>Respuesta incorrecta 2</th><th>Respuesta incorrecta 3</th><th>Respuesta correcta 3</th><th>Complejidad</th><th>Tema</th></tr>";
		while ($row = mysqli_fetch_array($resultado)) { 
			echo "<tr>";
			echo "<td>".$row['email']."</td>"."<td>".$row['enunciado']."</td>"."<td>".$row['correcta']."</td>"."<td>".$row['incorrecta1']."</td>"."<td>".$row['incorrecta2']."</td>"."<td>".$row['incorrecta3']."</td>"."<td>".$row['complejidad']."</td>"."<td>".$row['tema']."</td>";
			echo "</tr>";
		}

	echo "</table>";
}else{
	echo "No hay preguntas que mostrar<br/>";
}

if (!mysqli_query($mysqli ,$sql)){
	die('Error: '.mysqli_error($mysqli));
}
mysqli_close($mysqli);
?>
