<!-- Head -->
<head>
        <title>Sistema de Administração - La Cigale</title>
        <?php include 'header/head.php' ?>
</head>
<!-- ENd Head -->


<!-- Sessão do Utilizador -->
<?php include 'request/session.php' ?> 
<!-- Fim do Contexto da Sessão do Utilizador -->


<!-- Content -->
<div id="content_info">
    

    
    
    
    <!-- Head -->
    
    
    <!-- Header -->
    <?php $menu = 'modelo_novo'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'modelo/modelo_novo.php'; ?>
        
        <!-- End Conteudo -->
        
        
       
    
        <!-- Footer -->
        <?php include 'footer/footer.php' ?>

</div>




<!-- End Content -->





