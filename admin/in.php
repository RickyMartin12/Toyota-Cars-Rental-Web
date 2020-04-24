<?php

include $_SERVER['DOCUMENT_ROOT'] . '/carros_toyota_reserva/mpdf/mpdf.php';


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

<img src="../logo/toyotaCarsRental.png" class="center">
<div class="botm"></div>
<h3 style="text-align: center;" class="bolder"> Toyota Cars Rental - Conteudo da Reserva 1</h3>
<div class="botm"></div>
<div class="line-bord">
<img src="definitions/upload/logo1.png" class="right">
<div class="modal-header title-black-white">
    <h4 class="modal-title bolder" style="color: #fff;"><img src="../icons/agenda.svg" class="img-responsive"> Reserva Numero 1</h4> 
</div>
<div class="form-horizontal" id="form">
<div class="panel-body" style="padding: 16px; margin-top: -10px;">
<h5 class="col-xs-12 mylabel w3-padding-8 w3-card-2 align_div bolder"> 
<img src="../icons/user.png" class="img-responsive">&nbsp;&nbsp;Detalhes Pessoais
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
<img src="../icons/open-book.png" class="img-responsive">&nbsp;&nbsp;Marcação da Reserva
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
<img src="../icons/com.png" class="img-responsive">&nbsp;&nbsp;Comentarios Finais
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

$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();