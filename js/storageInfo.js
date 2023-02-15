function GetCarroNome(){
  dataValue='action=5';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("Carro", data);    
    },
    error:function(){}
});
}

function GetModeloNome(){
  dataValue='action=6';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("Modelo", data);    
    },
    error:function(){}
});
}


function GetIDModelo(){
  dataValue='action=7';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("ID_Modelo", data);    
    },
    error:function(){}
});
}

function GetIDUsername(){
  dataValue='action=8';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("Username", data);    
    },
    error:function(){}
});
}

function GetTituloComentario(){
  dataValue='action=9';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("Titulo", data);    
    },
    error:function(){}
});
}

