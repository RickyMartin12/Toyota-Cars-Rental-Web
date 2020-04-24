<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/admin/connect.php';

$err='';

switch ($_POST['action']){

  // Pesquisa do NIF

    case '1':

        // Modelo
        if (!$_POST['nome'])
        {
        $err .= "- Nome do Modelo do Carro <span class='w3-text-red'> * </span><br>"; 
        }
        else
        {
            $nome = $_POST['nome'];
        }


        if ($err == "") 
        { 
              
            //$id_modelo = $row['id'];
            $sql ="INSERT INTO modelo (nome) VALUES ('$nome')";
            



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



    break;

    case '2':

    $id = $_POST['id'];

    $nome = $_POST['nome'];

    $sql =" UPDATE modelo SET nome = '$nome' WHERE id = $id";

    $result = mysqli_query($conn,$sql);
    if ($result)
        echo 1;
    else  
        echo 0;





    break;

    case '3':

    $reg_del= "DELETE FROM modelo WHERE id ='{$_POST['id']}'";
    $result = mysqli_query($conn,$reg_del);
    if ($result){
      echo 2; 
    }
    else {
      echo 0;
    }

    break;



}