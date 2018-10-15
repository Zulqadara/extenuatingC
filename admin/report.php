<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 

$aList="";
$sql = mysql_query("SELECT count(*) as count from ecclaims where evidence_name = '';");
$aClaim = mysql_num_rows($sql); 

if($aClaim > 0){

while($row =mysql_fetch_array($sql)){
$aList =$row['count'];
}
}else{

$aList = "0";

}

$bList="";
$sql = mysql_query("SELECT COUNT(DATEDIFF(`ddate`,`date`)) as diff from ecclaims where DATEDIFF(`ddate`,`date`) > 14");
$bClaim = mysql_num_rows($sql); 

if($bClaim > 0){

while($row =mysql_fetch_array($sql)){
$bList =$row['diff'];
}
}else{

$bList = "0";

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
      
      <ul class="nav navbar-nav navbar-right">
        
		 
			
	<li><a>Admin ID:<?php echo $_SESSION["admin"]; ?></a></li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

      
<div class="container">
  <h2>Reports</h2><br>
 <h4>Claims without upload evidence:  <b style="color:BLUE"><?php echo $aList; ?></b></h4>
 <?php

$cList="";
$sql = mysql_query("SELECT * from ecclaims where evidence_name = ''");
$aClaim = mysql_num_rows($sql); 

if($aClaim > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>ID</th>
		<th>Student ID</th>
		<th>Course</th>
		<th>Faculty</th>
        <th>Date</th>
		
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$id =$row["claim_id"];
$std =$row['student_id'];
$crs =$row['course_id'];
$fac =$row['faculty'];
$date =$row['date'];




echo "<tr>";
echo "<td>" . $id . "</td>";
echo "<td>" . $std . "</td>";
echo "<td>" . $crs . "</td>";
echo "<td>" . $fac . "</td>";
echo "<td>" . $date . "</td>";
echo "</tr>";
}
echo " </tbody>
                        </table>";
}else{

$cList = "You have no Claims in the system yet";

}

?>
  <?php echo $cList; ?>
<br>

 <h4>Cliams without a decision after 14 days:  <b style="color:BLUE"><?php echo $bList; ?></b></h4>
 <?php

$dList="";
$sql = mysql_query("SELECT *,DATEDIFF(`ddate`,`date`) as diff from ecclaims where DATEDIFF(`ddate`,`date`) > 14");
$dClaim = mysql_num_rows($sql); 

if($dClaim > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>ID</th>
		<th>Student ID</th>
		<th>Course</th>
		<th>Faculty</th>
        <th>Date</th>
		
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$id =$row["claim_id"];
$std =$row['student_id'];
$crs =$row['course_id'];
$fac =$row['faculty'];
$date =$row['date'];




echo "<tr>";
echo "<td>" . $id . "</td>";
echo "<td>" . $std . "</td>";
echo "<td>" . $crs . "</td>";
echo "<td>" . $fac . "</td>";
echo "<td>" . $date . "</td>";
echo "</tr>";
}
echo " </tbody>
                        </table>";
}else{

$dList = "You have no Claims in the system yet";

}

?>
  <?php echo $dList; ?>
  <br>
  <a href="reports.php" class="btn btn-info" role="button">Back</a>

 
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



