<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 
if (isset($_GET['sid'])){
$targetID = $_GET['sid'];
}else{
	header("location: studentsedit.php");
}
if (isset($_POST['submit'])) {
	if ($_POST["password"] == $_POST["cpassword"]) {
   
	$id = $_POST['thisID'];
	$password = $_POST['password'];
	$passmd = md5($password);
   
	
	$sql = mysql_query("UPDATE student SET password='$passmd' where student_id='$id'") or die (mysql_error());
		
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Password Changed')
    window.location.href='studentsedit.php';
    </SCRIPT>");
	
	} else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Passwords do not match')
    window.location.href='studentpass.php';
    </SCRIPT>");
	
}
     
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Greenwich E.C</title>
  <link rel="shortcut icon" href="../images/logo.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand" href="admin.php"><span><img src="../images/seal.png" class="img-circle" width="50" height="35"></span>University of Greenwich </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"></ul>
      <ul class="nav navbar-nav navbar-right">
        
		 
			
		
	<li><a>Admin ID:<?php echo $_SESSION["admin"]; ?></a></li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



		
        
       
      
<div class="container">

  <h2>Edit Student Password</h2>
        
  <form method="post" action="studentpass.php">
    <div class="form-group">
    <label for="pwd">New Password:</label>
    <input type="password" minlength="4" name="password" class="form-control" id="pwd" required>
  </div>
   <div class="form-group">
    <label for="pwd1">Confirm Password:</label>
    <input type="password" minlength="4" name="cpassword" class="form-control" id="pwd1" required>
	<span id='message'></span>
	
  </div>
  <SCRIPT >
    $('#pwd, #pwd1').on('keyup', function () {
    if ($('#pwd').val() == $('#pwd1').val()) {
        $('#message').html('').css('color', 'green');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
		
});
    </SCRIPT>
 
  
  <button type="submit" name="submit" id="button" class="btn btn-info">Submit</button>
  <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" /> 
  <a href="studentsedit.php" class="btn btn-default col-sm-offset-1" role="button">Back</a>
</form>
  
</div>
<br>
<br>




<style>
.bg-4 { 
    background-color: #2f2f2f;
    color: #ffffff;
}
</style>

<footer class="container-fluid bg-4 text-center">
  <p><a href="http://www2.gre.ac.uk/">University of Greenwich</a></p> 
</footer>  
</body>
</html>


