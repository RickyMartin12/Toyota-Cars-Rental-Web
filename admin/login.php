<?php

define('ROOTDIR', dirname(__FILE__));

session_start();

    require ROOTDIR . "/request/nocsrf.php";
    $token = NoCSRF::generate( 'csrf_token' );

?>

<!doctype html>
<html lang="pt_PT">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">

    <title>Login de Gestão do TOYOTA_RENT_CAR</title>
</head>


<body class="bgimg-1" style="background:#fff url(images/teste1.png) no-repeat center 0px;">

<div class="back">
    <div class="load"></div>
</div>

  <!-- Contact Section -->
<div class="w3-padding-16 w3-content w3-text-black" id="contact">

<div class="w3-row-padding w3-center w3-margin-top">

<div class="w3-col l3 m2 s0">&nbsp;</div>

<div class="w3-col l6 m8 s12 w3-card-2" style="background:rgba(255,255,255,0.65);">

<div class="w3-col l12 m12 s12">
    <div class="w3-center w3-padding-16">
    <img class="w3-image logo_insert" style="max-width:130px; vertical-align: text-top;">
    
</div>
<div class="w3-col l12 m12 s12" style="margin-bottom: 20px">
     <span class="nome_txt "></span>
    <br>
     <span class="morada_txt"></span>
</div>
</div>
<!--
<div class="w3-col l8 m7 s12 w3-center">
    <p><span class="w3-large w3-text-black w3-margin-right nome_txt"></span></p>
    <p class="morada_txt"></p><br>
</div>
-->

<div class="w3-col l12" style="margin-bottom: -20px; margin-top: -10px;">
    <div class="w3-light-grey" style="height:23px;">
      <div id="myBar" class="w3-container w3-center w3-red" style="height:23px;width:0px;">0%</div>
    </div><br>
</div>

<div class="freeform w3-col l12">
    <span  title="Periodo para validar os dados são 4 minutos, se expirar tem que actualizar a página (tecla F5)" class="w3-center w3-large">Login de Administracao</span>
    <form class="form-signin">
      <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
      <p><input readonly title="Insira Utilizador" class="w3-input w3-padding-8 w3-border" type="text" id="utilizador" placeholder="Utilizador *" name="utilizador" autofocus></p>
      <p><input readonly title="Insira Password" class="w3-input w3-padding-8 w3-border" type="password" id="password" placeholder="Password *" name="password"></p>
      
     <div class="w3-row w3-padding-16">
     <div class="w3-col s1">&nbsp;</div>
     <div class="w3-col s4">
        <button title="Limpar campos Utilizador e Password "class="w3-button btn w3-sand w3-medium" disabled type="reset" style="border-radius: 0px!important;">
           <i class="fa fa-eraser"></i><span class="w3-hide-small"> Limpar</span>
        </button>
      </div>

      <button id="myButton" class="w3-button btn w3-center w3-red" disabled type="submit" style="border-radius: 0px!important;">
           0%
      </button>
      </div>     
    </form>
  </div>
    </div>
    </div>
  </div>  

    <p class="w3-center w3-text-white">
        <?php if (isset($error) && !empty($error)) {echo $error;}?>
    </p>


    </div>

<div id="showerrors" class="w3-modal" style="display: none;">
  <div class="w3-modal-content w3-animate-zoom" style="max-width:600px;">
    <div class="w3-container header w3-amber">
      <span onclick="document.getElementById('showerrors').style.display='none'" class="w3-button w3-display-topright w3-medium">x</span>
      <h3 class="messagehead"></h3>
    </div>
    <div class="w3-container w3-padding-16">
        <p class="messagetxt"></p>
        <p></p>
    </div>
  </div>
</div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/shopinfo.js"></script>
<script src="js/canvas-video-player.js"></script>


<script>
shopDefinitions();




function move() {


      arr = JSON.parse(localStorage.getItem("shopDef"));
      $('.logo_insert').prop('src','definitions/'+arr[0].logo);
      $('.logo_insert').addClass('w3-animate-zoom');
      $('.nome_txt').html('<strong>Nome:</strong> ' + arr[0].nome);
      $('.nome_txt').addClass('w3-animate-right');
      $('.morada_txt').html('<strong>Morada:</strong> ' + arr[0].morada);
      $('.morada_txt').addClass('w3-animate-left');
      
      

  var elem = document.getElementById("myBar");   
  var button = document.getElementById("myButton");   
  var width = 5;
  var id = setInterval(frame, 100);
  function frame() {
  if (width == 100) {
      clearInterval(id);
      $('#myBar').removeClass('w3-red').addClass('w3-light-green');
      $('#myButton').removeClass('w3-red').addClass('w3-green');
      $('.freeform').removeClass('w3-opacity'); 
      $('.w3-button').attr('disabled',false);
      $('.w3-input').attr('readonly',false);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
      button.innerHTML = width * 1  + '%';
      
      if (button.innerHTML == "100%")
      {
        button.innerHTML='<i class="fa fa-check"></i><span class="w3-hide-small"> Submeter</span>';
      }

    }
  }
}

$(".form-signin").on("submit", function(e) {
    $('.back').show()
    e.preventDefault();
    datav=$(this).serialize();
    $.ajax({
        type: "POST",
        url: "request/login.php",
        data: datav,
        cache: false,
        success: function(data) {
          $('.back').fadeOut();
          console.log(data);
          obj = JSON.parse(data);
          if (obj.error){
            $('#showerrors .header').addClass('w3-amber').removeClass('w3-green w3-red')
            $('#showerrors').css('display','block')
            $('.messagehead').text('Por favor, verifique:')
            $('.messagetxt').html(obj.error)
          }
          else if (obj.success){
            $('#showerrors .header').addClass('w3-green').removeClass('w3-red w3-amber')
            $('#showerrors').css('display','block')
            $('.messagehead').text('Sucesso') 
            $('.messagetxt').html('Bem vindo '+$('#utilizador').val()+', a redireccionar ...');
            setTimeout(function(){
              location.href = "/"+obj.success;
            }, 1500);
          }
        },
        error: function() {
           $('.back').fadeOut()
           $('#showerrors .header').addClass('w3-red').removeClass('w3-green w3-amber')
           $('#showerrors').css('display','block')
           $('.messagehead').text('Aviso')
           $('.messagetxt').html('Verifique a ligação, e tente novamente!')
        }
    })
});



  </script>
  
  
  

  

</body>
</html>