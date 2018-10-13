<?php

//$mysqli = mysqli_connect("localhost", "root", "", "Quiz");
$mysqli = mysqli_connect("localhost", "id7191944_admin", "pilartxo", "id7191944_quiz");
if (!$mysqli) {
    die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
}
?>