<?php
session_start();
if (!isset($_SESSION["coordinatorid"])){
header("location: ../stafflogin.php");

exit();

}
$fac = $_SESSION["coordinatorfaculty"];
include "../scripts/connect_to_mysql.php"; 

$ddate = date("Y-m-d");

if (isset($_POST['app'])) {
	
    $des = $_POST['app'];
	$cid = $_POST['thisID'];
	$stid = $_POST['stdID'];
	
	
	
			
	$sql = mysql_query("UPDATE ecclaims SET claim_status='$des' , ddate='$ddate' where claim_id='$cid'") or die (mysql_error());
	
		
			$sql2 = mysql_query("SELECT * FROM student where student_id='$stid' ");
		$Acount = mysql_num_rows($sql2); 

		if($Acount > 0){

		while($row =mysql_fetch_array($sql2)){

		$emailc =$row["student_email"];
		}
		}

		$to      = "$emailc";
		$subject = 'EC Decision';
		$message = "The claim you submitted has been reviewed. The claim was Approved";
		$headers = 'From: EC System' . "\r\n" .
			'Reply-To: ' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		if(mail($to, $subject, $message, $headers)) {
			echo 'Email sent successfully!';
		}
			else {
				die('Failure: Email was not sent!');
			}	

		
		header("location: eccoordinatorclaim.php");
     
}else if (isset($_POST['rej'])) {
	
    $des = $_POST['rej'];
	$cid = $_POST['thisID'];
	$stid = $_POST['stdID'];
	
	$sql = mysql_query("UPDATE ecclaims SET claim_status='$des', ddate='$ddate' where claim_id='$cid'") or die (mysql_error());
	$sql2 = mysql_query("SELECT * FROM student where student_id='$stid' ");
		$Acount = mysql_num_rows($sql2); 

		if($Acount > 0){

		while($row =mysql_fetch_array($sql2)){

		$emailc =$row["student_email"];
		}
		}

		$to      = "$emailc";
		$subject = 'EC Decision';
		$message = "The claim you submitted has been reviewed. The claim was Rejected";
		$headers = 'From: EC System' . "\r\n" .
			'Reply-To: ' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		if(mail($to, $subject, $message, $headers)) {
			echo 'Email sent successfully!';
		}
			else {
				die('Failure: Email was not sent!');
			}	
	header("location: eccoordinatorclaim.php");
		
		
		
     
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
      <a class="navbar-brand" href="eccoordinator.php"><span><img src="../images/seal.png" class="img-circle" width="50" height="35"></span>University of Greenwich </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"></ul>
      <ul class="nav navbar-nav navbar-right">
        
		<li><a>Coordinator ID:<?php echo $_SESSION["coordinatorid"]; ?></a></li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



		
        
       
      
<div class="container">
  <h2>Access Claims</h2>
        
 <?php

$claim_list="";
$sql = mysql_query("SELECT * FROM ecclaims where faculty='$fac' and claim_status='pending' and claim_evidence!=''");
$claimCount = mysql_num_rows($sql); 

if($claimCount > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>Claim ID</th>
		<th>Description</th>
		<th>Faculty</th>
        <th>Student ID</th>
		<th>Assessment Name</th>
		<th>Evidence</th>
		
		<th>Date</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$id =$row["claim_id"];
$desc =$row["claim_description"];
$facl =$row["faculty"];
$std =$row["student_id"];
$course =$row['course_id'];
$evd =$row['evidence_name'];

$date =$row['date'];



echo "<tr>";
echo "<td>" . $id . "</td>";
echo "<td>" . $desc . "</td>";
echo "<td>" . $facl . "</td>";
echo "<td>" . $std . "</td>";
echo "<td>" . $course . "</td>";
echo "<td> <a href=\"claimdownload.php?cid=$id\" title=\"Download\">$evd</a>   </td>";

echo "<td>" . $date . "</td>";
echo "<td>
                                  <div class=\"btn-group\">
								  <form action=\"eccoordinatorclaim.php\" method=\"post\">
                                  <button type=\"submit\" name=\"app\" value=\"approved\" class=\"btn btn-primary\">Approve</button>
                                  <button type=\"submit\" name=\"rej\" value=\"rejected\" class=\"btn btn-danger\">Reject</button>
								  <input name=\"thisID\" type=\"hidden\" value=".$id." />
									<input name=\"stdID\" type=\"hidden\" value=".$std." /> 
                                  </div>
								  </form>
                                  </td>
                              ";

echo "</tr>";


							  
							

}
echo " </tbody>
                        </table>";
}else{

$claim_list = "You have no Claims in the system yet";

}

?>
  <?php echo $claim_list; ?>
  <br>
  <a href="eccoordinator.php" class="btn btn-info" role="button">Back</a>
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


