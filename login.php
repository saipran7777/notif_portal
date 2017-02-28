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
    <title>Login</title> 
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <style type = "text/css">
    body{
      background-color:#f4f6f7 ;
      font-family: "Lato", serif;
    }
    h1{
      color: black;
      font-weight: bolder;
      text-align: center;
      margin-top: 100px;  
    }
          
    form {     
      padding: 10px;
      margin-left: 300px;
      margin-right: 300px;
      margin-top:50px; 
    }

    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      border-radius: 5px;
      font-family: "Lato", serif; 
    }

    button {
      background-color:#1996d4;
      color: white;
      padding: 10px 18px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
      font-family: "Lato", serif; 
    }
    button:hover{
      background-color: #007299;
    }

    .container {
      padding: 20px;
      margin-right: 50px;
      margin-left: 50px;
      font-family: "Lato", serif; 
    }
    </style>  
  </head>
   
<body> 
  <h1>Notification Portal</h1>

  
  <form action="" method ="post">
  
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
      
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>        
    </div>

    <div class="container">
      <button type="submit">Login</button>
    </div>
    
    <div style = "font-size:11px; color:#cc0000; margin-top:10px; text-align:center;">
      <?php 
      if($check == 0 )
        echo $error;
      ?>
    </div>

  </form>
  
  <div class="copyright" style="text-align: center ;
  color: black;
  margin-top: 50px;">
     &copy Institute Mobops
  </div>


</body>
</html>

