<?php
session_start();
if (!isset($_SESSION["manager"])){
header("location: ../stafflogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 


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
      <a class="navbar-brand" href="ecmanager.php"><span><img src="../images/seal.png" class="img-circle" width="50" height="35"></span>University of Greenwich </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"></ul>
      <ul class="nav navbar-nav navbar-right">
        
		
			
	<li><a href="adminlogin.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



		
        
       
      
<div class="container">
  <h2>View Claims</h2>
  
<?php

$claim_list="";
$sql = mysql_query("SELECT * FROM ecclaims ORDER BY DATE DESC");
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
		<th>Status</th>
		<th>Date</th>
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
$status =$row['claim_status'];
$date =$row['date'];



echo "<tr>";
echo "<td>" . $id . "</td>";
echo "<td>" . $desc . "</td>";
echo "<td>" . $facl . "</td>";
echo "<td>" . $std . "</td>";
echo "<td>" . $course . "</td>";
echo "<td> <a href=\"claimdownload.php?cid=$id\" title=\"Download\">$evd</a>   </td>";
echo "<td>" . $status . "</td>";
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


