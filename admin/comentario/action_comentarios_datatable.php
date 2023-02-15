

<?php
 
 // DataTables PHP library
 
 include $_SERVER['DOCUMENT_ROOT'] . "/admin/php/DataTables.php";
  
 use
 DataTables\Database,
 DataTables\Database\Query,
 DataTables\Database\Result;
 
 
 
         $RAW_SQL_QUERY="SELECT *, data as tstp FROM comentarios ORDER BY data";   
         
              
         $r=$db->sql($RAW_SQL_QUERY)->fetchAll();
 
         $arr=array("data"=>$r,"options"=>'',"files"=>'');//DATATABLE CLIENT SIDE PARSES
         
         echo json_encode($arr);
 
 
 
 exit();
 