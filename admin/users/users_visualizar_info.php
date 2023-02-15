
<div class="cont_page">
<div class="container">
<div class="row">

            <h2><center>Sistemas de Utilizadores</center></h2>
			<div id="show_users">
			    
			</div>
		</div>
	</div>
</div>


<!-- End Line Page -->


<script src="js/bootbox.min.js"></script>
<script src="js/momentjs/moment-with-locales.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/select2.full.min.js"></script>
<script src="js/bootstrap-switch.min.js"></script>
<script src="js/storageInfo.js"></script>





<script>
  setTimeout(function() {$(".back").fadeOut();});
  
  
  // Mostrar os tipos de utilizadores
  
  showUsers();
  
  function showUsers(){
   var s = "";
   var sa;
  dataValue="&action=1";
  $.ajax({ url:'users/users_action.php',
    data:dataValue,
    type:'POST', 
     success:function(data){
     arr=[];
     arr =  JSON.parse(data);
    if (arr == null || arr.length < 1){
     $('.debug-url').html('Nao existe a Utilizadores');
     $("#mensagem_ko").trigger('click');
     $('#show_users').empty();
    }
    else {
      for(i=0;i<arr.length;i++)
      {

        nome = "'"+arr[i].nome+"'";
        console.log(nome);
        id = "'"+arr[i].id+"'";
          
          
          
        s += '<tr class="action-users-'+arr[i].id+'"><td scope="row"><input type="text" value="'+arr[i].nome+'" id="col-1-'+arr[i].id+'" style="display: none" class="frm-item form-control"/><font class="font-1-'+arr[i].id+'" style="color: #000">'+arr[i].nome+'</font></td><td><input type="password" style="display: none" id="col-2-'+arr[i].id+'" class="frm-item form-control" placeholder="******""><font class="font-2-'+arr[i].id+'" style="color: #000"> ******* </font></td><td><input type="text" style="display: none" id="col-3-'+arr[i].id+'" class="frm-item form-control" value="'+arr[i].email+'"><font class="font-3-'+arr[i].id+'" style="color: #000">'+arr[i].email+'</font></td><td><select class="form-control" style="display: none" id="col-4-'+arr[i].id+'" onchange="changePermission('+arr[i].id+')"><option value="'+arr[i].tipo+'">'+arr[i].tipo+'</option><option value="Gestor">Gestor</option><option value="Administrator">Administrator</option><option value="GestorPlus">GestorPlus</option><option value="SuperUser">SuperUser</option></select><font class="font-4-'+arr[i].id+'" style="color: #000">'+arr[i].tipo+'</font></td><td><input type="text" readonly value="'+arr[i].privilegios+'" id="col-5-'+arr[i].id+'" style="display: none" class="frm-item form-control"/><font class="font-5-'+arr[i].id+'" style="color: #000">'+arr[i].privilegios+'</font></td><td id="action-'+arr[i].id+'" style="width:80px;"><button title="Editar Utilizador - '+arr[i].id+'" class="btn btn-info btn-sm" onclick="editUsersFilters('+arr[i].id+')"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;&nbsp;<button title="Apagar Operador" class="btn btn-danger btn-sm" onclick="confirmDeleteUsername('+id+','+nome+')"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';

          
      }  
      
      
      
      
    $('#show_users').html('<div class="table-responsive"><table class="table"><thead><tr><th>Nome</th><th>Password</th><th>Email</th><th>Tipo de Utilizador</th><th>Privilegios</th><th>Accoes</th></tr></thead><tbody>'+s+'</tbody></table></div>');
    
    

    }
    
    
    },
    error:function(data){
     $('.debug-url').html('Erro ao obter os Utilizadores, p.f. verifique a ligaПлоПлкo.');
     $("#mensagem_ko").trigger('click');
    }
  });
}


function changePermission(id)
{
    var tipo = $("#col-4-"+id).val();
    
    if ( tipo == "Gestor")
    {
        $("#col-5-"+id).val('4');
    }
    if ( tipo == "Administrator")
    {
        $("#col-5-"+id).val('2');
    }
    if ( tipo == "GestorPlus")
    {
        $("#col-5-"+id).val('3');
    }
    if ( tipo == "SuperUser")
    {
        $("#col-5-"+id).val('1');
    }
}


// EdiПлоПлкo dos Utilizadores

  

  
  function editUsersFilters(id)
  {
      for (i=1; i<6; i++)
      {
          $("#col-"+i+"-"+id).css('display', 'block');
           $(".font-"+i+"-"+id).css('display', 'none');
      }
      
      $("#action-"+id).html('<button title="Submissao dos Utilizadores - '+id+'" class="btn btn-success btn-sm" onclick="saveUsersFilters('+id+')"><span class="glyphicon glyphicon-save-file"></span></button><button title="Cancelar Editar Utilizador - '+id+'" class="btn btn-default btn-sm" onclick="cancelUsersFilters('+id+')"><span class="glyphicon glyphicon-remove-sign"></span></button>');
  }
  
  function cancelUsersFilters(id)
  {
      for (i=1; i<6; i++)
      {
          $("#col-"+i+"-"+id).css('display', 'none');
           $(".font-"+i+"-"+id).css('display', 'block');
      }
      nome = "'"+$("#col-1-"+id).val()+"'";
      id_us = "'"+id+"'";
      console.log(nome);
      $("#action-"+id).html('<button title="Editar Utilizador - '+id+'" class="btn btn-info btn-sm" onclick="editUsersFilters('+id_us+')"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;&nbsp;<button title="Apagar Operador" class="btn btn-danger btn-sm" onclick="confirmDeleteUsername('+id_us+','+nome+')"><span class="glyphicon glyphicon-trash"></span></button>');
  }
  
  
  function saveUsersFilters(id)
  {
      nome = $("#col-1-"+id).val();

      var dataValue='';
      for(i=1;i<6;i++){
        dataValue+="col_"+i+"_"+id+"="+$("#col-"+i+"-"+id).val()+"&";
      }
      dataValue+="nome="+nome+"&id="+id+"&action=3";
      
      $.ajax({ url:'users/users_action.php',
    data:dataValue,
    type:'POST',
    cache:false,
    success:function(data){
      console.log(data);
      if (data == 2){
        $('.debug-url').html('Erro, ja existe um administrador com o nome <b>'+nome+'</b>!');
        $("#mensagem_ko").trigger('click');
     }
    else if (data == 22){
        $('.debug-url').html('Erro, ao modificar o administrador <b>'+nome+'</b>!');
        $("#mensagem_ko").trigger('click');
     }
    else if(data == 11 || data == 1){
      showUsers();
      $('.debug-url').html('O administrador <b>'+nome+'</b> foi modificado com sucesso.');
      $("#mensagem_ok").trigger('click');
      setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
     }
    },
    error:function(){
      $('.debug-url').html('O administrador <b>'+nome+'</b> nПлкo foi modificado, p.f. verifique a ligaПлоПлкo Wi-Fi.');
      $("#mensagem_ko").trigger('click');
    }
  });
  }

  function confirmDeleteUsername(id, nome)
  {
    bootbox.dialog({
    message: "Tem a certeza que pretende apagar o utilizador <strong>"+nome+"</strong>",
    title: "<span style='color:#f0ad4e;'><span class='glyphicon glyphicon-exclamation-sign'></span> Confirmar</span>",
    buttons: {
      default: {
        label: "<span class='glyphicon glyphicon-remove-sign'></span> Fechar",
        className: "btn-default",
      },
      danger: {
        label: "<span class='glyphicon glyphicon-trash'></span> Apagar",
        className: "btn-danger",
        callback: function() {
      dataValue='nome='+nome+'&id='+id+'&action=6';
      $.ajax({
        type: "POST",
        url: "users/users_action.php",
        data: dataValue,
        cache:false,
        success: function(data){
          if(data == 2){
            showUsers();
            $('#Modalok .debug-url').html('O Utilizador <strong>'+nome+'</strong> foi apagado com sucesso.');
            $("#mensagem_ok").trigger('click');
            setTimeout(function(){  $('#Modalok').modal('hide');}, 2500);
          }
          else
          {
            $('#Modalko .debug-url').html('O Utilizador <strong>'+nome+'</strong> nao se consegue apagar.');
            $("#mensagem_ok").trigger('click');
          }
        },
        error:function(data){
          $('#Modalko .debug-url').html('O Utilizador <strong>'+nome+'</strong> não foi apagado, p.f. verifique a ligação Wi-Fi.');
          $("#mensagem_ko").trigger('click');
        }
    });
        }
      },
    }
  });
  }
  
</script>
