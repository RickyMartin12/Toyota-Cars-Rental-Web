

<?php
 
 // DataTables PHP library
 
 include $_SERVER['DOCUMENT_ROOT'] . "/carros_toyota_reserva/admin/php/DataTables.php";
  
 use
 DataTables\Database,
 DataTables\Database\Query,
 DataTables\Database\Result;
 
 
 
         $RAW_SQL_QUERY="SELECT *, hora_reserva as tstp FROM reserva ORDER BY data_reserva";        
         $r=$db->sql($RAW_SQL_QUERY)->fetchAll();
 
         $arr=array("data"=>$r,"options"=>'',"files"=>'');//DATATABLE CLIENT SIDE PARSES
         
         echo json_encode($arr);
 
 
 
 exit();
 