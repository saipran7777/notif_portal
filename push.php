<?php	
	include("session.php");
	$_SESSION['login_user'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Notification</title>
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" type="text/css" href="push.css" >
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<h1>Push Notifications</h1>

<div class="alert alert-success" id="success" style="display: none;">Notification Sent Successfully.</div>
<div class="alert alert-danger" id="danger" style="display: none;">Error Sending Message.</div> 

<div class="container">
<form id="form">

	<div class="form-group row">
		<label for="topic">User</label>	
		<input type="text" class="form-control" readonly = "readonly" id="topic"  placeholder="Topic" value = "<?php echo $_SESSION['login_user'] ?>">
	</div>
	<?php 
		 if ($_SESSION['login_user'] == "admin"){
		 	echo "<div class ='form-group row'>";
			echo "<label>Topic</label>";
			echo "<select class='form-control' readonly = 'readonly'>";
				echo "<option>Select</option>";
				echo "<option>EML</option>";
				echo "<option>T5E</option>";
				echo "<option>SCHROETER</option>";
				echo "<option>ELECTION</option>";
				echo "<option>GENERAL</option>";
			echo "</select>";
			echo "</div>";
		 }	
	?>

	<div class="form-group row">
		<label for="title">Title of Notification</label>
		<input type="text" class="form-control" id="title" placeholder="Title">
	</div>
	<div class="form-group row">
		<label for="content">Content of Notification</label>
		<textarea type="text" class="form-control" id="content"placeholder ="Content"></textarea>
	</div>
</form>
	<div class="text-center">
	<div class="btn-group">
	
	<button id="send" class="btn btn-primary" style="border-radius:5px 0px 0px 5px;">Send</button>
	<button id="refresh" class="btn btn-primary">Refresh</button>
		<?php 
			if ($_SESSION['login_user']== "eml"){	
			echo "<a role ='button' href='test_1.php' class='btn btn-primary'>Lecture</a>";
			echo "<a role ='button' href='question.php' class='btn btn-primary'>Question</a>";
			echo "<a role ='button' href='feedback.php' class='btn btn-primary'>Feedback</a>";
			}
		?>
		<?php 
			if ($_SESSION['login_user']== "admin" ){
			echo "<a role ='button' href='test_1.php' class='btn btn-primary'>Lecture</a>";
			echo "<a role ='button' href='question.php' class='btn btn-primary'>Question</a>";
			echo "<a role ='button' href='feedback.php' class='btn btn-primary'>Feedback</a>";
			}
		?>
		
	<a role ='button' href='logout.php' class='btn btn-primary' style="border-radius:0px 5px 5px 0px;">Logout</a>
	
	</div>
	</div>
	
</div>
<div class="copyright">
     &copy Institute Mobops
</div>

<!-- jquery -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">

	console.log("Executing script");

	document.getElementById("send").onclick = function(){
		console.log("Click Event");

		var topic = document.getElementById("topic").value;
		var title = document.getElementById("title").value;
		var content = document.getElementById("content").value;
		var link = 'https://fcm.googleapis.com/fcm/send';

		var successMsg = document.getElementById("success");
		var errorMsg = document.getElementById("danger");

    xhr = new XMLHttpRequest();
    xhr.open("POST", link, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.setRequestHeader("Authorization", 
                        "key=AAAAYcotsXc:APA91bEMKXX0Yd-kyohNf9yiAeIvrp7fP7m-BN2kTIdkVe4H6DJRQ-MCradcbkVEhLCgEMN4K1TgbOS8AMv5ZmrXzMNhmofQg3MxxDffrlSznsdjm5zi10RkTi8301GHIqpz3UGzZXIyv6Tpb3mQ44b-c7Ya94Rlpg");
    
    xhr.onreadystatechange = function () { 
    	console.log("Response");
    	var json = JSON.parse(xhr.responseText);
      console.log(json);
      console.log(xhr.status);

      if(xhr.status === 200 && !json.hasOwnProperty('error') ){
      	successMsg.style.display = 'block'; 
      }else {
      	errorMsg.style.display = 'block';
      	if (json.hasOwnProperty('error')){
      		errorMsg.innerHTML = errorMsg.innerHTML + " " + json.error;
      	}
      }
		}

	var data = JSON.stringify({
      "to": "/topics/"+topic,
       "notification": {
         "title": title,
         "body": content
       }
    });
    console.log(data);

    console.log("Sending Request...");
    xhr.send(data);
	}

	document.getElementById('refresh').onclick = function() {
		document.getElementById('form').submit();
	}
</script>	
</body>
</html>

