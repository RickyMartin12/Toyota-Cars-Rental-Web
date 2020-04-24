<!-- Head -->
<head>
        <title>Modelo de Listagem</title>
        <?php include 'header/head.php' ?>
        <link rel="stylesheet" href="css/mytables.css">

        
</head>
<!-- ENd Head -->


<!-- Sessão do Utilizador -->
<?php include 'request/session.php' ?> 
<!-- Fim do Contexto da Sessão do Utilizador -->


<!-- Content -->
<div id="content_info">
    

    
    
    
    <!-- Head -->
    
    
    <!-- Header -->
    <?php $menu = 'modelo_listagem'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'modelo/modelo_listar.php'; ?>
        
        <!-- End Conteudo -->


<!-- Nao coloque no rodape devido ao plugin do script da datatable -->

<script src="js/select2.full.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/dataTables.colReorder.min.js"></script>
<script src="js/bootbox.min.js"></script>
<script src="js/momentjs/moment-with-locales.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/bootstrap-switch.min.js"></script>
<script src="js/buttons.colVis.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/storageInfo.js"></script>
        <script>

        GetCarroNome(); GetModeloNome(); GetIDModelo(); GetIDUsername();

                // Funcoes de Listagem de Dados do Modelo
          Listarmodelos();

function confirmDeleteModelo(id){
table2 = $('#example2').DataTable();
bootbox.dialog({
  message: "Tem a certeza que pretende apagar o Modelo numero: #<strong>"+id+"</strong> ?",
  title: "<span style='color:#f0ad4e;'><span class='glyphicon glyphicon-exclamation-sign'></span> Confirmar</span>",
  buttons: {
    default: {
      label: "<span class='glyphicon glyphicon-remove-sign'></span> <span class='hidden-xs'>Fechar</span>",
      className: "btn-default",
    },
    danger: {
      label: "<span class='glyphicon glyphicon-trash'></span><span class='hidden-xs'> Apagar</span>",
      className: "btn-danger",
      callback: function() {
        dataValue='id='+id+'&action=3';
     $.ajax({
      type: "POST",
      cache:false,
      url: "modelo/action/action_modelo.php",
      data: dataValue,
      success: function(data){
        if(data == 2){
          table2.row("#"+id).remove().draw();
          $('.debug-url').html('Modelo numero: #<strong>'+id+'</strong> foi apagado com sucesso.');
          $("#mensagem_ok").trigger('click');
          setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
          setInterval( function () {table2.ajax.reload();}, 1000 ); 
          GetCarroNome(); GetModeloNome(); GetIDModelo();GetIDUsername();
        }
        else{
          $('.debug-url').html('O Modelo numero: #<strong>'+id+'</strong> não foi apagado.');
          $("#mensagem_ko").trigger('click');
          setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);

        }

      },
      error:function(data){
        $('.debug-url').html('O Modelo numero: #<strong>'+id+'</strong> não foi apagado, p.f. verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
      }
   });

      }
    },
  }
});
}
     
     function Listarmodelos()
             {
                $(".back").hide();
                $(".load").show();
                 table= $('#example2').DataTable( {
                 dom: "Blfrtip",
                 rowId: "id",
                 "paging": true,
                 "serverside":true,
                 order: [],
                 "ajax": 
           {
             "url" : "modelo/action_datatable_modelo.php",
             "type": "GET"
           },
           columns: [
             { data: "id", render: function ( data, type, row ) {
               return '<button title="Editar Carro:'+data+'" class="btn-sm btn btn-info btn-edit"><span class="glyphicon glyphicon-edit"></span> '+data+'</button><button style="margin-left: 5px;" title="Apagar '+data+'" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
               }},
               {data: "nome"}
           ],
           
           "rowCallback": function(row, data, index){
             if(data['activar_field'] == 1)
                 $(row).find('td:eq(0) .btn-active').addClass('btn-success').removeClass('btn-default');
             },
             'fnCreatedRow': function (nRow, aData, iDataIndex) {
             $(nRow).attr('id', 'my' + iDataIndex); // or whatever you choose to set as the id
         },
           select: 
             {
               style:    'os',
               selector: 'td:first-child'
             },
             buttons: [
               {
                 extend: 'colvis', text: '<i class="fa fa-scissors"></i>',
                 titleAttr: 'Esconder Colunas',
                 exportOptions: { orthogonal: 'export', columns: ':visible' }
               },
               {
                 extend: 'print', 
                 text: '<i class="fa fa-print"></i>',
                 titleAttr: 'Imprimir',
                 exportOptions: { orthogonal: 'export', columns: ':visible' }
               },
               {
                 extend: 'excelHtml5',
                 text: '<i class="fa fa-file-excel-o"></i>',
                 titleAttr: 'Excel',
                 key: {key: 't', altkey: true},
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config)
                 {
                   config.filename = 'carros';
                   $.fn.dataTable.ext.buttons.excelHtml5.action(e,dt,button,config);
                 }
               },
               {  
                 extend: '',
                 className:'buttons-pdf-format',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 titleAttr: 'PDF'
                },
                {
                 extend: 'pdfHtml5',
                 className:'a4landscape hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'landscape',
                 pageSize: 'A4',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                   customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '12',
                     alignment: 'left'
                   }
                }    
               },
               {
                 extend: 'pdfHtml5',
                 className:'a4portrait hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'portrait',
                 pageSize: 'A4',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' }, action:function(e,dt,button,config){
                   config.filename = 'carros';
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                 customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '12',
                     alignment: 'left'
                   }
                }    
               },
               {
                 extend: 'pdfHtml5',
                 className:'a3portrait hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'portrait',
                 pageSize: 'A3',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
     
                   config.pagesize = $('#pagesize').val();
                   config.orientation = $('#orientation').val();
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                 customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '12',
                     alignment: 'left'
                   }
                }    
               },
               {
                 extend: 'pdfHtml5',
                 className:'a3landscape hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'landscape',
                 pageSize: 'A3',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
     
                   config.pagesize = $('#pagesize').val();
                   config.orientation = $('#orientation').val();
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                 customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '20',
                     alignment: 'left'
                   }
                 }
               },
     
     
               {
                 extend: 'pdfHtml5',
                 className:'a2portrait hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'portrait',
                 pageSize: 'A2',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
                   
     
                   
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                 customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '20',
                     alignment: 'left'
                   }
                }    
               },
               {
                 extend: 'pdfHtml5',
                 className:'a2landscape hidden',
                 text: '<i class="fa fa-file-pdf-o"></i>',
                 orientation: 'landscape',
                 pageSize: 'A2',
                 footer: true,
                 exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
                   
                   $.fn.dataTable.ext.buttons.pdfHtml5.action(e,dt,button,config);
                 },
                 customize: function(doc) {
                   doc.styles.title = {
                     color: 'black',
                     fontSize: '20',
                     alignment: 'left'
                   }
                 }
               },
     
               {
                extend: 'csv',
                filename: 'carros',
                text: '<i class="fa fa-file"></i>',
                titleAttr: 'CSV',
                key: {key: 'l', altkey: true},
                exportOptions: { orthogonal: 'export', columns: ':visible' },
                 action:function(e,dt,button,config){
                   config.filename = 'carros';
                   
                   $.fn.dataTable.ext.buttons.csvHtml5.action(e,dt,button,config);
                 }
               }
     
               ],
                   "language": {
                     "emptyTable":"Sem resultados",         
                     "paginate": {
                       "first":      "Primeiro",
                       "last":       "Ultimo",
                       "next":       "Seguinte",
                       "previous":   "Anterior"
                     },
                     "zeroRecords": "Não tem registos",
                     "loadingRecords": "A carregar...",
                     "processing":     "A processar ...",
                     "info": "Página nº _PAGE_ de _PAGES_",
                     "infoEmpty": "Sem registos disponiveis",
                     "infoFiltered": "(filtro de _MAX_ registos totais)",
                     "search" : "Pesquisar Cliente: ",
                     "lengthMenu": "Mostrar _MENU_ Registos por Página"
                   }
     
     
          });
     }
     
     
     
     $('#example2 tbody').on( 'click', '.btn-edit', function () {
            arr = table.row($(this).parents('tr')).data();
            $('#modelo_id').html(arr.id);
             editarLinhaModelo(arr);
     });
     
     $('#example2 tbody').on( 'click', '.btn-danger', function () {
            arr = table.row($(this).parents('tr')).data();
            confirmDeleteModelo(arr.id);
       });


       function generatePdf(p,o){
        $('#pdf_conf').modal('hide');
        $('.back').fadeIn();
        setTimeout(function(){
        $('.'+p+''+o).trigger('click');}, 500);
        setTimeout(function(){$('.back').fadeOut();}, 1000);
        } 
        
        
        $('#example2_length').addClass('col-xs-12 col-md-6 col-sm-6 pull-left').removeClass('dataTables_length');
        $('.dt-buttons').addClass('col-xs-12 col-md-6 col-sm-6 pull-right').removeClass('dt-buttons');
        
        
        $('#example2_wrapper').on( 'click', '.buttons-pdf-format', function () {
            $('#pdf_conf').modal();
        });

        function editarLinhaModelo(vl)
        {
                var carro_info = $("#editar_Modelo");
                $("#modelo_nome_value").val(arr.nome);
                
                carro_info.modal('show');

        }

        function salvar_Modelo(vl)
        {
                dataValue="action=2&id="+vl+"&nome="+$('#modelo_nome_value').val();  

                console.log(dataValue);

                $.ajax({ url:'modelo/action/action_modelo.php',
                data:dataValue,
                type:'POST',
                cache:false,
                success: function(data){


                if (data == 1) {
                        $('.debug-url').html('O Numero do Modelo <strong class="cpt">'+vl+'</strong> foi modificado com sucesso');
                        $("#mensagem_ok").trigger('click');
                        $('html, body').animate({ scrollTop: 0 }, 500);
                        setTimeout(function(){
                        $('#Modalok').modal('hide');},2500);
                        escritaDatatableModelo(vl);
                        GetCarroNome(); GetModeloNome(); GetIDModelo();
                }
                else if (data == 0){
                        $('.debug-url').html('Modelo #<strong>'+vl+'</strong> não foi modificada!');
                        $("#Modalko").modal();
                        setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);
                }
                },
                error:function(){
                        $('.cancel-edit').trigger('click');
                        $('.debug-url').html('Modelo # <strong> ' +vl+ ' </strong> não foi modificada, p.f. verifique a ligação Wi-Fi.');
                        $("#Modalko").modal();

                }
                });
        }

        function escritaDatatableModelo(vl)
        {
                var modelo_info = $("#editar_Modelo");
                table2 = $('#example2').DataTable();
                var imagem;
                

                data = table2.row("#"+vl ).data();
                data['nome'] = $('#modelo_nome_value').val();

                table2.row("#"+vl ).data(data).draw(false);






                table2.ajax.reload();

                modelo_info.modal('hide');
        }




        






        </script>
       

     

</div>




<!-- End Content -->





