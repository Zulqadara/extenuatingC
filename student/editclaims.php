<?php
session_start();
if (!isset($_SESSION["studentid"])){
header("location: ../studentlogin.php");

exit();
}
 $student = $_SESSION["studentid"];
 $faculty = $_SESSION["student_faculty"];
include "../scripts/connect_to_mysql.php"; 

//error_reporting(E_ALL);
//ini_set('display_errors','0');

?>

<?php

if (isset($_GET['eid'])){
	$targetID = $_GET['eid'];
}

if (isset($_POST["submit"])) {
	
$id = $_POST["thisID"];	
$filename=$_FILES['evidence']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if($ext=='jpg' || $ext=='pdf' || $ext=='' )
{

$ffile = fopen($_FILES['evidence']['tmp_name'],"rb");
    $contents = fread($ffile,$_FILES['evidence']['size']);
    $fileupload = mysql_escape_string($contents);
    $sql = "UPDATE ecclaims SET
	evidence_name = '" . $filename . "',
	claim_evidence = '" . $fileupload . "' WHERE `claim_id` ='" .$id. "'";
    mysql_query($sql);
header("location: studentviewclaims.php");

}
else
{
echo ("<script type='text/javascript'>alert('Enter only a JPG or a PDF file...')</script>");

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
      <a class="navbar-brand" href="studentportal.php"><span><img src="../images/seal.png" class="img-circle" width="50" height="35"></span>University of Greenwich </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"></ul>
      <ul class="nav navbar-nav navbar-right">
        
		 
	<li><a>Student ID:<?php echo $_SESSION["studentid"]; ?></a></li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



		
        
       
      <div class="container" >
	  
  <h2>Upload Evidence</h2>
        
<form method="post" action="editclaims.php" enctype="multipart/form-data">
 
  <div class="form-group">
    <label for="evd">Upload Evidence:</label>
    <input type="file" name="evidence" class="form-control" id="evd" accept=".pdf,.jpg" />
	
  </div>
  <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" /> 
 <button type="submit" name="submit" class="btn btn-info">Submit</button>
 <a href="studentviewclaims.php" class="btn btn-default col-sm-offset-1" role="button">Back</a>
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


