

<?php
 

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/connect.php';


$RAW_SQL_QUERY="SELECT * FROM carros WHERE 1"; 
$data = array();   
while($row = mysqli_fetch_array($RAW_SQL_QUERY)) {
   $data[] = $row;
}

header("Content-type: application/json");
echo json_encode(array("data"=>$data,"options"=>'',"files"=>''));

exit();
