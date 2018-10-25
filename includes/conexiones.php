<?php

//$mysqli = mysqli_connect("localhost", "root", "", "Quiz");
$mysqli = mysqli_connect("db714056396.db.1and1.com", "dbo714056396", "LOSfablos1967_", "db714056396");
if (!$mysqli) {
    die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
}
?>