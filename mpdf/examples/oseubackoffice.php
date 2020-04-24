<?php

$voucher = '1754';
$logo_empresa = 'logo_oseubackoffice';
$nome_cliente = 'Mr. John McDonald';
$mail_cliente = 'j.mcdonald@gmail.co.uk';
$tel_cliente = '+44 215 478 800';
$num_quartos = '-/-';
$pais = '-/-';
$chegada_de = 'FARO AIRPORT';
$chegada_morada_de = 'Aeroporto de Faro - Aeroporto Internacional do Algarve';
$chegada_morada_para = 'Hotel Balaia Atlântico, Rua do Jerónimo, nº2';
$chegada_para = 'ALBUFEIRA';
$chegada_data = '15/06/2017';
$chegada_voo = 'FR1234';
$chegada_hora = '10:25';
$chegada_adultos = '2';
$chegada_criancas = '2';
$chegada_bebes = '1';
$partida_adultos = '2';
$partida_criancas = '2';
$partida_bebes = '1';
$partida_para = 'FARO AIRPORT';
$partida_morada_de = 'Hotel Balaia Atlântico, Rua do Jerónimo, nº2';
$partida_morada_para = 'Aeroporto de Faro - Aeroporto Internacional do Algarve';
$partida_cidade = 'ALBUFEIRA';
$partida_de = 'ALBUFEIRA';
$partida_data = '23/06/2017';
$partida_voo = 'FR1235';
$partida_hora = '08:45';
$partida_observ = 'Bagagem 2 malas + uma cadeira de bébé.';
$chegada_observ = 'Bagagem 20 malas + 80 cadeiras de bébé.';
$chegada_distancia = '35';
$chegada_duracao = '35';
$partida_distancia = '35';
$partida_duracao = '35';
$preco = '60,00';
$metodo_pagamento = 'Pagar ao motorista';
$metodo_pagamento_en = 'Pay to the Driver';
$NIF_empresa = '510 963 852';
$morada_empresa = 'Estrada de Santa Eulália, Lote 7, 8200-000 Albufeira';
$RNAVT_empresa = '1234';
$nome_empresa = 'Neurónios Acelerados Unipessoal, Lda.';
$telefone_empresa = '289 100 200';
$tlm_empresa = '963 852 741';
$email_empresa = 'mail@sitedoempresa.com';
$site_empresa = 'sitedoempresa.com';
$comentarios = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';

$html ='<link rel="stylesheet" href="w3.css">
<body style="background: #fff">


<div class="sbs-pdf1000 w3-cinza" style="height:80px">
<div class="sbs-pdf50 w3-cinza">&nbsp;</div>
    <div class="sbs-pdf350">
        <img src="images/'.$logo_empresa.'.png" style="padding-top:10px!important;" alt="Logo">
    </div>
    <div class="sbs-pdf200 w3-cinza">&nbsp;</div>
    <div class="sbs-pdf350 w3-cinza w3-center">&nbsp;
        <div class="w3-laranja1" style="margin-top:13px!important">
            <h4 style="font-size:16px">&nbsp;Voucher ID: '.$voucher.'</h4>
        </div>
    </div>
    <div class="sbs-pdf50 w3-cinza">&nbsp;</div>
</div>


<div class="sbs-pdf1000 w3-white">
    <div class="sbs-pdf700 w3-left w3-left-align">
        &nbsp;<br>
        <span style="font-size:16px">Nome / </span><span style="font-size:12px; font-style: italic">Name: </span><span style="font-size:16px"><strong>'.$nome_cliente.'</strong></span><br>
        <span style="font-size:16px">Email: </span><span style="font-size:15px"><strong>'.$mail_cliente.'</strong></span><br>
        <span style="font-size:16px">Contacto / </span><span style="font-size:12px; font-style: italic">Contact:</span> <span style="font-size:15px"><strong>'.$tel_cliente.'</strong></span><br>
        &nbsp;
    </div>
    <div class="sbs-pdf300 w3-right w3-right-align" style="padding-top:8px!important">
        &nbsp;<br>
        &nbsp;<br>
        <span style="font-size:13px;">Nº Quarto / </span><span style="font-size:11px; font-style: italic">Room Number: </span><span style="font-size:13px"><strong>'.$num_quartos.'</strong></span><br>
        <span style="font-size:13px">País / </span><span style="font-size:11px; font-style: italic">Country: </span><span style="font-size:13px"><strong>'.$pais.'</strong></span><br>
    </div>
</div>

<div class="sbs-pdf1000 w3-laranja1 w3-center" style="padding:15px!important">
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf250" style="height:50px;padding-top:15px!important">
        <span style="text-transform:uppercase;font-size:16px"><strong>'.$partida_de.'</strong></span><br>
        <span style="font-size:8px">'.$partida_morada_de.'</span>
    </div>
    <div class="sbs-pdf175"><span style="font-size:35px">➜</span></div>
    <div class="sbs-pdf250" style="height:50px;padding-top:15px!important">
        <span style="text-transform:uppercase;font-size:16px"><strong>'.$partida_para.'</strong></span><br>
        <span style="font-size:8px">'.$partida_morada_para.'</span>
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon1.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$partida_adultos.'</strong></span>
        </div>
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon2.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$partida_criancas.'</strong></span>
        </div>   
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon3.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$partida_bebes.'</strong></span>
        </div>
    </div>
    <div class="sbs-pdf50">&nbsp;</div>
</div>

<div class="sbs-pdf1000 w3-cinza w3-center" style="padding:5px!important">
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>PARTIDA /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Departure</span><br>
        <span style="font-size:20px"><strong>'.$partida_data.'</strong></span><br>
    </div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>HORA /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Time</span><br>
        <span style="font-size:20px"><strong>'.$partida_hora.'</strong></span><br>      
    </div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>VOO /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Flight</span><br>
        <span style="font-size:20px"><strong>'.$partida_voo.'</strong></span><br>
    </div>
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf1000 w3-left w3-left-align">
        <span style="font-size:13px"><strong>&nbsp;OBSERVAÇÕES /</strong></span><span style="font-size:11px; font-style: italic">&nbsp;Comments:</span><span style="font-size:13px">&nbsp;<strong>'.$partida_observ.'</strong></span>
    </div>
</div>

<div class="sbs-pdf1000 w3-cinza-escuro w3-center" style="padding-top:15px!important; padding-bottom:15px!important">
    <span style="font-size:16px"><strong>PAGAMENTO /</strong></span><span style="font-size:13px; font-style: italic">&nbsp;Payment:</span><span style="font-size:16px"><strong>&nbsp;'.$preco.' €</strong></span> - <span style="font-size:16px"><strong>'.$metodo_pagamento.' /</strong></span><span style="font-size:13px; font-style: italic">&nbsp;'.$metodo_pagamento_en.'</span>
</div>

<div class="sbs-pdf1000 w3-white">&nbsp;</div>

<div class="sbs-pdf1000 w3-laranja1 w3-center" style="padding:15px!important">
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf250" style="height:50px;padding-top:15px!important">
        <span style="text-transform:uppercase;font-size:16px"><strong>'.$chegada_de.'</strong></span><br>
        <span style="font-size:8px">'.$chegada_morada_de.'</span>
    </div>
    <div class="sbs-pdf175"><span style="font-size:35px">➜</span></div>
    <div class="sbs-pdf250" style="height:50px;padding-top:15px!important">
        <span style="text-transform:uppercase;font-size:16px"><strong>'.$chegada_para.'</strong></span><br>
        <span style="font-size:8px">'.$chegada_morada_para.'</span>
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon1.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$chegada_adultos.'</strong></span>
        </div>
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon2.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$chegada_criancas.'</strong></span>
        </div>   
    </div>
    <div class="sbs-pdf75">
        <div style="line-height:50px;padding-top:5px!important">
            <img src="images/icon3.png" alt="Icons"><span style="font-size:16px; color:#000">&nbsp;<strong>'.$chegada_bebes.'</strong></span>
        </div>
    </div>
    <div class="sbs-pdf50">&nbsp;</div>
</div>

<div class="sbs-pdf1000 w3-cinza w3-center" style="padding:5px!important">
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>PARTIDA /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Departure</span><br>
        <span style="font-size:20px"><strong>'.$chegada_data.'</strong></span><br>
    </div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>HORA /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Time</span><br>
        <span style="font-size:20px"><strong>'.$chegada_hora.'</strong></span><br>      
    </div>
    <div class="sbs-pdf300" style="padding-top:15px!important; padding-bottom:15px!important">
        <span style="color:#fff;font-size:16px"><strong>VOO /</strong></span><span style="color:#fff;font-size:12px; font-style: italic">&nbsp;Flight</span><br>
        <span style="font-size:20px"><strong>'.$chegada_voo.'</strong></span><br>
    </div>
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf1000 w3-left w3-left-align">
        <span style="font-size:13px"><strong>&nbsp;OBSERVAÇÕES /</strong></span><span style="font-size:11px; font-style: italic">&nbsp;Comments:</span><span style="font-size:13px">&nbsp;<strong>'.$chegada_observ.'</strong></span>
    </div>
</div>

<div class="sbs-pdf1000 w3-cinza-escuro w3-center" style="padding-top:15px!important; padding-bottom:15px!important">
    <span style="font-size:16px"><strong>PAGAMENTO /</strong></span><span style="font-size:13px; font-style: italic">&nbsp;Payment:</span><span style="font-size:16px"><strong>&nbsp;'.$preco.' €</strong></span> - <span style="font-size:16px"><strong>'.$metodo_pagamento.' /</strong></span><span style="font-size:13px; font-style: italic">&nbsp;'.$metodo_pagamento_en.'</span>
</div>

<div class="sbs-pdf1000 w3-white" style="padding:-7px 0px -7px 0px!important">&nbsp;</div>

<div class="sbs-pdf1000 w3-laranja2" style="border: 1px solid #000; padding-bottom:15px!important">
    <div class="sbs-pdf50">&nbsp;</div>
    <div class="sbs-pdf900">
    <span style="font-size:13px"><strong>RECOMENDAÇÕES /</strong></span><span style="font-size:11px; font-style:italic">&nbsp;<strong>Recommendations:</strong></span>&nbsp;<span style="font-size:10px; font-style:italic">'.$comentarios.'</span></div>
    <div class="sbs-pdf50">&nbsp;</div>
</div>

<div class="sbs-pdf1000 w3-white" style="padding:-7px 0px -7px 0px!important">&nbsp;</div>

<div class="sbs-pdf1000 w3-cinza w3-center" style="border-top: 1px solid #000; padding:5px!important">
    <span style="font-size:10px">'.$nome_empresa.' | NIF: '.$NIF_empresa.' | RNAVT: '.$RNAVT_empresa.'<br>
    '.$morada_empresa.' | TEL: '.$tel_empresa.' - TLM: '.$tlm_empresa.'<br>
    EMAIL: '.$email_empresa.' | URL: '.$site_empresa.'</span><br>
    <strong>Powered by:</strong> <img src="images/logotransfergest.png" style="padding-top:10px!important;" alt="Transfer Gest">
</div>


</body>';


//==============================================================
//==============================================================
//==============================================================

include("../mpdf.php");
$mpdf=new mPDF('utf-8', 'A4-P');
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>