<?php
require("PHPMailer/class.phpmailer.php");



// Função que o email do servidor envia ao email do cliente que o cliente receba as informações no seu respectivo email



function ServersendtoClient()
{

	$mail = new PHPMailer();
	$mail->IsSMTP();  // -- erro no CPANEL, neste caso 
	$mail->Host = "smtp.live.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "r.peleira@hotmail.com";  // SMTP username
	$mail->Password = "readln"; // SMTP password
	$mail->SMTPSecure = 'tls'; 
	$mail->From = "r.peleira@hotmail.com";
	$mail->FromName = "Ricardo";
	$mail->AddAddress("11knum15@gmail.com", "Jessica Luis");
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = "aa";
	$mail->Body    = "aa";
	$mail->AltBody = "aa";
	$mail->Timeout = 20;
	!$mail->send() ? $mailsend = 0 : $mailsend = 1;
	return $mailsend;

}


// Envio da Informação para o Cliente

ServersendtoClient();






?>