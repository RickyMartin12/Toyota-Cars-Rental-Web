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
    <?php $menu = 'reservas_listagem'; ?>
    <?php include 'header/header.php' ?>
    
        <!-- Mostra o Conteudo da Página Correspondente -->
        <?php include 'reserva/reserva_listar.php'; ?>


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

setTimeout(function() {$(".back").fadeOut(); });

GetCarroNome(); GetModeloNome(); GetIDModelo(); GetIDUsername();

var date = new Date();
          d = date.setDate(date.getDate());
          h = date.setHours(date.getHours());
    
    // Datas usando no datetimepicker

    $("#data_reseva_dt_value").datetimepicker({ ignoreReadonly: true, format: 'DD/MM/YYYY', 
    locale: 'pt', showTodayButton: true, minDate: h, defaultDate: h, widgetPositioning: { horizontal: 'right', vertical: 'bottom' }});

  // Datas usando no datetimepicker

  $("#hora_reseva_dt_value").datetimepicker({ ignoreReadonly: true, format: 'HH:mm', 
    locale: 'pt', showTodayButton: true, minDate: h, defaultDate: h, widgetPositioning: { horizontal: 'right', vertical: 'bottom' }});
    

// Funcoes da Listagem de Carros

arr_id_titulo_com = JSON.parse(localStorage.getItem("Titulo"));
        opt6='<option selected value="">Titulo</option>';   
        for (i=0;i<arr_id_titulo_com.length;i++){
          opt6 +='<option value="'+arr_id_titulo_com[i].titulo+'">'+arr_id_titulo_com[i].titulo+'</option>';
        }
        $('#titulo_find').html(opt6).select2();


        arr_carros = JSON.parse(localStorage.getItem("Carro"));
        console.log(arr_carros);
        opt7='<option selected value="">Titulo</option>';   
        for (i=0;i<arr_carros.length;i++){
          opt7 +='<option value="'+arr_carros[i].nome_carro+'">'+arr_carros[i].nome_carro+'</option>';
        }
        $('#car_id_nome').html(opt7).select2();



function NomeCarroValueById(vl1){
    var link;
  setTimeout(function(){ 
      
  dataValue='&action=1&nome='+vl1;
  //console.log(dataValue);
    $.ajax({ url:'reserva/action/action_reserva.php',
    data:dataValue,
    type:'POST', 
    cache:false,
    success: function(data){
      $('.back').fadeOut();
      arr = JSON.parse(data);
      $("#id_carro").val(arr[0].id);  
          
    },
    error:function(data){
        $('#Modalko .debug-url').html('Não foi possivel obter dados dos Clientes, verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
         $('.back').fadeOut();
      }
    });

}, 1000);
}

$( "#car_id_nome" ).change(function() {
          if ($("#car_id_nome").val() != "")
          {
                NomeCarroValueById($("#car_id_nome").val());
          }
          

});

        

Lista_reserva();
     
function Lista_reserva()
        {
            table = $('#example4').DataTable( {
            dom: "Blfrtip",
            rowId: "id",
            "paging": true,
            "serverside":true,
            order: [],
            "ajax": 
      {
        "url" : "reserva/action_datatable_reserva.php",
        "type": "GET"
      },
      columns: [
        { data: "id", render: function ( data, type, row ) {
          return '<button title="Editar Carro:'+data+'" class="btn-sm btn btn-info btn-edit"><span class="glyphicon glyphicon-edit"></span> '+data+'</button><button style="margin-left: 5px;" title="Apagar '+data+'" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
          }},
        { data: "nome"},
        { data: "pais" },
        { data: "email" },
        { data: "telefone" },
        { data: "data_reserva" , render: function ( data, type, row ) {
          myDate = new Date(data*1000);
          a = moment(myDate).format('DD/MM/YYYY');
          return a;
          }
        },
        { data: "hora_reserva" , render: function ( data, type, row ) {
          date = new Date(data * 1000);
          year = date.getFullYear();
          month = date.getMonth() + 1; 
          day = date.getDate();
          hours = date.getHours();
          minutes = date.getMinutes();
          seconds = date.getSeconds();
          month = (month < 10) ? '0' + month : month;
          day = (day < 10) ? '0' + day : day;
          hours = (hours < 10) ? '0' + hours : hours;
          minutes = (minutes < 10) ? '0' + minutes : minutes;
          seconds = (seconds < 10) ? '0' + seconds: seconds;
          return hours + ':' + minutes;
          }
        },
        { data: "carro"},
        { data: "observacoes"},
        { data: "tstp", className: "hidden"}
      ],
      "columnDefs": [
         {"orderData": [9], "targets": [1]}
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

function generatePdf(p,o){
        $('#pdf_conf').modal('hide');
        $('.back').fadeIn();
        setTimeout(function(){
        $('.'+p+''+o).trigger('click');}, 500);
        setTimeout(function(){$('.back').fadeOut();}, 1000);
        } 
        
        
        $('#example4_length').addClass('col-xs-12 col-md-6 col-sm-6 pull-left').removeClass('dataTables_length');
        $('.dt-buttons').addClass('col-xs-12 col-md-6 col-sm-6 pull-right').removeClass('dt-buttons');
        
        
        $('#example4_wrapper').on( 'click', '.buttons-pdf-format', function () {
            $('#pdf_conf').modal();
        });



$('#example4 tbody').on( 'click', '.btn-danger', function () {
       arr = table.row($(this).parents('tr')).data();
       confirmDeleteReserva(arr.id);
  });


  $('#example4 tbody').on( 'click', '.btn-edit', function () {
       arr = table.row($(this).parents('tr')).data();
       $('#reserva_id').html(arr.id);
       editarLinhaReserva(arr);
});


function editarLinhaReserva(arr)
{
        var reserva_info = $("#editar_Reserva");
        $("#nome_reserva_value").val(arr.nome);
        $("#pais_value").val(arr.pais);
        $("#email_value").val(arr.email);
        $("#telefone_value").val(arr.telefone);
        $("#data_reserva_value").val(moment(arr.data_reserva*1000).format("DD/MM/YYYY"));
        $("#hora_reserva_value").val(moment(arr.hora_reserva*1000).format("HH:mm"));
        $("#observacao_value").val(arr.observacoes);


        
        $("#id_carro").val(arr.carro);

        reserva_info.modal('show');
}

function salvar_Reserva(vl)
{
        $(".back").show(); 
        $(".load").show();

        dataValue="action=2&id="+vl+"&nome="+$('#nome_reserva_value').val()+"&pais="+$("#pais_value").val()+"&email="+$("#email_value").val()+"&telefone="+$("#telefone_value").val()+"&data_reserva="+$("#data_reserva_value").val()+"&hora_reserva="+$("#hora_reserva_value").val()+"&carro_id="+$("#id_carro").val()+"&observacao="+$("#observacao_value").val();

        $.ajax({ url:'reserva/action/action_reserva.php',
                data:dataValue,
                type:'POST',
                cache:false,
                success: function(data){



                if (data == 1) {
                        $('.debug-url').html('O Numero da Reserva <strong class="cpt">'+vl+'</strong> foi modificado com sucesso');
                        $("#mensagem_ok").trigger('click');
                        $('html, body').animate({ scrollTop: 0 }, 500);
                        setTimeout(function(){
                        $('#Modalok').modal('hide');},2500);
                        escritaDatatableReserva(vl);

                        $(".back").hide(); 
                        $(".load").hide();
                }
                else if (data == 0){
                        $('.debug-url').html('Reserva #<strong>'+vl+'</strong> não foi modificada!');
                        $("#Modalko").modal();
                        setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);
                }
                },
                error:function(){
                        $('.cancel-edit').trigger('click');
                        $('.debug-url').html('Reserva # <strong> ' +vl+ ' </strong> não foi modificada, p.f. verifique a ligação Wi-Fi.');
                        $("#Modalko").modal();

                }
                });

}



function escritaDatatableReserva(vl){
      var reserva_info = $("#editar_Reserva");
      table = $('#example4').DataTable();
      data = table.row("#"+vl ).data();
      

      data['nome'] = $('#nome_reserva_value').val();
      data['pais'] = $('#pais_value').val();
      data['email'] = $('#email_value').val();
      data['telefone'] = $("#telefone_value").val();

      myDate=$('#data_reserva_value').val().split("/");
      var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2]; 
      x = new Date(newDate).getTime()/1000;

      data['data_reserva'] = x;

       myh=$('#hora_reserva_value').val().split(":");
        h = myh[0]*60*60;
        m = myh[1]*60;
        t = h+m+x;

        data['hora_reserva'] = t;

        data['carro'] = $("#id_carro").val();

        data['observacoes'] = $("#observacao_value").val();




      table.row("#"+vl ).data(data).draw(false);






      table.ajax.reload();

      reserva_info.modal('hide');


     }


     function confirmDeleteReserva(id)
     {
        table = $('#example4').DataTable();
        bootbox.dialog({
        message: "Tem a certeza que pretende apagar a Reserva numero: #<strong>"+id+"</strong> ?",
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
        url: "reserva/action/action_reserva.php",
        data: dataValue,
        success: function(data){
                if(data == 2){
                table.row("#"+id).remove().draw();
                $('.debug-url').html('Reserva numero: #<strong>'+id+'</strong> foi apagado com sucesso.');
                $("#mensagem_ok").trigger('click');
                setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
                setInterval( function () {table.ajax.reload();}, 1000 ); 
                GetCarroNome(); GetModeloNome(); GetIDModelo();GetIDUsername();
                }
                else{
                $('.debug-url').html('A Reserva numero: #<strong>'+id+'</strong> não foi apagado.');
                $("#mensagem_ko").trigger('click');
                setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);

                }

        },
        error:function(data){
                $('.debug-url').html('A Reserva numero: #<strong>'+id+'</strong> não foi apagado, p.f. verifique a ligação Wi-Fi.');
                $("#mensagem_ko").trigger('click');
        }
        });

        }
        },
        }
        });
     }


</script>