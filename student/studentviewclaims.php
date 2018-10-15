<?php
session_start();
if (!isset($_SESSION["studentid"])){
header("location: ../studentlogin.php");

exit();
}
 $student = $_SESSION["studentid"];
include "../scripts/connect_to_mysql.php"; 

$sql = mysql_query("SELECT * FROM closuredates ");
$Acount = mysql_num_rows($sql); 

if($Acount > 0){

while($row =mysql_fetch_array($sql)){

$date =$row["closuredate"];
$date2 =$row['finalclosuredate'];
}
}

$cdate = date("Y-m-d");

if ($cdate > $date2){
$dis = 'disabled';
}else{
	$dis='';
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



		
        
       
      
<div class="container">
  <h2>View Claims</h2>
  <h4>Final Closure Date for Evidence Upload is: <u style="color:RED"><i>'<?php echo $date2; ?>'</i></u></h4>
  <p>(claims without evidence will be not be processed, click claim id to upload an evidence) <br>
  
  </p>
  
  <?php

$claim_list="";
$sql = mysql_query("SELECT * FROM ecclaims where student_id='$student'");
$claimCount = mysql_num_rows($sql); 

if($claimCount > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>Claim ID</th>
		<th>Claim Description</th>
        <th>Claim Evidence</th>
		<th>Claim Status</th>
		<th>Item of Assessment Name</th>
		<th>Date</th>
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$id =$row["claim_id"];
$desc =$row["claim_description"];
$evd =$row['evidence_name'];
$status =$row['claim_status'];
$course =$row['course_id'];
$date =$row['date'];



echo "<tr>";

echo "<td> <a href=\"editclaims.php?eid=$id\" title=\"Edit\" class=\"btn btn-warning\" role=\"button\" $dis>$id</a>   </td>";
echo "<td>" . $desc . "</td>";
echo "<td> <a href=\"claimdownload.php?cid=$id\" title=\"Download\">$evd</a>   </td>";
echo "<td>" . $status . "</td>";
echo "<td>" . $course . "</td>";
echo "<td>" . $date . "</td>";

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
   <a href="studentclaims.php" class="btn btn-info" role="button">Back</a>
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


