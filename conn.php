<?php

$servername = "containers-us-west-193.railway.app";
$username = "root";
$password = "wyGJjUpFOoD8FRzcWEk2";
$dbname = "railway";
$port = "7728";
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Erro ao ligar DB" . mysqli_connect_error());
}


?>