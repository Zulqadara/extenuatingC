<?php
session_start();
if (!isset($_SESSION["studentid"])){
header("location: ../studentlogin.php");

exit();
}
 $student = $_SESSION["studentid"];
 $faculty = $_SESSION["student_faculty"];
 
 
include "../scripts/connect_to_mysql.php"; 


error_reporting(E_ALL);
ini_set('display_errors','0');


$sql = mysql_query("SELECT * FROM closuredates ");
$Acount = mysql_num_rows($sql); 

if($Acount > 0){

while($row =mysql_fetch_array($sql)){

$date =$row["closuredate"];
$date2 =$row['finalclosuredate'];
}
}

$cdate = date("Y-m-d");

if ($cdate > $date){
$dis = 'disabled';
}	

?>

<?php
if (isset($_POST["code"])) {
	
	$claim=$_POST["claim"];
	$code=$_POST["code"];
$filename=$_FILES['evidence']['name'];
$date = date("Y-m-d");
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if($ext=='jpg' || $ext=='pdf' || $ext=='' )
{

$ffile = fopen($_FILES['evidence']['tmp_name'],"rb");
    $contents = fread($ffile,$_FILES['evidence']['size']);
    $fileupload = mysql_escape_string($contents);
    $sql = "INSERT INTO ecclaims SET claim_description = '$claim',
	claim_status='pending',
	faculty='$faculty',
	student_id='$student',
	course_id='$code',
	date='$date',
	ddate='',
	evidence_name = '" . $filename . "',
	claim_evidence = '" . $fileupload . "' ";
    mysql_query($sql);
	include "mail.php"; 
	echo ("<script type='text/javascript'>alert('Claim Submitted')</script>");


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
	  <a href="studentviewclaims.php" class="btn btn-primary col-sm-offset-10" role="button">View/Edit Claims</a>
  <h2>Submit Claims</h2>
  <h4>(claims will get disbaled after the closure date: <u style="color:RED"><i>'<?php echo $date; ?>'</i></u>, however uploads can be done until: <u style="color:RED"><i>'<?php echo $date2; ?>'</i></u>)</h4>
        
<form method="post" action="studentclaims.php" enctype="multipart/form-data">
 <div class="form-group">
  <label for="sel1">Unit Code:</label>
  <select class="form-control" name="code" id="sel1" required>
   <?php 
		$sql = mysql_query("SELECT item_code FROM items_of_assesment");
		while ($row = mysql_fetch_array($sql)){
		echo '<option value="'. $row['item_code'] . '">' . $row['item_code'] .'</option>';
		}
	?>
  </select>
</div>
<div class="form-group">
  <label for="comment">Claim:</label>
  <textarea class="form-control" rows="5" name="claim" maxlength="250" placeholder="Write your claim here. (250 characters max)." id="comment" required></textarea>
</div>
  <div class="form-group">
    <label for="evd">Upload Evidence:</label>
    <input type="file" name="evidence" class="form-control" id="evd" accept=".pdf,.jpg"/>
  </div>
  
 <button type="submit" class="btn btn-info" <?php echo $dis; ?> >Submit</button>
 <a href="studentportal.php" class="btn btn-default col-sm-offset-1" role="button">Back</a>
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


