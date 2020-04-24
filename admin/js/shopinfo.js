


function shopDefinitions(){
  dataValue='action=3';
  $.ajax({ url:'../admin/definitions/action_definitions.php',
    data:dataValue,
    type:'POST', 
    success:function(data){
    localStorage.setItem("shopDef", data);    
    setTimeout(function(){ move(); }, 500);
    },
    error:function(){}
});
}











