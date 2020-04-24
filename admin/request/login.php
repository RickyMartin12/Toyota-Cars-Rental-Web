<?php

    require_once '../connect.php';
    session_start();

          $err='';
          $err_login = '';
          $success = '';


          if (!$_POST['utilizador'])
            $err .= '- Utilizador * <br>';
          else 
            $utilizador = $_POST['utilizador']; 

          if (!$_POST['password'])
            $err .= '- Password * <br>';
          else 
            $password=$_POST['password']; 
  if($_SERVER["REQUEST_METHOD"] == "POST") 
  {
     if($err == '')
     {
          $utilizador = $_POST['utilizador'];
          $password = md5(trim($_POST['password']));
          $sql = "SELECT * FROM admins WHERE nome_utilizador='$utilizador' AND pass='$password'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $rowcount=mysqli_num_rows($result);
          if ($rowcount == 1)
          {
            $_SESSION['pr_uid']=$row['id'];
            $_SESSION['usern']=$row['nome_utilizador'];
            $_SESSION['privilegios'] = $row['tipo'];
            $_SESSION['access'] = $row['privilegios'];
            $s = $_SESSION['privilegios'];
            $setpriv = "SELECT * FROM privilegios WHERE tipo= '$s' ";
            $res = mysqli_query($conn, $setpriv);
            if (mysqli_num_rows($result) > 0) 
            {
              while($row = mysqli_fetch_assoc($res)) 
              {
                 $_SESSION['carro_novo_pri'] = $row['carro_novo_pri'];
                 $_SESSION['carro_pes_pri'] = $row['carro_pes_pri'];
                 $_SESSION['modelo_novo_pri'] = $row['modelo_novo_pri'];
                 $_SESSION['modelo_pes_pri'] = $row['modelo_pes_pri'];

                 $_SESSION['comentarios_list_pri'] = $row['comentarios_list_pri'];
                 $_SESSION['reserva_list_pri'] = $row['reserva_list_pri'];


              }
            }
            //$_SESSION['start'] = time();


            setcookie("usern", $_SESSION['usern'], time() + (86400 * 30), "/"); 
            setcookie("id", $_SESSION['pr_uid'], time() + (86400 * 30), "/");
            setcookie("privilegios", $_SESSION['privilegios'], time() + (86400 * 30), "/");

            setcookie("carro_novo_pri", $_SESSION['carro_novo_pri'], time() + (86400 * 30), "/");
            setcookie("carro_pes_pri", $_SESSION['carro_pes_pri'], time() + (86400 * 30), "/");
            setcookie("modelo_novo_pri", $_SESSION['modelo_novo_pri'], time() + (86400 * 30), "/");
            setcookie("modelo_pes_pri", $_SESSION['modelo_pes_pri'], time() + (86400 * 30), "/");

            setcookie("comentarios_list_pri", $_SESSION['comentarios_list_pri'], time() + (86400 * 30), "/");
            setcookie("reserva_list_pri", $_SESSION['reserva_list_pri'], time() + (86400 * 30), "/");
            setcookie("access", $_SESSION['access'], time() + (86400 * 30), "/");

            

            $success='../carros_toyota_reserva/admin/index.php';
            $arr = array('error'=>'', 'id'=>$_SESSION['pr_uid'], 'success'=>$success);

          }
          else
          {
            $err_login = 'Utilizador ou Password incorretos';
            $arr = array('error'=>$err_login, 'id'=>'', 'success'=>'');
          }
      }
      else
      {
          $arr = array('error'=>$err, 'id'=>'', 'success'=>'');
      }
    }

      mysqli_close($conn);
      echo json_encode($arr);
?>
