<?php
   include("config.php");
   session_start();

   $error = "Your Login Name or Password is invalid";
   $check = 1;
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM userdb WHERE name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];  


      $count = mysqli_num_rows($result);
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         header("location:push.php");
      }else {
         $check = 0;
      }
   }
?>

<html>
   
  <head>
    <title>Login Page</title> 
    <link rel="stylesheet" href ="login.css">
  </head>
   
<body> 
  <h2>Login</h2>
  
  <form action="" method ="post">
  
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
      
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>        
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="submit">Login</button>
    </div>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px">
      <?php 
      if($check == 0 )
        echo $error;
      ?>
    </div>

  </form>

</body>
</html>

