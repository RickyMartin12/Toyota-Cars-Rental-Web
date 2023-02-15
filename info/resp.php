<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] .  "/PHPmailer/vendor/autoload.php";


$error_message = '';


$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 



if ($nome == '')
{
  $error_message .= '<p> - Nome *</p>';
}
if ($email == '')
{
  $error_message .= '<p> - Email *</p>';
}
if ($email != '')
{

  if (!preg_match($regex, $email )) {
    $error_message .= " <p> - ".$email." is not valid </p>";
  }
}



if ($mensagem == '')
{
  $error_message .= '<p> - Mensagem *</p>';
  
}






if ($error_message == '')
{


echo 0;

$to = 'ricardopeleira16@gmail.com';

$email_body_supplier =
"<div style='width:95%; margin-left:2.5%;'>
<h4>Foram pedidas as seguintes informações (pt-PT):</h4>
<hr><b> Name :</b> $nome<br /><br />
<b> Email:</b> $email<br /><br/>
<b> Message:</b> $mensagem<br /><hr>
</div>";

$email_body_client = "<div style='width:95%; margin-left:2.5%;'>
<h4> Pedido de informações submetido, em breve receberá a informação pretendida.</h4>
<hr><b>Name: </b> $nome<br /><br />
<b>Email: </b> $email<br /><br/>
<b>Message: </b> $mensagem<br />
<hr>
<br>Obrigado $nome, Toyota Rental Cars Lda.
</div>";

$mail = new PHPMailer(true);

    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify mailgun SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'ricardopeleira16@gmail.com'; // SMTP username from https://mailgun.com/cp/domains
    $mail->Password = 'npgnxhymkcxeoobc'; // SMTP password from https://mailgun.com/cp/domains
    $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
            $mail->Port= '587';

    $mail->From = 'ricardopeleira16@gmail.com'; // The FROM field, the address sending the email 
    $mail->FromName = 'Pedido de Informacoes'; // The NAME field which will be displayed on arrival by the email client
    $mail->addAddress($email);     // Recipient's email address and optionally a name to identify him
    $mail->isHTML(true);

$mail->Subject = "Pedido de Informacoes";
$mail->Body = $email_body_supplier;
$mail->send();

/*

$mail_server = new PHPMailer(true);

    $mail_server->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify mailgun SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'ricardopeleira16@gmail.com'; // SMTP username from https://mailgun.com/cp/domains
    $mail->Password = 'npgnxhymkcxeoobc'; // SMTP password from https://mailgun.com/cp/domains
    $mail_server->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
    $mail->Port= '587';

    $mail_server->From = 'ricardopeleira16@gmail.com'; // The FROM field, the address sending the email 
    $mail_server->FromName = 'Pedido de Informações'; // The NAME field which will be displayed on arrival by the email client
    $mail_server->addAddress($email);     // Recipient's email address and optionally a name to identify him
    $mail_server->isHTML(true);

$mail_server->Subject = "Pedido de Informações - Cliente";
$mail_server->Body = $email_body_client;
$mail_server->send();

*/
}





echo $error_message;







          
?>