

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

$("#log_tip").css('display','none');

var table;
var table2;
var table3;
var table4;

GetCarroNome(); GetModeloNome(); GetIDModelo(); GetIDUsername();

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#log_tip').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logotipo").change(function(){
        $("#log_tip").css('display','block');
        readURL(this);
    });

setTimeout(function() {$(".back").fadeOut(); });

// 1) Funções usadas no Carro - Novo

arr = JSON.parse(localStorage.getItem("Modelo"));
  opt='<option selected value="">Modelo</option>';   
  for (i=0;i<arr.length;i++){
    opt +='<option value="'+arr[i].nome+'">'+arr[i].nome+'</option>';
  }
  $('#modelo').html(opt).select2();

  arr2 = JSON.parse(localStorage.getItem("Modelo"));
        opt2='<option selected value="">Modelo</option>';   
        for (i=0;i<arr2.length;i++){
          opt2 +='<option value="'+arr2[i].nome+'">'+arr2[i].nome+'</option>';
        }
        $('#mol').html(opt2).select2();
  

        arr_find = JSON.parse(localStorage.getItem("Carro"));
        opt3='<option selected value="">Carro</option>';   
        for (i=0;i<arr_find.length;i++){
          opt3 +='<option value="'+arr_find[i].nome_carro+'">'+arr_find[i].nome_carro+'</option>';
        }
        $('#carro_find').html(opt3).select2();

        arr_find_id_modelo = JSON.parse(localStorage.getItem("ID_Modelo"));
        opt4='<option selected value="">Modelo</option>';   
        for (i=0;i<arr_find_id_modelo.length;i++){
          opt4 +='<option value="'+arr_find_id_modelo[i].id+'">'+arr_find_id_modelo[i].id+'</option>';
        }
        $('#id_modelo_find').html(opt4).select2();

        arr_id_username = JSON.parse(localStorage.getItem("Username"));
        opt5='<option selected value="">Username</option>';   
        for (i=0;i<arr_id_username.length;i++){
          opt5 +='<option value="'+arr_id_username[i].nome+'">'+arr_id_username[i].nome+'</option>';
        }
        $('#username_id').html(opt5).select2();
  
  // Submtere novo Carro
  $('#submit-new').on('click', function(event) {
    event.preventDefault();
            $(".back").show(); 
            $(".load").show();
            var form_data = new FormData();
            var modelo = $("#modelo").val();
            var nome = $("#no").val();
            var preco = $("#preco").val();
            var kms = $("#kms").val();
            var file_data = $('#logotipo').prop('files')[0]; 

            form_data.append('file', file_data);
            if (modelo == "")
            {
              modelo = $("#nome_modelo").val();
            }
            form_data.append('modelo', modelo); 
            form_data.append('nome', nome); 
            form_data.append('preco', preco);           
            form_data.append('kms', kms); 
            form_data.append('file', file_data);

            $.ajax({
              url: "carro/actions/add_imagem_carro.php",
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,                        
              type: 'POST',
              success:function(data){
                if (data != 0)
                {
                    
                    arr=[];
                    arr =  JSON.parse(data);
                    
                    
                    if (arr.error)
                    {
                            $(".back").hide();
                            $(".load").show();
                        jQuery(".debug-url").html("Por favor, verifique:<br><br>"+arr.error+"<br> Retifique o Erro e tente novamente.");
                        $('#Modalko').modal();
                    }
                    else if (arr.success == 0)
                    {
                            $(".back").hide();
                            $(".load").show();
                        $('.debug-url').html('A Criação do Carro nao foi adicionado com sucesso');
                        $("#mensagem_ko").trigger('click');
                    }
                    else if (arr.success == 1)
                    {
                            $(".back").hide();
                            $(".load").show();
                        $('.debug-url').html('A Criação do Carro foi adicionado com sucesso');
                        $("#submit_car_form")[0].reset();
                        $("#mensagem_ok").trigger('click');

                        
                    }
               
                }
                else
                {
                            $(".back").hide();
                            $(".load").show();
                        $('.debug-url').html('Erro ao Carregar a Imagem');
                        $("#mensagem_ko").trigger('click');
                }
                    
    },
    error:function(){
        $(".back").hide();
        $(".load").show();
        $('.debug-url').html("O Pedido de Informações não foi submtido com sucesso. Verifique a conexão WI-FI e tente novamente.");
            $('#Modalko').modal();
        }
})
});

// 2) Funções usadas no Carro - Listagem

function ModeloIDporNome(vl1){
    var link;
  setTimeout(function(){ 
      
  dataValue='&action=1&id='+vl1;
  //console.log(dataValue);
    $.ajax({ url:'carro/actions/action_carros.php',
    data:dataValue,
    type:'POST', 
    cache:false,
    success: function(data){
      $('.back').fadeOut();
      //console.log(data);
      arr = [];
      arr = JSON.parse(data);
        
          $("#nome_modelo").val(arr[0].nome);
    },
    error:function(data){
        $('#Modalko .debug-url').html('Não foi possivel obter dados dos Clientes, verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
         $('.back').fadeOut();
      }
    });

}, 1000);
}

function ModeloNomeporID(vl1){
    var link;
  setTimeout(function(){ 
      
  dataValue='&action=3&nome='+vl1;
  //console.log(dataValue);
    $.ajax({ url:'carro/actions/action_carros.php',
    data:dataValue,
    type:'POST', 
    cache:false,
    success: function(data){
      $('.back').fadeOut();
      //console.log(data);
      arr = JSON.parse(data);
      $("#bas").val(arr[0].id);
        
          
          
    },
    error:function(data){
        $('#Modalko .debug-url').html('Não foi possivel obter dados dos Clientes, verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
         $('.back').fadeOut();
      }
    });

}, 1000);
}



// Funcoes da Listagem de Carros

Listarcarros();
     
function Listarcarros()
        {
            table = $('#example').DataTable( {
            dom: "Blfrtip",
            rowId: "id",
            "paging": true,
            "serverside":true,
            order: [],
            "ajax": 
      {
        "url" : "carro/action_carros_datatable.php",
        "type": "GET"
      },
      columns: [
        { data: "id", render: function ( data, type, row ) {
          return '<button title="Editar Carro:'+data+'" class="btn-sm btn btn-info btn-edit"><span class="glyphicon glyphicon-edit"></span> '+data+'</button><button style="margin-left: 5px;" title="Apagar '+data+'" class="btn-sm btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
          }},
        { data: "modelo",render: function (data, type, full)
        {
            
            return data;
            
        }},
        { data: "nome_carro" },
        { data: "preco" },
        { data: "kms" },
        { data: "img", render: function (data, type, full)
        {
            return '<img class="img-responsive" height="100%" width="100%" src="/admin/definitions/upload/'+data+'"/>';
        }}
        
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



$('#example tbody').on( 'click', '.btn-edit', function () {
       arr = table.row($(this).parents('tr')).data();
       $('#carro_id').html(arr.id);
        editarLinhaCarro(arr);
        //editClientTable(arr);	
});

$('#example tbody').on( 'click', '.btn-danger', function () {
       arr = table.row($(this).parents('tr')).data();
       confirmDeleteCarro(arr.id);
  });


function confirmDeleteCarro(id){
table = $('#example').DataTable();
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
        dataValue='id='+id+'&action=5';
     $.ajax({
      type: "POST",
      cache:false,
      url: "carro/actions/action_carros.php",
      data: dataValue,
      success: function(data){
        if(data == 2){
          table.row("#"+id).remove().draw();
          $('.debug-url').html('Carro numero: #<strong>'+id+'</strong> foi apagado com sucesso.');
          $("#mensagem_ok").trigger('click');
          setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
          setInterval( function () {table.ajax.reload();}, 1000 ); 
          GetCarroNome(); GetModeloNome(); GetIDModelo();GetIDUsername();
        }
        else{
          $('.debug-url').html('O Carro numero: #<strong>'+id+'</strong> não foi apagado.');
          $("#mensagem_ko").trigger('click');
          setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);

        }

      },
      error:function(data){
        $('.debug-url').html('O Carro numero: #<strong>'+id+'</strong> não foi apagado, p.f. verifique a ligação Wi-Fi.');
        $("#mensagem_ko").trigger('click');
      }
   });

      }
    },
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
        
        
        $('#example_length').addClass('col-xs-12 col-md-6 col-sm-6 pull-left').removeClass('dataTables_length');
        $('.dt-buttons').addClass('col-xs-12 col-md-6 col-sm-6 pull-right').removeClass('dt-buttons');
        
        
        $('#example_wrapper').on( 'click', '.buttons-pdf-format', function () {
            $('#pdf_conf').modal();
        });

        $( "#mol" ).change(function() {
          if ($("#mol").val() == "")
          {
            $("#bas").val("");
          }
          else
          {
            ModeloNomeporID($("#mol").val());
          }
          

        });

    
     function editarLinhaCarro(arr)
     {
         var carro_info = $("#editar_Carro");
         $("#bas").val(arr.modelo);

         



        $("#no_value").val(arr.nome_carro);
        $("#preco_value").val(arr.preco);
        $("#kms_value").val(arr.kms);

        $("#logo_img").html('<img src="/admin/definitions/upload/'+arr.img+'" class="img-responsive"><br><input type="hidden" id="img_tmp" value="'+arr.img+'" >');

        carro_info.modal('show');

        ModeloIDporNome($("#bas").val());
     }




     // salvar alteracoes dadas na datatable

     function salvar_Carro(vl)
     {
            $(".back").show(); 
            $(".load").show();

            //dataValue="action=2&id="+vl+"&modelo="+$("#mol").val()+"&nome="+$("#nome");

            var form_data = new FormData();

            var file_data = $('#logo').prop('files')[0];
            var modelo = $("#mol").val();
            var nome = $("#no_value").val();
            var preco = $("#preco_value").val();
            var kms = $("#kms_value").val();
            var tmp_img = $("#img_tmp").val();

            

            if (modelo == "")
            {
              modelo = $("#nome_modelo").val();
            }

            
            
            


            form_data.append('id', vl);
            form_data.append('modelo', modelo); 
            form_data.append('nome', nome); 
            form_data.append('preco', preco);           
            form_data.append('kms', kms); 

            if ($('#logo').val () == "")
            {
              form_data.append('file', tmp_img);
            }
            else
            {
              form_data.append('file', file_data);
            }
            

            $.ajax({
              url: "carro/actions/alter_imagem_carro.php",
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,                        
              type: 'POST',
              success:function(data)
              {
                if (data == 1 || data == 11)
                {
                  
                    
                  $('.debug-url').html('O ID do Carro <strong class="cpt">'+vl+'</strong> foi actualizado com sucesso');
                  $("#mensagem_ok").trigger('click');
                  $('html, body').animate({ scrollTop: 0 }, 500);
                  setTimeout(function(){
                  $('#Modalok').modal('hide');},2500);
                            GetCarroNome(); GetModeloNome(); GetIDModelo();
                            escritaDatatableCarro(vl);
                            $(".back").hide(); 
                            $(".load").hide();
                }
                else if (data == 0 || data == 10)
                {
                  $('.debug-url').html('Carro #<strong>'+vl+'</strong> não foi modificada!');
                  $("#Modalko").modal();
                  setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);
                }
                else 
                {
                  $('.debug-url').html('Erro ao Carregar a Imagem');
                  $("#Modalko").modal();
                  setTimeout(function(){  $('#Modalko').modal('hide');}, 2500);
                }
                    
                },
          error:function(){
              $(".back").hide();
              $(".load").show();
              $('.debug-url').html("O Pedido de Informações não foi submtido com sucesso. Verifique a conexão WI-FI e tente novamente.");
                  $('#Modalko').modal();
              }
      });
     }





     function escritaDatatableCarro(vl){
      var carro_info = $("#editar_Carro");
      table = $('#example').DataTable();
      var imagem;

      data = table.row("#"+vl ).data();
      if ($("input[type='file']").val() == "")
      {
        imagem = $("#img_tmp").val();
      }
      else
      {
        var tmp = $("input[type='file']").val();
        imagem = tmp.replace(/^.*\\/, "");
      }
      data['modelo'] = $("#bas").val();
      data['nome_carro'] = $("#no_value").val();
      data['preco'] = $("#preco_value").val();
      data['kms'] = $("#kms_value").val();
      data['img'] = '<img class="img-responsive" height="100%" width="100%" src="/admin/definitions/upload/'+imagem+'"/>';

      table.row("#"+vl ).data(data).draw(false);






      table.ajax.reload();

      carro_info.modal('hide');


     }

     $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var carro_find = $("#carro_find").val();
        var id_modelo_find = $("#id_modelo_find").val();
        var carro = data[2];
        var id_modelo = data[1];
        if ((carro_find == carro || carro_find == '') && (id_modelo_find == id_modelo || id_modelo_find == ''))
        {
            return true;
        }
        
        return false;
 
        
    }
);

     $('#carro_find, #id_modelo_find').on( 'change', function () {
        table.draw();
    });

    

  
  
  // 3) Funções do Modelo Novo

  $('#submit-new-modelo').on('click', function(event) {
    $(".back").show(); 
    $(".load").show();
    event.preventDefault();
    dataValue='action=1&nome='+$("#mod_nome").val();
    console.log(dataValue);
    $.ajax({ url:'modelo/action/action_modelo.php',
    data:dataValue,
    type:'POST', 

    success: function(data){
      arr=[];
                    arr =  JSON.parse(data);
                    
                    
                    if (arr.error)
                    {
                            $(".back").hide();
                            $(".load").show();
                        jQuery(".debug-url").html("Por favor, verifique:<br><br>"+arr.error+"<br> Retifique o Erro e tente novamente.");
                        $('#Modalko').modal();
                    }
                    else if (arr.success == 0)
                    {
                            $(".back").hide();
                            $(".load").show();
                        $('.debug-url').html('A Criação do Modelo nao foi adicionado com sucesso');
                        $("#mensagem_ko").trigger('click');
                    }
                    else if (arr.success == 1)
                    {
                            $(".back").hide();
                            $(".load").show();
                        $('.debug-url').html('A Criação do Modelo foi adicionado com sucesso');
                        $("#submit_modelo_form")[0].reset();
                        $("#mensagem_ok").trigger('click');
                        GetCarroNome(); GetModeloNome(); GetIDModelo();


                        
                    }
    },
    error: function(){
      $(".back").hide();
        $(".load").show();
      $('.debug-url').html('O registo do modelo do carro não foi criado, p.f. verifique a ligação Wi-Fi.');
      $('#Modalko').modal();

    }
  });
});






</script>




