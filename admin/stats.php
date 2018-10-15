<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

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
  <h2>Statistics</h2><br>
  
  <h4>Yearly Claims with in each Faculty:</h4>
  <?php

$aList="";
$sql = mysql_query("SELECT faculty,YEAR(`date`) as dddate,COUNT(*) as count FROM ecclaims GROUP BY dddate, faculty ORDER BY count DESC");
$aClaim = mysql_num_rows($sql); 

if($aClaim > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>Year</th>
		<th>Faculty</th>
        <th>Count</th>
		
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$fac =$row["faculty"];
$date =$row['dddate'];
$count =$row['count'];




echo "<tr>";
echo "<td>" . $date . "</td>";
echo "<td>" . $fac . "</td>";
echo "<td>" . $count . "</td>";
echo "</tr>";
}
echo " </tbody>
                        </table>";
}else{

$aList = "You have no Claims in the system yet";

}

?>
  <?php echo $aList; ?>
  <br>
  <h4>Yearly Percantage of Claims with in each Faculty:</h4>
  <?php

$bList="";
$sql = mysql_query("SELECT faculty,YEAR(`date`) as dddate,(COUNT(*) / (SELECT COUNT(*) FROM ecclaims)) * 100 AS 'Percentage' 
FROM ecclaims GROUP BY dddate, faculty DESC ;");
$aClaim = mysql_num_rows($sql); 

if($aClaim > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>Year</th>
		<th>Faculty</th>
        <th>Percentage(%)</th>
		
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$fac =$row["faculty"];
$date =$row['dddate'];
$count =$row['Percentage'];




echo "<tr>";
echo "<td>" . $date . "</td>";
echo "<td>" . $fac . "</td>";
echo "<td>" . $count . "</td>";
echo "</tr>";
}
echo " </tbody>
                        </table>";
}else{

$bList = "You have no Claims in the system yet";

}

?>
  <?php echo $bList; ?>
  <br>
    <h4>Yearly Students making Claims with in each Faculty:</h4>
  <?php

$cList="";
$sql = mysql_query("SELECT faculty,YEAR(`date`) as dddate,COUNT(student_id) as count FROM ecclaims GROUP BY dddate, faculty ORDER BY count DESC");
$aClaim = mysql_num_rows($sql); 

if($aClaim > 0){
echo "
<table class=\"table table-bordered\">
                           <thead>
      <tr>
        <th>Year</th>
		<th>Faculty</th>
        <th>Student Number</th>
		
      </tr>
    </thead>
    <tbody> ";
while($row =mysql_fetch_array($sql)){

$fac =$row["faculty"];
$date =$row['dddate'];
$count =$row['count'];




echo "<tr>";
echo "<td>" . $date . "</td>";
echo "<td>" . $fac . "</td>";
echo "<td>" . $count . "</td>";
echo "</tr>";
}
echo " </tbody>
                        </table>";
}else{

$cList = "You have no Claims in the system yet";

}

?>
  <?php echo $cList; ?>
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


