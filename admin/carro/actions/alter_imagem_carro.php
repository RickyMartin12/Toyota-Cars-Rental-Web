<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/connect.php';

$id = $_POST['id'];
$modelo = $_POST['modelo'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$kms = $_POST['kms'];


        

if (isset($_FILES['file'])) 
{
    $filename = $_FILES["file"]["name"];
    $uploaddir = $_SERVER['DOCUMENT_ROOT']  . '/admin/definitions/upload/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
    {
        
        $sql = mysqli_query($conn, "SELECT id FROM modelo WHERE nome='$modelo'");
        $exibe = mysqli_fetch_assoc($sql);
        $id_modelo = $exibe['id']; 

        $sql =" UPDATE carros SET modelo = $id_modelo, nome_carro = '$nome' ,preco = $preco, kms = $kms, img = '$filename' WHERE id = $id";

        

        $result = mysqli_query($conn,$sql);
        if ($result)
            echo 1;
        else  
            echo 0;
        


    }
    else
    {
        echo 2;
    }


}
else
{
    $sql1 = mysqli_query($conn, "SELECT id FROM modelo WHERE nome='$modelo'");
    $exibe1 = mysqli_fetch_assoc($sql1);
    $id_modelo1 = $exibe1['id']; 

    $sql =" UPDATE carros SET modelo = $id_modelo1, nome_carro = '$nome' ,preco = $preco, kms = $kms WHERE id = $id";


    $result = mysqli_query($conn,$sql);
    if ($result)
            echo 11;
        else  
            echo 10;
}



?>