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
   $sql = 'SELECT id, roll, feedback, id_relation, created_at  FROM feedback';
   
   mysql_select_db('userdb');

   $retval = mysql_query( $sql, $conn );
   
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }

   
?>

<!Doctype html>
<html>
<head>
   <title>Feedback</title>
   <link rel ="stylesheet" href="style.css" >
   <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
  
</head>
<body>
   <h1>Feedback Table</h1>
   <a role="button" href="logout.php" class="btn btn-primary">Logout</a>


   <?php
      echo "<section>";
      echo "<div class='header_table'>";
      echo "<table>";
         echo "<thead>";
            echo "<tr>";
               echo "<th width ='8%'>S.No.</th><th>Lecturer</th><th width='30%'>Feedback</th><th>Student</th>
               <th width='10%'>Date</th><th width ='10%'>Time</th>";   
            echo "</tr>";
         echo "</thead>";
      echo "</table>";
      echo "</div>";
      $count = 0;

      echo "<div class ='content_table'>";
      echo "<table>";
         while ($row = mysql_fetch_array($retval, MYSQL_ASSOC) ) {
            
            echo "<tr>";
            $count = $count + 1;
            echo "<td width ='8%'>".$count."</count>";         
            $new = $row['id_relation'];

            $sql1 = "SELECT id, speaker_name  FROM lectures WHERE id = '$new'";
            mysql_select_db('userdb');
            $retval1 = mysql_query( $sql1, $conn );
            if(! $retval1 ) {
               die('Could not get data: ' . mysql_error());
            }
   
            $row1 = mysql_fetch_array($retval1, MYSQL_ASSOC);
               echo "<td>" .$row1['speaker_name']."</td>";

            echo "<td width='30%'>".$row['feedback']."</td>";
            echo "<td>".$row['roll']."</td>";
            $d = strtotime($row['created_at']);
            echo "<td width ='10%'>".date('d M Y',$d)."</td>";
            echo "<td width ='10%'>".date('h:i A',$d)."</td>";
            echo "</tr>";
         }
      echo "</table>";
      echo "</div>";
      echo "</section>";
   ?>
<div class="copyright">
     &copy Institute Mobops
</div>

</body>
</html>   
