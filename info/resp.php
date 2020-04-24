<?php



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

$to = 'r.peleira@hotmail.com';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From:' .$to. "\r\n";

$email_subject = "Pedido de Informações";

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



mail($to,$email_subject,$email_body_supplier,$headers);
mail($email,$email_subject,$email_body_client,$headers);



}





echo $error_message;







          
?>