<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/admin/connect.php';



switch ($_POST['action']){

  // Pesquisa do NIF

    case '1':

    
    // NIF

    $id = $_POST['id'];
    
    $var = "";
    
     
      $obter_clientes=" SELECT nome FROM modelo WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $obter_clientes);
        while($obj = mysqli_fetch_object($result)) 
        {
          $var[] = $obj;
        }
        echo json_encode($var);
  

    break;

    case '2':

    
        $filename = $_FILES["file"]["name"];
        
        $uploaddir = $_SERVER['DOCUMENT_ROOT']  . '/carros_toyota_reserva/admin/definitions/upload/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    
    break;

    case '3':

    
    // NIF

    $nome = $_POST['nome'];
    
    $var = "";
    
     
      $obter_clientes=" SELECT id FROM modelo WHERE nome = '$nome' LIMIT 1";
        $result = mysqli_query($conn, $obter_clientes);
        while($obj = mysqli_fetch_object($result)) 
        {
          $var[] = $obj;
        }
        echo json_encode($var);
  

    break;

    case '4':

    
    // NIF

    $id = $_POST['id'];
    
    $var = "";
    
     
      $obter_clientes=" SELECT nome FROM modelo WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $obter_clientes);
        while($obj = mysqli_fetch_object($result)) 
        {
          $var[] = $obj;
        }
        echo json_encode($var);
  

    break;

    case '5':
    $reg_del= "DELETE FROM carros WHERE id ='{$_POST['id']}'";
    $result = mysqli_query($conn,$reg_del);
    if ($result){
      echo 2; 
    }
    else {
      echo 0;
    }

    break;


}


