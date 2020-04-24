<?php
require_once '../connect.php';

if ($_POST["label"]) {
    $label = $_POST["label"];
}



$response = '';
$filename = $label.$_FILES["file"]["name"];

unlink("upload/" . $filename);

/*$allowedExts = array("gif", "jpeg", "jpg", "png");*/

$allowedExts = array("png");


$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

/*
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
*/

if ((($_FILES["file"]["type"] == "image/png"))

&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        $response = "Erro: " . $_FILES["file"]["error"];
    } else {
        $filename = $label.$_FILES["file"]["name"];
        echo $filename;
        /*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";*/
        if (file_exists("upload/" . $filename)) {
             $response = "Erro: " .$filename . " ficheiro existente.";
       }
      else {
             move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $filename);
             $path= "upload/" . $filename;
             $response = 'Sucesso:';
        }
    }
} else {
    $response = "Erro: Ficheiro inv?ido";
}

if ($response == 'Sucesso:'){
$sql_logo ="UPDATE companhia SET logo = '$path' WHERE 1";
$result = mysqli_query($conn, $sql_logo);
if($result)
$response .= $path;
else{
unlink("upload/" . $filename);
$response = 'Erro: Escrita BD';
}
}

echo $response;

mysqli_close($conn);
?>