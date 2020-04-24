<!-- Head -->
<head>
        <title>Comentarios de Listagem</title>
        <?php include 'header/head.php' ?>
        <link rel="stylesheet" href="css/mytables.css">
        <style>
            thead tr {
                  background: #414042;
                  color: #fff;
               }


.btn {
    padding: 6px 12px!important;

}
         </style>

        
</head>
<!-- ENd Head -->


<!-- Sessão do Utilizador -->
<?php include 'request/session.php' ?> 
<!-- Fim do Contexto da Sessão do Utilizador -->


<!-- Content -->
<div id="content_info">
    
    <!-- Head -->
    
    
    <!-- Header -->
    <?php $menu = 'visualizar_utilizadores'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'users/users_visualizar_info.php'; ?>

</div>