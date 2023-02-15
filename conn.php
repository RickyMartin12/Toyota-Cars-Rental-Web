<?php

$servername = "containers-us-west-193.railway.app";
$username = "root";
$password = "wyGJjUpFOoD8FRzcWEk2";
$dbname = "railway";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Erro ao ligar DB" . mysqli_connect_error());
}


?>