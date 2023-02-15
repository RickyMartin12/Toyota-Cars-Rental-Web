<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');


require_once 'connect.php';


session_start();

var_dump($_COOKIE);

if(!isset($_COOKIE['usern'])) {
    header("Location:login.php");
}


else{
    

//unset($_POST);


?>
<link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
<style>
    
    #content_info
    {
        display: block!important;
    }
</style>

<?php


// Altera������o dos Accessos aos Utilizadores que s���o Admin e SuperUser

if (isset($_COOKIE['access_alt_pri']) == FALSE)
{
    $pri = '';
}
else
{
    $pri = $_COOKIE['access_alt_pri'];
}


$a = $_COOKIE['access'];



?>

<?php

  }

?>


