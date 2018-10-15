<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 

if (isset($_POST['name'])) {
	if ($_POST["password"] == $_POST["cpassword"]) {
   

    $fname = mysql_real_escape_string($_POST['name']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$email = $_POST['email'];
	$faculty = $_POST['faculty'];
	$password = $_POST['password'];
	$passmd = md5($password);
   

   $sql = mysql_query("SELECT student_email FROM student WHERE student_email='$email' LIMIT 1");
	$studentMatch = mysql_num_rows($sql); 
    if ($studentMatch > 0) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sorry you tried duplicating that Student Email, Please try again')
    window.location.href='studentsreg.php';
    </SCRIPT>");
		exit();
	}
	
	
	$sql = mysql_query("INSERT INTO student (faculty, student_first_name, student_last_name, password, student_email) 
        VALUES('$faculty', '$fname', '$lname', '$passmd', '$email')") or die (mysql_error());
		
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Student Registered')
    window.location.href='studentsreg.php';
    </SCRIPT>");
	} else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Passwords do not match')
    window.location.href='studentsreg.php';
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
<a href="studentsedit.php" class="btn btn-primary col-sm-offset-10" role="button">View and Edit Students</a>
  <h2>Register Student</h2>
        
  <form method="post" action="studentsreg.php">
  <div class="form-group">
    <label for="name">Student First Name:</label>
    <input type="text" name="name" class="form-control" id="name" required>
  </div>
   <div class="form-group">
    <label for="name1">Student Last Name:</label>
    <input type="text" name="lname" class="form-control" id="name1" required>
  </div>
  <div class="form-group">
  <label for="faculty">Faculty:</label>
  <select class="form-control" id="faculty" name="faculty" multiple required>
    <option value = "Business">Business</option>
                                <option value = "IT">IT</option>
                                 <option value = "Accounts">Accounts</option>

  </select>
</div>
 
   
  <div class="form-group">
    <label for="pwd">Password:</label>
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
  <div class="form-group">
    <label for="email">E-Mail:</label>
    <input type="email" name="email" class="form-control" id="email" required>
  </div>
  
  <button type="submit" id="button" class="btn btn-info">Submit</button>
  <a href="admin.php" class="btn btn-default col-sm-offset-1" role="button">Back</a>
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


