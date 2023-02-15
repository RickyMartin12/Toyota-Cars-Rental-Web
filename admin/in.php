<?php



require_once $_SERVER['DOCUMENT_ROOT'] . "/TCPDF/tcpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] .  "/PHPmailer/vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();


$img = $_SERVER['DOCUMENT_ROOT']."/logo/toyota.jpg";

$agenda = $_SERVER['DOCUMENT_ROOT']."/icons/agenda.jpg";

$comment = $_SERVER['DOCUMENT_ROOT']."/icons/comment.jpg";

$open_book = $_SERVER['DOCUMENT_ROOT']."/icons/open_book.jpg";

$user = $_SERVER['DOCUMENT_ROOT']."/icons/user.jpg";


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
	font-size: 18px;
}
</style>

<br>

<br>
<table border="0" cellspacing="3" cellpadding="4">
    <tr>
        <th align="center"><img src="'.$img .'" class="center"></th>  
    </tr>

</table>





<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva 1</h3>
<div class="botm"></div>
<div class="line-bord">
<div class="modal-header title-black-white">
    <div class="modal-title bolder" >
	
	<table border="0">
		<tr>
			<th align="left"><img src="'.$agenda .'" width="50">&nbsp;&nbsp;Reserva Numero 1</th>
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
&nbsp;&nbsp;<font class="bolder">&nbsp;&nbsp;Nome da Pessoa:</font> Ricardo Peleira
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Pais:</font> Portugal
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Email:</font> r.peleira@hotmail.com
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder" >&nbsp;&nbsp;&nbsp;&nbsp;Telefone:</font> 963354089
</div>

<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$open_book.'" class="img-responsive" width="20">&nbsp;&nbsp;Marcação da Reserva
</h5>

<br>
<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Data de Reserva:</font> 17/04/2019
</div>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Hora de Reserva:</font> 12:25
</div>

<br>
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
&nbsp;&nbsp;<img src="'.$comment.'" class="img-responsive" width="20">&nbsp;&nbsp;Comentarios Finais
</h5>

<div class="col-xs-12 col-md-6">
<font class="bolder">&nbsp;&nbsp;&nbsp;&nbsp;Comentarios Finais:</font> 
cewweew
falseweff
ww
efwe

few





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

//Close and output PDF document
$attachment = $pdf->Output('reserva.pdf','S');


$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'postmaster@sandboxe2313ce239e048f4a30fabd8f01bc24b.mailgun.org'; // SMTP username from https://mailgun.com/cp/domains
    $mail->Password = '2d14e569b59a0eabd9f3617002be0dda-73e57fef-1b7ca089'; // SMTP password from https://mailgun.com/cp/domains
    $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
            $mail->Port= '587';

    $mail->From = 'postmaster@sandboxe2313ce239e048f4a30fabd8f01bc24b.mailgun.org'; // The FROM field, the address sending the email 
    $mail->FromName = 'Enquiry bot'; // The NAME field which will be displayed on arrival by the email client
    $mail->addAddress('ricardopeleira16@gmail.com');     // Recipient's email address and optionally a name to identify him
    $mail->isHTML(true);

$mail->Subject = "aa de Informações";
$mail->Body = "ola";
$mail->AltBody = "This is the plain text version of the email content";
$mail->AddStringAttachment($attachment, 'reserva.pdf', 'base64', 'application/pdf');

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