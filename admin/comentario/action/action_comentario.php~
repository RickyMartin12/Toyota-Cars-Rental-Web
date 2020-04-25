<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/admin/connect.php';



switch ($_POST['action']){

  // Pesquisa do NIF

    case '1':

        $id = $_POST['id'];
        $activo = $_POST['activo'];

        if ($activo == 1)
        {
            $a = 0;
            $sql=" UPDATE comentarios SET activo = $a WHERE id_comentario = $id";
            $result = mysqli_query($conn,$sql);
            if ($result)
            {
                echo 11;
            }
            else
            {
                echo 10;
            }
        }
        else
        {
            $a = 1;
            $sql=" UPDATE comentarios SET activo = $a WHERE id_comentario = $id";
            $result = mysqli_query($conn,$sql);
            if ($result)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
        

        

    break;

    case '2':
    $reg_del= "DELETE FROM comentarios WHERE id_comentario ='{$_POST['id']}'";
    $result = mysqli_query($conn,$reg_del);
    if ($result){
      echo 2; 
    }
    else {
      echo 0;
    }

    break;

    case '3':

    $nome = $_POST['nome'];
    
    $var = "";
    
     
      $obter_clientes=" SELECT id FROM admins WHERE nome = '$nome' LIMIT 1";
        $result = mysqli_query($conn, $obter_clientes);
        while($obj = mysqli_fetch_object($result)) 
        {
          $var[] = $obj;
        }
        echo json_encode($var);

    break;

    case '4':

    $id = $_POST['id'];

    $titulo = $_POST['titulo'];

    $id_utilizador = $_POST['id_utilizador'];

    $date_array = explode('/',trim($_POST['data_comentario']));
    $data = strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].'-00');

    $descricao = $_POST['descricao'];

    $activo = $_POST['activo'];

    $sql =" UPDATE comentarios SET titulo = '$titulo', nome_pessoa = $id_utilizador, data = $data, descricao = '$descricao', activo = $activo WHERE id_comentario = $id";
    $result = mysqli_query($conn,$sql);
    if ($result)
        echo 1;
    else  
        echo 0;
    break;

    case '5':

    $err = '';

    // Titulo
    $titulo = $_POST['titulo'];
    if ($titulo == "")
    {
        $err .= "- Titulo do Comentario <span class='w3-text-red'> * </span><br>"; 
    }


    // Data do comentario
    $d = $_POST['data_comentario'];

    if ($d == "")
      $err .= "- Data do Comentario <span class='w3-text-red'> *</span><br>";
    else{
      $date_array=explode('/',trim($d));
      $data_comentario=strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].'-00'); 
    }

    //Nome do Utilizador
    $username = $_POST['username'];

    if ($username == "")
    {
      $err .= "- Nome do Utilizador <span class='w3-text-red'> *</span><br>";
    }

    //Descricao

    $descricao = $_POST['descricao'];

    if ($descricao == "")
    {
      $descricao = "-/-";
    }

    if (!$err)
    {
      $v = "";

      $obter_comp=" SELECT nome FROM admins ORDER BY nome ASC";
      $result = mysqli_query($conn, $obter_comp);
      while($obj = mysqli_fetch_object($result)) 
      {
        $v[] = $obj;
      }

      $array = json_decode(json_encode($v), True);
      $key = array_search($username, array_column($array, 'nome'));
      if (is_numeric($key))
      {

        $sql = mysqli_query($conn, "SELECT id FROM admins WHERE nome='$username'");

        $exibe = mysqli_fetch_assoc($sql);
        $id_username = $exibe['id']; 

        $sql =" INSERT INTO comentarios (titulo, nome_pessoa, data, descricao, activo) VALUES ('$titulo', $id_username, $data_comentario, 'descricao', 0)";
        $result = mysqli_query($conn,$sql);
          if ($result) {
            $response = 1; 
            $last_id = mysqli_insert_id($conn);
          }  
          else {
            $response = 0;
            $last_id = 0; 
          }

          $r=array('error'=>'','success' => $response,'id' => $last_id, 'nome' => $username);
          echo json_encode($r);
      }
      else
      {
        echo 100;
      }
    }
    else
        {
            $r = array('error' =>$err, 'success' =>'','id' =>'', 'nome' => '');
            echo json_encode($r);
        }


    break;

    case '6':

    $obter_comp=" SELECT comentarios.titulo, admins.nome_utilizador, comentarios.data, comentarios.descricao FROM comentarios INNER JOIN admins ON comentarios.nome_pessoa = admins.id WHERE comentarios.activo = 1";
    $result = mysqli_query($conn, $obter_comp);
    while($obj = mysqli_fetch_object($result)) {
    $var[] = $obj;}
    echo json_encode($var);

    break;

}
