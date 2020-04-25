<!-- Head -->
<head>
        <title>Comentarios de Listagem</title>
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
    <?php $menu = 'comentarios_listar'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'comentario/comentario_listar.php'; ?>
        
        <!-- End Conteudo -->


<!-- Nao coloquei o footer.pho no rodape devido ao plugin do script da datatable -->

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

var active_field;
var active;

// Funcoes de Listagem de Dados do Modelo

setTimeout(function() {$(".back").fadeOut(); }, 2000);

var date = new Date();
          d = date.setDate(date.getDate());
          h = date.setHours(date.getHours());

GetCarroNome(); GetModeloNome(); GetIDModelo(); GetIDUsername(); GetTituloComentario();

arr_id_username = JSON.parse(localStorage.getItem("Username"));
        opt5='<option selected value="">Username</option>';   
        for (i=0;i<arr_id_username.length;i++){
          opt5 +='<option value="'+arr_id_username[i].nome+'">'+arr_id_username[i].nome+'</option>';
        }
        $('#username_id_value').html(opt5).select2();


        arr_id_titulo_com = JSON.parse(localStorage.getItem("Titulo"));
        opt6='<option selected value="">Titulo</option>';   
        for (i=0;i<arr_id_titulo_com.length;i++){
          opt6 +='<option value="'+arr_id_titulo_com[i].titulo+'">'+arr_id_titulo_com[i].titulo+'</option>';
        }
        $('#titulo_find').html(opt6).select2();


        ListarComentarios();

function UsernameNomeporID(vl1){
    var link;
  setTimeout(function(){ 
      
  dataValue='&action=3&nome='+vl1;
  //console.log(dataValue);
    $.ajax({ url:'comentario/action/action_comentario.php',
    data:dataValue,
    type:'POST', 
    cache:false,
    success: function(data){
      $('.back').fadeOut();
      //console.log(data);
      arr = JSON.parse(data);
      $("#id_admin").val(arr[0].id);
        
          
          
    },
    error:function(data){
        $('#Modalko .debug-url').html('Não foi possivel obter dados dos Clientes, verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
         $('.back').fadeOut();
      }
    });

}, 1000);
}


$("[name='my-checkbox']").bootstrapSwitch();
        
          $('.bootstrap-switch-id-activo_campo_opt').on('switchChange.bootstrapSwitch', function (event, state) {
                  console.log(state);
         if (state == true) {
        
            active = $("#activo_campo").val('1');
            
        
         } else {
            
        
            active = $("#activo_campo").val('0');
        
            
         }
           event.preventDefault();
        });

$("#data_comentario_dt").datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', 
    locale: 'pt', minDate: h, widgetPositioning: {vertical: 'bottom'}});

$( "#username_id_value" ).change(function() {
          if ($("#username_id_value").val() != "")
          {
                UsernameNomeporID($("#username_id_value").val());
          }
          

});



                
         






     
     function ListarComentarios()
             {
                $(".back").hide();
                $(".load").show();
                 table= $('#example3').DataTable( {
                 dom: "Blfrtip",
                 rowId: "id",
                 "paging": true,
                 "serverside":true,
                 order: [],
                 "ajax": 
           {
             "url" : "comentario/action_comentarios_datatable.php",
             "type": "GET"
           },
           columns: [
             { data: "id_comentario", render: function ( data, type, row ) {

               return '<button title="Editar Carro:'+data+'" class="btn-sm btn btn-info btn-edit"><span class="glyphicon glyphicon-edit"></span> '+data+'</button><button style="margin-left: 5px;" title="Apagar '+data+'" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button><button style="margin-left: 5px;" title="Activar coluna '+data+'" class="btn-sm btn-active btn btn-default"><span class="glyphicon glyphicon-eye-open"></span></button>';
               }},
             { data: "titulo"},
             { data: "nome_pessoa", ender: function ( data, type, row ) {
                $("#username_id_value").val(data);
                return data;
             }},
             { data: "data" , render: function ( data, type, row ) {
                myDate = new Date(data*1000);
                a = moment(myDate).format('DD/MM/YYYY');
                return a;
                }},
             { data: "descricao"},
             { data: "activo"},
             { data: "tstp", className: "hidden"}
           ],
           "columnDefs": [
                {"orderData": [6], "targets": [1]}
        ],
           
           "rowCallback": function(row, data, index){
             if(data['activo'] == 1)
             {
                $(row).find('td:eq(0) .btn-active').addClass('btn-success').removeClass('btn-default').children().addClass('glyphicon-eye-open').removeClass('glyphicon-eye-close');
             }
             else if(data['activo'] == 0)
             {
                $(row).find('td:eq(0) .btn-active').addClass('btn-default').removeClass('btn-success').children().addClass('glyphicon-eye-close').removeClass('glyphicon-eye-open');   
             }
                 
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
     
     
     
     


       function generatePdf(p,o){
        $('#pdf_conf').modal('hide');
        $('.back').fadeIn();
        setTimeout(function(){
        $('.'+p+''+o).trigger('click');}, 500);
        setTimeout(function(){$('.back').fadeOut();}, 1000);
        } 
        
        
        $('#example3_length').addClass('col-xs-12 col-md-6 col-sm-6 pull-left').removeClass('dataTables_length');
        $('.dt-buttons').addClass('col-xs-12 col-md-6 col-sm-6 pull-right').removeClass('dt-buttons');
        
        
        $('#example3_wrapper').on( 'click', '.buttons-pdf-format', function () {
            $('#pdf_conf').modal();
        });

        $('#example3 tbody').on( 'click', '.btn-edit', function () {
            arr = table.row($(this).parents('tr')).data();
            $('#comentario_id').html(arr.id_comentario);
            editarLinhaComentario(arr);
       });


        $('#example3 tbody').on( 'click', '.btn-active', function () 
	{
                arr = table.row($(this).parents('tr')).data();
                activarComentarios(arr.id_comentario, arr.activo);
        });

        $('#example3 tbody').on( 'click', '.btn-danger', function () {
            arr = table.row($(this).parents('tr')).data();
            confirmDeleteComentario(arr.id_comentario);
       });


       function activarComentarios(id, vl){
             $(".back").show(); 
             $(".load").show();
                 dataValue="id="+id+"&activo="+vl+"&action=1";
                 console.log(dataValue);
                 $.ajax({ url:'comentario/action/action_comentario.php',
                 data:dataValue,
                 type:'POST', 
                 cache:false,
                 success:function(data){

              if (data == 0 || data == 10){
                      $(".back").hide(); 
                    $(".load").hide();
                      $('.debug-url').html('Surgiu um erro activar a Coluna. <br> Por Favor tente mais tarde');
                      $("#mensagem_ko").trigger('click');
              }
            
              if (data == 1)
              {
                    $(".back").hide(); 
                    $(".load").hide();
                    $('.debug-url').html('O Comentario #<strong>'+id+'</strong> foi activado com sucesso.');
                    $("#mensagem_ok").trigger('click');
                   setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
                   setInterval( function () {table.ajax.reload();}, 1000 ); 
                 }
                if (data == 11)
              {
                    $(".back").hide(); 
                    $(".load").hide();
                    $('.debug-url').html('O Comentario #<strong>'+id+'</strong> foi desativado com sucesso.');
                    $("#mensagem_ok").trigger('click');
                   setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
                   setInterval( function () {table.ajax.reload();}, 1000 ); 
                 }
                },
                  error:function(){
                   $(".back").hide(); 
                    $(".load").hide();
                   $('.debug-url').html('O Comentario #<strong>'+id+'</strong> não foi activado, p.f. verifique a ligação Wi-fi.');
                   $("#mensagem_ko").trigger('click');
                  }
                });
            
              
            }

            function confirmDeleteComentario(id)
            {
              table = $('#example3').DataTable();
                bootbox.dialog({
                message: "Tem a certeza que pretende apagar o Carro numero: #<strong>"+id+"</strong> ?",
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
                        dataValue='id='+id+'&action=2';
                $.ajax({
                type: "POST",
                cache:false,
                url: "comentario/action/action_comentario.php",
                data: dataValue,
                success: function(data){
                        if(data == 2){
                        table.row("#"+id).remove().draw();
                        $('.debug-url').html('Comentario numero: #<strong>'+id+'</strong> foi apagado com sucesso.');
                        $("#mensagem_ok").trigger('click');
                        setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
                        setInterval( function () {table.ajax.reload();}, 1000 ); 
                        GetCarroNome(); GetModeloNome(); GetIDModelo();GetIDUsername();
                        }
                        else{
                        $('.debug-url').html('O Comentario numero: #<strong>'+id+'</strong> não foi apagado.');
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


function editarLinhaComentario(arr)
{
        var comentario_info = $("#editar_Comentario");
        $("#titulo_comentario").val(arr.titulo);

        $("#data_comentario_value").val(moment(arr.data*1000).format("DD/MM/YYYY"));
        $("#descricao_value").val(arr.descricao);

        $("#activo_campo").val(arr.activo);

        $("#id_admin").val(arr.nome_pessoa);

            active_field = $("#activo_campo").val();

            if (active_field == 1)
            {
                $("[name='my-checkbox']").bootstrapSwitch('state', true);
            }
            else if (active_field == 0)
            {
                $("[name='my-checkbox']").bootstrapSwitch('state', false);
            }

            


        comentario_info.modal('show');

        

}


function salvar_Comentario(vl)
{

        
        dataValue="action=4&id="+vl+"&titulo="+$('#titulo_comentario').val()+"&id_utilizador="+$("#id_admin").val()+"&data_comentario="+$("#data_comentario_value").val()+"&descricao="+$("#descricao_value").val()+"&activo="+$("#activo_campo").val();

        console.log(dataValue);

        //escritaDatatableComentario(vl);



        $.ajax({ url:'comentario/action/action_comentario.php',
                data:dataValue,
                type:'POST',
                cache:false,
                success: function(data){
                if (data == 1) {
                        $('.debug-url').html('O Numero do Comentario <strong class="cpt">'+vl+'</strong> foi modificado com sucesso');
                        $("#mensagem_ok").trigger('click');
                        $('html, body').animate({ scrollTop: 0 }, 500);
                        setTimeout(function(){
                        $('#Modalok').modal('hide');},2500);
                        $("#editar_Comentario").modal('hide');
                        table.ajax.reload();
             
                        //escritaDatatableComentario(vl);
                        GetCarroNome(); GetModeloNome(); GetIDModelo(); GetIDUsername();
                }
                else if (data == 0){
                        $('.debug-url').html('Comentario #<strong>'+vl+'</strong> não foi modificada!');
                        $("#Modalko").modal();
                        setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);
                }
                },
                error:function(){
                        $('.cancel-edit').trigger('click');
                        $('.debug-url').html('Comentario # <strong> ' +vl+ ' </strong> não foi modificada, p.f. verifique a ligação Wi-Fi.');
                        $("#Modalko").modal();

                }
                });
}



function escritaDatatableComentario(vl)
{
        //var comentario_info = $("#editar_Comentario");
         table = $('#example3').DataTable();
                data = table.row("#"+vl ).data();
                console.log(data);
                

                
                data['titulo'] = $('#titulo_comentario').val();

                
                
                data['nome_pessoa'] = $("#id_admin").val();

                myDate=$('#data_comentario_value').val().split("/");
                var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
                x = new Date(newDate).getTime()/1000;

                data['data'] = x;

                data['descricao'] = $("#descricao_value").val();

                data['activo'] = $("#activo_campo");



                table.row("#"+vl ).data(data).draw(false);






                table.ajax.reload();

                modelo_info.modal('hide');
                
}


$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var titulo_find = $("#titulo_find").val();
        var titulo = data[1];
        if ((titulo_find == titulo || titulo_find == ''))
        {
            return true;
        }
        
        return false;
 
        
    }
);

$('#titulo_find').on( 'change', function () {
        table.draw();
    });





</script>