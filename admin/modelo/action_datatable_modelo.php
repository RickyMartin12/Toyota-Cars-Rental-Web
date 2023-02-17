

<?php
  
// DataTables PHP library

$servername = "containers-us-west-193.railway.app";
$username = "root";
$password = "wyGJjUpFOoD8FRzcWEk2";
$dbname = "railway";
$port = "7728";
$RAW_SQL_QUERY="SELECT * FROM modelo WHERE 1";   
$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

$result = $mysqli->query($RAW_SQL_QUERY);

$rows = $result->fetch_all(MYSQLI_ASSOC);
$r = array();
foreach ($rows as $row) {
   $r[] = $row;
}

$arr=array("data"=>$r,"options"=>'',"files"=>'');//DATATABLE CLIENT SIDE PARSES
echo json_encode($arr);

exit();