<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->CharSet  ="utf-8";
$mail->SMTPDebug = SMTP::DEBUG_SERVER; // or 0 for no debuggin at all        
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
$mail->SMTPAuth   = true;
$mail->Username = 'jrodriguespeleira@gmail.com';
$mail->Password = 'benfica12';                     

$mail->From = "ricardopeleira16@gmail.com";
$mail->FromName = "Full Name";

$mail->addAddress("r.peleira@hotmail.com", "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "PHPmailer/vendor/autoload.php";

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
  margin-left: auto;
  margin-right: auto;
  width: 50%;
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

<img src="https://raw.githubusercontent.com/RickyMartin12/Toyota-Cars-Rental-Web/master/logo/toyotaCarsRental.png" class="center">
<div class="botm"></div>
<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva 1</h3>
<div class="botm"></div>
<div class="line-bord">

<div class="modal-header title-black-white">
    <h4 class="modal-title bolder" style="color: #fff;"> Reserva Numero 1</h4> 
</div>
<div class="form-horizontal" id="form">
<div class="panel-body" style="padding: 16px; margin-top: -10px;">
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;Detalhes Pessoais
</h5>
<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Nome da Pessoa:</font> Ricardo Peleira
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Pais:</font> Portugal
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Email:</font> r.peleira@hotmail.com
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder" >Telefone:</font> 963354089
</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;Marcação da Reserva
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Data de Reserva:</font> 17/04/2019
</div>
</div>

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Hora de Reserva:</font> 12:25
</div>
</div>

</div>
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="container">
<div class="row">

<div class="col-xs-12 col-md-6">
<div class="form-group">
<font class="bolder">Comentarios Finais:</font> Nenhum
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

$mail = new PHPMailer(true);

    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'ricardopeleira16@gmail.com'; // SMTP username from https://mailgun.com/cp/domains
        $mail->Password = 'npgnxhymkcxeoobc'; // SMTP password from https://mailgun.com/cp/domains
        $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
                $mail->Port= '587';

    $mail->From = 'ricardopeleira16@gmail.com'; // The FROM field, the address sending the email 
    $mail->FromName = 'Enquiry bot'; // The NAME field which will be displayed on arrival by the email client
    $mail->addAddress('r.peleira@hotmail.com');     // Recipient's email address and optionally a name to identify him
    $mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = $html;
$mail->AltBody = "This is the plain text version of the email content";

    if(!$mail->send())
    {  
        echo "Message hasn't been sent.";
        echo 'Mailer Error: ' . $mail->ErrorInfo . "\n";
    } 
    else 
    {
       echo "sucesso";
    }
?>