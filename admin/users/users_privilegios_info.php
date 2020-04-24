





<div class="cont_page">
<div class="container">
<div class="row">
            <h2><center>Sistemas de Privilegios de Tipos de Utilizadores</center></h2>
            <div id="show_privileges">
			    
			</div>
		</div>
	</div>
</div>
    
    
</div>
</div>



<script src="js/bootbox.min.js"></script>
<script src="js/momentjs/moment-with-locales.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/select2.full.min.js"></script>
<script src="js/bootstrap-switch.min.js"></script>




<script>
  setTimeout(function() {$(".back").fadeOut();});
  
  
  // Carregamento de Switches do Bootstrap
  
  
  
  showPrivileges();
  
  
  function showPrivileges()
  {
      var s = "";
  dataValue="&action=4";
  $.ajax({ url:'users/users_action.php',
    data:dataValue,
    type:'POST', 
     success:function(data){
     arr=[];
     arr =  JSON.parse(data);
     //console.log(data);
    if (arr == null || arr.length < 1){
     $('.debug-url').html('Nao existe a Utilizadores');
     $("#mensagem_ko").trigger('click');
     $('#show_users').empty();
    }
    else {
        
        for (i=0; i < arr.length; i++)
        {
            s += '<tr class="action-privileges"><td scope="row">'+arr[i].tipo+'</td><td><input id="carro_novo_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].carro_novo_pri+' data-on-color="success"></td><td><input id="carro_pes_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].carro_pes_pri+' data-on-color="success"></td><td><input id="modelo_novo_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].modelo_novo_pri+' data-on-color="success"></td><td><input id="modelo_pes_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].modelo_pes_pri+' data-on-color="success"></td><td><input id="comentarios_list_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].comentarios_list_pri+' data-on-color="success"></td><td><input id="reserva_list_pri-'+arr[i].tipo+'" type="checkbox" data-size="mini" data-off-color="danger" '+arr[i].reserva_list_pri+' data-on-color="success"></td></tr>';      
        }

          
      
      
      
      
    $('#show_privileges').html('<div class="table-responsive"><table class="table"><thead style="background-color: #333; color: #fff;"><tr><th></th><th>Menu - Novo Carro</th><th>Menu - Carro Pesquisa</th><th>Menu - Modelo Novo</th><th>Menu - Modelo Lista</th><th>Menu - Comentario Lista</th><th>Menu - Reserva Lista</th></tr></thead><tbody>'+s+'</tbody></table></div><script>$(".bootstrap-switch-label").addClass("disabled");$("input").on("switchChange.bootstrapSwitch", function(event, state) {menu = this.id;state == true ? is_checked = "checked" : is_checked = "false" ;dataValue = "action=5&tipo="+menu+"&estado="+is_checked;  $.ajax({ url:"users/users_action.php",data:dataValue,type:"POST",success: function(data){    if (data == 0){$(".debug-url").html("Erro ao atribuir o privilégio, p.f. tente novamente.");$("#mensagem_ko").trigger("click");} else if (data==1){$(".debug-url").html("Os Privilegios foram modificados com sucesso");$("#mensagem_ok").trigger("click");}},error: function(){$(".debug-url").html("Não foi possivel obter os dados privilégios, p.f. verifique a ligação Wi-Fi.");$("#mensagem_ko").trigger("click");}});});');    
    
    
    for (i=0; i < arr.length; i++)
    {
        $("#carro_novo_pri-"+arr[i].tipo+", #carro_pes_pri-"+arr[i].tipo+", #modelo_novo_pri-"+arr[i].tipo+", #modelo_pes_pri-"+arr[i].tipo+", #comentarios_list_pri-"+arr[i].tipo+", #comentarios_list_pri-"+arr[i].tipo+", #reserva_list_pri-"+arr[i].tipo).bootstrapSwitch();
    }
    
    }
    
    

    },
    error:function(data){
     $('.debug-url').html('Erro ao obter os Utilizadores, p.f. verifique a ligaПлоПлкo.');
     $("#mensagem_ko").trigger('click');
    }
  });
}

 
 
  
  
</script>