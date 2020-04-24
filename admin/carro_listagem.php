<!-- Head -->
<head>
        <title>Lista de Carros</title>
        <?php include 'header/head.php' ?>
        <link href="css/mytables.css" rel="stylesheet" type="text/css"/>
</head>
<!-- ENd Head -->


<!-- Sessão do Utilizador -->
<?php include 'request/session.php' ?> 
<!-- Fim do Contexto da Sessão do Utilizador -->


<!-- Content -->
<div id="content_info">
    

    
    
    
    <!-- Head -->
    
    
    <!-- Header -->
    <?php $menu = 'carro_listagem'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'carro/carro_listar.php'; ?>
        
        
        <!-- End Conteudo -->
        
        
       
    
        <!-- Footer -->
        <?php include 'footer/footer.php' ?>

</div>




<!-- End Content -->





