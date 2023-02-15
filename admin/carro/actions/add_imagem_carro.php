<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/connect.php';


$err='';

if (isset($_FILES['file'])) 
{
    $filename = $_FILES["file"]["name"];
    $uploaddir = $_SERVER['DOCUMENT_ROOT']  . '/admin/definitions/upload/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
    {
        // Modelo
        if (!$_POST['modelo'])
        {
        $err .= "- Modelo do Carro <span class='w3-text-red'> * </span><br>"; 
        }
        else
        {
            $modelo = $_POST['modelo'];
        }

        //Nome
        if (!$_POST['nome'])
        {
        $err .= "- Nome do Carro <span class='w3-text-red'> * </span><br>"; 
        }
        else
        {
            $nome = $_POST['nome'];
        }

        //Preco
        if (!$_POST['preco'])
        {
        $err .= "- Preco do Carro <span class='w3-text-red'> * </span><br>"; 
        }
        else
        {
            $preco = $_POST['preco'];
        }

        //KMS

        if (!$_POST['kms'])
        {
        $err .= "- Kms do Carro <span class='w3-text-red'> * </span><br>"; 
        }
        else
        {
            $kms = $_POST['kms'];
        }

        if ($err == "") 
        {

            $sql = mysqli_query($conn, "SELECT id FROM modelo WHERE nome='$modelo'");

            $exibe = mysqli_fetch_assoc($sql);
                $id_modelo = $exibe['id'];  
              
            //$id_modelo = $row['id'];
            $sql ="INSERT INTO carros (modelo, nome_carro, preco, kms, img) VALUES ($id_modelo,'$nome',$preco, $kms, '$filename')";
            



            $result = mysqli_query($conn,$sql);
            if ($result) 
            {
                $response = 1; 
                $last_id = mysqli_insert_id($conn);
            }  
            else 
            {
                $response = 0;
                $last_id = 0; 
            }

            $r=array('error'=>'','success' => $response,'id' => $last_id);
            echo json_encode($r);
        }
        else
        {
            $r = array('error' =>$err, 'success' =>'','id' =>'');
            echo json_encode($r);
        }
    } 
    else 
    {
        echo 0;
    }
    
}
else
{
    echo 0;
}








?>