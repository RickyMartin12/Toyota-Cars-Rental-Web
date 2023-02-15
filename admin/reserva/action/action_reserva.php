<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/connect.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/TCPDF/tcpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] .  "/PHPmailer/vendor/autoload.php";


$img = $_SERVER['DOCUMENT_ROOT']."/logo/toyota.jpg";

$agenda = $_SERVER['DOCUMENT_ROOT']."/icons/agenda.jpg";

$comment = $_SERVER['DOCUMENT_ROOT']."/icons/comment.jpg";

$open_book = $_SERVER['DOCUMENT_ROOT']."/icons/open_book.jpg";

$user = $_SERVER['DOCUMENT_ROOT']."/icons/user.jpg";


switch ($_POST['action']){

  
    case '1':
    
    // NIF

    $nome = $_POST['nome'];
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

    $result = mysqli_query($conn,$sql);
    if ($result)
    {
        echo 1;
    }
        
    else  
    {
        echo 0;
    }

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();


    $html = '

<style>
.title-black-white {
    background-color: #222;
    color: #FFF;
}
.right {
    float: right;
    width: 68px;
    position: relative;
    padding: 10px;
  }
  .botm
  {
    margin-bottom: 40px;
  }
  .center {
    display: block;
  float: right;
  width: 100px;
  }
  .line-bord {
    border: 1px solid RGB(12,12,12);
}
.mylabel {
    color: #333;
    background-color: #FFC107;
	font-weight: bold;
	font-size: 14px;
}
.w3-padding-8 {
    padding-top: 8px;
    padding-bottom: 8px;
}
.w3-card-2, .w3-example {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
}
.bolder
{
    font-weight:bold;
	
}
.modal-title
{
	font-size: 15px;
}
</style>

<br>

<br>
<table border="0" cellspacing="3" cellpadding="4">
    <tr>
        <th align="center"><img src="'.$img .'" class="center"></th>  
    </tr>

</table>





<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva '.$id.'</h3>
<div class="botm"></div>
<div class="line-bord">
<div class="modal-header title-black-white">
    <div class="modal-title bolder" >
	
	<table border="0">
		<tr>
			<th align="left"><img src="'.$agenda .'" width="50">&nbsp;&nbsp;Reserva Numero '.$id.'</th>
			<th align="right"><img src="'.$img .'" class="right"></th>  
		</tr>

	</table>
	
	</div> 
</div>

<h5 class="mylabel"> 
&nbsp;&nbsp;<img src="'.$user.'" class="img-responsive" width="20">&nbsp;&nbsp;&nbsp;Detalhes Pessoais
</h5>

<br>
<div class="col-xs-12 col-md-6">
&nbsp;&nbsp;<font class="bolder">&nbsp;&nbsp;Nome da Pessoa:</font> '.$nome.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Pais:</font> '.$pais.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Email:</font> '.$email.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Telefone:</font> '.$telefone.'
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$open_book.'" class="img-responsive" width="20">&nbsp;&nbsp;Marcação da Reserva
</h5>

<br>
<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Data de Reserva:</font> '.$data_reserva.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Hora de Reserva:</font> '.$hora_reserva.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Nome do Carro:</font> '.$carro_nome.'
</div>


<br>
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$comment.'" class="img-responsive" width="20">&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Comentarios Finais:</font> '.$observacao.'




</div>







</div>
</div>

</div>

<br>
Cumprimentos
<br>
Ricardo Peleira - Gerente da Toyota Rental Cars LDA

';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// ---------------------------------------------------------


$filename = "Reserva - ".$id." .pdf";
//Close and output PDF document
$attachment = $pdf->Output($filename,'S');


    $reserva_edit =
        "<div style='width:95%; margin-left:2.5%;'>
        <h4>Foi Mandado o seguinte PDF as informacoes da reserva alterada $nome com o email $email</h4>
        </div>";







        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify mailgun SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'ricardopeleira16@gmail.com'; // SMTP username from https://mailgun.com/cp/domains
        $mail->Password = 'npgnxhymkcxeoobc'; // SMTP password from https://mailgun.com/cp/domains
        $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
                $mail->Port= '587';
    
        $mail->From = 'ricardopeleira16@gmail.com'; // The FROM field, the address sending the email 
        $mail->FromName = "Detalhes da Reserva número ".$id; // The NAME field which will be displayed on arrival by the email client
            $mail->addAddress($email);     // Recipient's email address and optionally a name to identify him
            $mail->isHTML(true);

        $mail->Subject = "Boas $email, os detalhes foram enviados com sucesso";
        $mail->Body = $reserva_edit;
        $mail->AltBody = "Detalhes da Reserva número ".$id;
        $mail->AddStringAttachment($attachment, $filename, 'base64', 'application/pdf');
        $mail->send();






    



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
    
    if ($_POST['hora_reserva']){
      $horas = trim($_POST['hora_reserva']); 
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

        $sql_nome_carro = mysqli_query($conn, "SELECT nome_carro FROM carros WHERE id='$carro_id'");

        $exibe = mysqli_fetch_assoc($sql_nome_carro);
        $carro_nome = $exibe['nome_carro']; 

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        $html = '

<style>
.title-black-white {
    background-color: #222;
    color: #FFF;
}
.right {
    float: right;
    width: 68px;
    position: relative;
    padding: 10px;
  }
  .botm
  {
    margin-bottom: 40px;
  }
  .center {
    display: block;
  float: right;
  width: 100px;
  }
  .line-bord {
    border: 1px solid RGB(12,12,12);
}
.mylabel {
    color: #333;
    background-color: #FFC107;
	font-weight: bold;
	font-size: 14px;
}
.w3-padding-8 {
    padding-top: 8px;
    padding-bottom: 8px;
}
.w3-card-2, .w3-example {
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
}
.bolder
{
    font-weight:bold;
	
}
.modal-title
{
	font-size: 15px;
}
</style>

<br>

<br>
<table border="0" cellspacing="3" cellpadding="4">
    <tr>
        <th align="center"><img src="'.$img .'" class="center"></th>  
    </tr>

</table>





<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva '.$last_id.'</h3>
<div class="botm"></div>
<div class="line-bord">
<div class="modal-header title-black-white">
    <div class="modal-title bolder" >
	
	<table border="0">
		<tr>
			<th align="left"><img src="'.$agenda .'" width="50">&nbsp;&nbsp;Reserva Numero '.$last_id.'</th>
			<th align="right"><img src="'.$img .'" class="right"></th>  
		</tr>

	</table>
	
	</div> 
</div>

<h5 class="mylabel"> 
&nbsp;&nbsp;<img src="'.$user.'" class="img-responsive" width="20">&nbsp;&nbsp;&nbsp;Detalhes Pessoais
</h5>

<br>
<div class="col-xs-12 col-md-6">
&nbsp;&nbsp;<font class="bolder">&nbsp;&nbsp;Nome da Pessoa:</font> '.$nome.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Pais:</font> '.$pais.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Email:</font> '.$email.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Telefone:</font> '.$telefone.'
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$open_book.'" class="img-responsive" width="20">&nbsp;&nbsp;Marcação da Reserva
</h5>

<br>
<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Data de Reserva:</font> '.$d.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Hora de Reserva:</font> '.$horas.'
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Nome do Carro:</font> '.$carro_nome.'
</div>


<br>
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$comment.'" class="img-responsive" width="20">&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Comentarios Finais:</font> '.$observacao.'




</div>







</div>
</div>

</div>

<br>
Cumprimentos
<br>
Ricardo Peleira - Gerente da Toyota Rental Cars LDA

';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');



// ---------------------------------------------------------


$filename = "Reserva - ".$last_id." .pdf";
//Close and output PDF document
$attachment = $pdf->Output($filename,'S');




        $body_text = '<div style="width:95%; margin-left:2.5%;">
        <h4>Foi adicionado as seguintes informacoes da reserva '.$nome.' com o email '.$email.'</h4>
        </div>';



        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify mailgun SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'ricardopeleira16@gmail.com'; // SMTP username from https://mailgun.com/cp/domains
        $mail->Password = 'npgnxhymkcxeoobc'; // SMTP password from https://mailgun.com/cp/domains
        $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
                $mail->Port= '587';
    
        $mail->From = 'ricardopeleira16@gmail.com'; // The FROM field, the address sending the email 
        $mail->FromName = "Detalhes da Reserva número ".$last_id; // The NAME field which will be displayed on arrival by the email client
            $mail->addAddress($email);     // Recipient's email address and optionally a name to identify him
            $mail->isHTML(true);

        $mail->Subject = "Boas $email, os detalhes foram enviados com sucesso";
        $mail->Body = $body_text;
        $mail->AltBody = "Detalhes da Reserva número ".$last_id;
        $mail->AddStringAttachment($attachment, $filename, 'base64', 'application/pdf');
        $mail->send();
        
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


