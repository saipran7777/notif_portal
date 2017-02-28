<?php
   include("session.php");
   $_SESSION['login_user'];
   
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
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
?>

<!DOCTYPE html>
<html>

  <head>
    <title>EML</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    
  </head>

  <body>
    
    <h1>Extra Mural Lectures</h1>
    <a role="button" href="logout.php" class="btn btn-primary">Logout</a>
    <?php
      echo "<section>";
      echo "<div class='header_table'>";
      echo "<table>";
      echo "<thead><tr><th width ='20%'>Serial Number</th><th>Lecturer</th><th width ='20%'>Current Status</th></tr></thead>";
      echo "</table>";
      echo "</div>";
      $count = 0;
      echo "<div class ='content_table' >";
      echo "<table>";
      while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
        echo "<tr>";
          $count = $count + 1;
          echo "<td width ='20%'> ".$count." </td> ";
          echo "<td>".$row['name']."</td> ";
          if ($row['status'] == "1") {
            echo "<td width ='20%'><label class='switch'> <input eid='".$row['id']."' status='".$row['status']."' id ='blue' class='toggle' type='checkbox' checked><div class='slider round'></div></label></td>";
          }
          else{
            echo "<td width='20%'><label class='switch'><input eid ='".$row['id']."' status='".$row['status']."' class='toggle' type='checkbox'><div class='slider round'></div></label></td>";
          }
        echo "</tr>";
      }
    echo "</table>";
    echo "</div>";
    echo "</section>"; 
    ?>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript">
      $('.toggle').bind('change',function() {
        var id = $(this).attr('eid') ; 
        var status = $(this).attr('status') ; 
        if (status == 0) {status = 1;} else{status = 0;};
        console.log("ID"+id+"Status"+status);
        $.ajax({
        method: "POST",
        url: "http://localhost/test_2.php",
        data:{id:id, status:status},  
        success: function(result){alert("Updated Successfully");},
        error: function(e){alert("OOOOPS!!!");}      
        });
      }); 
  </script>

  <div class="copyright">
     &copy Institute Mobops
  </div>
  </body>
</html> 
