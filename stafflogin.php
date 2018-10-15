<?php 
include "scripts/connect_to_mysql.php"; 
if (isset($_POST["submit"])) {

$role = $_POST['role'];
$id = $_POST["id"]; 
$pass = $_POST["password"]; 


		if ($role == 'manager') {
			
			$ActualPassword="12345";
			$Username = "1";
			
			if($pass == $ActualPassword && $id == $Username)
			{
				
				session_start();
				$_SESSION["manager"]="$Username";
				header("location: staff/ecmanager.php");
				exit();
			}
			
			else {
				echo ("<script type='text/javascript'>alert('Sorry Incorrect Username/Password entered! Please re-try...')</script>");
			}
		}
		else if ($role == 'coordinator') {
			if (isset($_POST["id"]) && isset($_POST["password"])) {

			$sql = mysql_query("SELECT * FROM eccoordinator WHERE coordinator_id = '$id' and password='$pass' LIMIT 1"); 
   
				$existCount = mysql_num_rows($sql); 
				if ($existCount == 1) { 
			session_start();	    
		while($row = mysql_fetch_array($sql)){ 
              $_SESSION["coordinatorid"] = $row["coordinator_id"];
			  $_SESSION["coordinatorfaculty"] = $row["faculty"];
		 }
		
		 
		 header("location: staff/eccoordinator.php");
		 
         exit();
				} else {
		echo ("<script type='text/javascript'>alert('Sorry Incorrect Username/Password entered! Please re-try...')</script>");
		
	}
		}

}
}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Greenwich E.C</title>
  <link rel="shortcut icon" href="images/logo.ico">
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
      <a class="navbar-brand" href="index.html"><span><img src="images/seal.png" class="img-circle" width="50" height="35"></span>University of Greenwich </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
		 <li ><a href="index.html">Home</a></li>
         <li><a href="studentlogin.php"><span class="glyphicon glyphicon-user"></span> Student Login</a></li>
         <li class="active"><a href="stafflogin.php"><span class="glyphicon glyphicon-pencil"></span> Staff Login</a></li>
        <li ><a href="adminlogin.php"><span class="glyphicon glyphicon-stats"></span> Admin Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div align="center">
<img  class="img-responsive"  src="images/seal.png" width="150" height="150;" />
</div>

<div class="container">
  <h2>Staff Login</h2>
  <form class="form-horizontal" action="stafflogin.php" method="post">
   
   <div class="form-group">
   <label class="radio-inline control-label col-sm-3"><input type="radio" value= 'manager' name="role" required>E.C Manager</label>
<label class="radio-inline control-label col-sm-3"><input type="radio" value= 'coordinator' name="role" required>E.C Coordinator</label>
   </div>
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="id">Staff ID:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="id" id="id" placeholder="Enter Staff ID" required/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" minlength="4" class="form-control" name="password" id="pwd" placeholder="Enter password" required/>
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

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


