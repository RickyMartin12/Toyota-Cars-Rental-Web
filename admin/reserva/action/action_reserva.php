<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/admin/connect.php';

$img1 = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/logo/toyotaCarsRental.png';
$img_title = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/admin/definitions/upload/logo1.png';
$img_reserva = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/icons/agenda.svg';
$img_logo = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/icons/user.png';
$img_res = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/icons/open-book.png';
$img_com = $_SERVER['DOCUMENT_ROOT'].'/carros_toyota_reserva/icons/com.png';

switch ($_POST['action']){

  
    case '1':
    
    // NIF

    $nome = $_POST['nome'];
    
    $var = "";
    
     
      $obter_clientes=" SELECT id FROM carros WHERE nome_carro = '$nome' LIMIT 1";
        $result = mysqli_query($conn, $obter_clientes);
        while($obj = mysqli_fetch_object($result)) 
        {
          $var[] = $obj;
        }
        echo json_encode($var);
  

    break;

    case '2':

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $pais = $_POST['pais'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_reserva = $_POST['data_reserva'];
    $hora_reserva = $_POST['hora_reserva'];
    $carro_id = $_POST['carro_id'];
    $observacao = $_POST['observacao'];

    $date_array = explode('/',trim($data_reserva));
    $data_r = strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].'-00');

    $horas = trim($hora_reserva); 
    $hrs = strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].' '.$horas);

    $sql = mysqli_query($conn, "SELECT nome_carro FROM carros WHERE id='$carro_id'");

    $exibe = mysqli_fetch_assoc($sql);
    $carro_nome = $exibe['nome_carro']; 

    $sql ="UPDATE reserva SET nome = '$nome', pais = '$pais', email = '$email', telefone = $telefone, data_reserva = $data_r, hora_reserva = $hrs, carro = $carro_id, observacoes = '$observacao' WHERE id = $id";



    $html = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.title-black-white {
    background: RGB(12,12,12);
    color: #FFF!important;
}
.right {
    float: right;
    width: 68px;
    position: absolute;
    padding: 10px;
  }
  .botm
  {
    margin-bottom: 40px;
  }
  .center {
    display: block;
    margin-left: 280px;
    margin-right: 280px;
    right: 100px;
  }
  .line-bord {
    border: 1px solid RGB(12,12,12);
}
.mylabel {
    color: #333;
    background: #FFC107 !important;
}
.align_div {
    margin-bottom: 15px;
}
.w3-padding-8 {
    padding-top: 8px!important;
    padding-bottom: 8px!important;
}
.w3-card-2, .w3-example {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
}
.bolder
{
    font-weight:bold;
}
</style>

<img src="'.$img1.'" class="center">
<div class="botm"></div>
<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva '.$id.'</h3>
<div class="botm"></div>
<div class="line-bord">
<img src="'.$img_title.'" class="right">
<div class="modal-header title-black-white">
    <h4 class="modal-title bolder" style="color: #fff;"><img src="'.$img_reserva.'" class="img-responsive"> Reserva Numero '.$id.'</h4> 
</div>
<div class="form-horizontal" id="form">
<div class="panel-body" style="padding: 16px; margin-top: -10px;">
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_logo.'" class="img-responsive">&nbsp;&nbsp;Detalhes Pessoais
</h5>
<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Nome da Pessoa:</font> '.$nome.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Pais:</font> '.$pais.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Email:</font> '.$email.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Telefone:</font> '.$telefone.'
</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_res.'" class="img-responsive">&nbsp;&nbsp;Marcação da Reserva
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Data de Reserva:</font> '.$data_reserva.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Hora de Reserva:</font> '.$hora_reserva.'
</div>
</div>


<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Nome do Carro:</font> '.$carro_nome.'
</div>
</div>

</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_com.'" class="img-responsive">&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Comentarios Finais:</font> '.$observacao.'
</div>
</div>


</div>
</div>


</div>
</div>






</div>
</div>

</div>

<br>
Cumprimentos
<br>
Ricardo Peleira - Gerente da Toyota Rental Cars LDA

';


    
    

    


    $result = mysqli_query($conn,$sql);
    if ($result)
    {
        

        

        echo 1;




    }
        
    else  
    {
        echo 0;
    }


    include $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/mpdf/mpdf.php';

    $mpdf=new mPDF();
    $mpdf->WriteHTML($html);

    $pdfdoc = $mpdf->Output("", "S");
    $attachment = chunk_split(base64_encode($pdfdoc));

    $separator = md5(time());
    $eol = PHP_EOL;

    $attachment = chunk_split(base64_encode($pdfdoc));
    $filename = "Reserva - ".$id." .pdf";

    $to = "r.peleira@hotmail.com";

        $headers  = "From: ".$to.$eol;
        $headers .= "MIME-Version: 1.0".$eol; 
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

        $info_client =
        "<div style='width:95%; margin-left:2.5%;'>
        <h4>Foi Mandado o seguinte PDF as informacoes da reserva alterada $nome com o email $email</h4>
        </div>";

        $info_c = utf8_decode("Boas $email, os detalhes foram enviados com sucesso");

        $body_c = "--".$separator.$eol;
        $body_c .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
        $body_c .= $eol;

        $body_c .= "--".$separator.$eol;
        $body_c .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
        $body_c .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $body_c .= $info_server.$eol;
        $body_c .= "--".$separator.$eol;
        $body_c .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
        $body_c .= "Content-Transfer-Encoding: base64".$eol;
        $body_c .= "Content-Disposition: attachment".$eol.$eol;
        $body_c .= $attachment.$eol;
        $body_c .= "--".$separator."--";

        mail($email,$info_c,$body_c,$headers);
        

    



    break;

    case '3':

    $reg_del= "DELETE FROM reserva WHERE id ='{$_POST['id']}'";
    $result = mysqli_query($conn,$reg_del);
    if ($result){
      echo 2; 
    }
    else {
      echo 0;
    }
    break;

    case '4':

    $err='';

    $nome = $_POST['nome'];

    // Nome
    if ($nome == "")
    {
        $err .= "- Nome da Pessoa <span class='w3-text-red'> * </span><br>"; 
    }
    else
    {
        
    }

    // Pais
    $pais = $_POST['pais'];
    if ($pais == "")
    {
        $err .= "- Pais da Pessoa <span class='w3-text-red'> * </span><br>"; 
    }
    

    //Email
    $email= $_POST['email'];

    if ($email == "")
    {
        $err .= "- Email da Pessoa <span class='w3-text-red'> * </span><br>"; 
    }
    else
    {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) 
        {
             $email = $_POST["email"];
          } 
          else 
          {
            $err .= "- Correio Electrónico (Email) inválido<span class='w3-text-red'> *</span><br>";
          }
    }

    //Telefone
    if (!$_POST['telefone'])
    {
        $err .= "- Telefone da Pessoa <span class='w3-text-red'> * </span><br>"; 
    }
    else
    {
        if ($_POST["telefone"])
      {
        if (is_numeric($_POST["telefone"]))
        {
          if (strlen($_POST['telefone']) >= 9 && strlen($_POST['telefone']) <= 15)
          {
            $telefone = $_POST['telefone'];
          }
          else
          {
            $err .= "- O Numero de Telefone da Reserva deve conter pelo menos entre 9 e 15 numeros <span class='w3-text-red'> *</span><br>";
          }
        }
        else
        {
          $err .= "- O Terceiro Numero da Reserva deve ser um numero <span class='w3-text-red'> *</span><br>";
        }   
      }
    }

    // Data de Reserva
    $d = $_POST['data_reserva'];

    if ($d == "")
      $err .= "- Data de Reserva <span class='w3-text-red'> *</span><br>";
    else{
      $date_array=explode('/',trim($d));
      $data_reserva=strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].'-00'); 
    }
    
    // Hora de Reserva

    $horas = trim($_POST['hora_reserva']); 
    
    if ($horas == ""){
      
      $hrs = strtotime($date_array[2].'-'.$date_array[1].'-'.$date_array[0].' '.$horas);
    }
    else
    {
        $hrs = $data_reserva;
    }

    $carro_id = $_POST['carro_id'];

    if ($carro_id == "")
    {
        $err .= "- Nome do Carro <span class='w3-text-red'> * </span><br>"; 
    }

    $observacao = $_POST['observacao'];
    
    if ($observacao == '')
    {
        $observacao = '-/-';
    }

    

    if (!$err) 
    {

        $sql =" INSERT INTO reserva (nome, pais, email, telefone, data_reserva, hora_reserva, carro, observacoes) VALUES ('$nome','$pais','$email', $telefone, $data_reserva, $hrs, $carro_id, '$observacao')";
        	
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

        $r=array('error'=>'','success' => $response,'id' => $last_id, 'email' => $email);
        echo json_encode($r);

        $sql = mysqli_query($conn, "SELECT nome_carro FROM carros WHERE id='$carro_id'");

        $exibe = mysqli_fetch_assoc($sql);
        $carro_nome = $exibe['nome_carro']; 
        
        $html = '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
.title-black-white {
    background: RGB(12,12,12);
    color: #FFF!important;
}
.right {
    float: right;
    width: 68px;
    position: absolute;
    padding: 10px;
  }
  .botm
  {
    margin-bottom: 40px;
  }
  .center {
    display: block;
    margin-left: 280px;
    margin-right: 280px;
    right: 100px;
  }
  .line-bord {
    border: 1px solid RGB(12,12,12);
}
.mylabel {
    color: #333;
    background: #FFC107 !important;
}
.align_div {
    margin-bottom: 15px;
}
.w3-padding-8 {
    padding-top: 8px!important;
    padding-bottom: 8px!important;
}
.w3-card-2, .w3-example {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
}
.bolder
{
    font-weight:bold;
}
</style>

<img src="'.$img1.'" class="center">
<div class="botm"></div>
<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva '.$last_id.'</h3>
<div class="botm"></div>
<div class="line-bord">
<img src="'.$img_title.'" class="right">
<div class="modal-header title-black-white">
    <h4 class="modal-title bolder" style="color: #fff;"><img src="'.$img_reserva.'" class="img-responsive"> Reserva Numero '.$last_id.'</h4> 
</div>
<div class="form-horizontal" id="form">
<div class="panel-body" style="padding: 16px; margin-top: -10px;">
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_logo.'" class="img-responsive">&nbsp;&nbsp;Detalhes Pessoais
</h5>
<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Nome da Pessoa:</font> '.$nome.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Pais:</font> '.$pais.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Email:</font> '.$email.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Telefone:</font> '.$telefone.'
</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_res.'" class="img-responsive">&nbsp;&nbsp;Marcação da Reserva
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Data de Reserva:</font> '.$d.'
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Hora de Reserva:</font> '.$horas.'
</div>
</div>


<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Nome do Carro:</font> '.$carro_nome.'
</div>
</div>

</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="'.$img_com.'" class="img-responsive">&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Comentarios Finais:</font> '.$observacao.'
</div>
</div>


</div>
</div>


</div>
</div>






</div>
</div>

</div>

<br>
Cumprimentos
<br>
Ricardo Peleira - Gerente da Toyota Rental Cars LDA

';

include $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/mpdf/mpdf.php';

    $mpdf=new mPDF();
    $mpdf->WriteHTML($html);

    $pdfdoc = $mpdf->Output("", "S");
    $attachment = chunk_split(base64_encode($pdfdoc));

    $separator = md5(time());
    $eol = PHP_EOL;

    $attachment = chunk_split(base64_encode($pdfdoc));
    $filename = "Reserva - ".$last_id." .pdf";

    $to = "r.peleira@hotmail.com";

        $headers  = "From: ".$to.$eol;
        $headers .= "MIME-Version: 1.0".$eol; 
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

        $info_client =
        "<div style='width:95%; margin-left:2.5%;'>
        <h4>Foi Mandado o seguinte PDF as informacoes da reserva alterada $nome com o email $email</h4>
        </div>";

        $info_c = utf8_decode("Boas $email, os detalhes foram enviados com sucesso");

        $body_c = "--".$separator.$eol;
        $body_c .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
        $body_c .= $eol;

        $body_c .= "--".$separator.$eol;
        $body_c .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
        $body_c .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $body_c .= $info_server.$eol;
        $body_c .= "--".$separator.$eol;
        $body_c .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
        $body_c .= "Content-Transfer-Encoding: base64".$eol;
        $body_c .= "Content-Disposition: attachment".$eol.$eol;
        $body_c .= $attachment.$eol;
        $body_c .= "--".$separator."--";

        mail($email,$info_c,$body_c,$headers);
        

        
    }
    else
    {
        $r = array('error' =>$err, 'success' =>'','id' =>'', 'email' => $email);
        echo json_encode($r);
    }

    






    


    break;

    case '6':

    $obter_comp=" SELECT reserva.nome, reserva.pais, reserva.email, reserva.telefone, reserva.data_reserva, reserva.hora_reserva, carros.nome_carro, carros.img, reserva.observacoes FROM reserva INNER JOIN carros ON reserva.carro = carros.id";
    $result = mysqli_query($conn, $obter_comp);
    while($obj = mysqli_fetch_object($result)) {
    $var[] = $obj;}
    echo json_encode($var);

    break;


}


