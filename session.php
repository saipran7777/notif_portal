<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"SELECT name from userdb where name = '$user_check' ");
  
  	if (!$ses_sql) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>