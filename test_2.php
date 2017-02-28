<?php

   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) { 
      die('Could not connect: ' . mysql_error());
   }
   $sql = 'SELECT id, name, status FROM db';
   mysql_select_db('userdb');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ){
      die('Could not get data: ' . mysql_error());
   }

  $id = $_POST['id'];
  $status = $_POST['status'];
            
  $sql = "UPDATE db SET status = '$status' WHERE id = '$id'" ;

  mysql_select_db('userdb');
  
  $retval = mysql_query( $sql, $conn );    
  
  if(! $retval ) {
    die('Could not update data: ' . mysql_error());
  }
  echo "Updated data successfully\n";
?>


