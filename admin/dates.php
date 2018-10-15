<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 

$sql = mysql_query("SELECT * FROM closuredates ");
$Acount = mysql_num_rows($sql); 

if($Acount > 0){

while($row =mysql_fetch_array($sql)){

$date =$row["closuredate"];
$date2 =$row['finalclosuredate'];
}
}
if (isset($_POST['date'])) {

	$date = $_POST['date'];
	$date2 = $_POST['date2'];
	
	$sql = mysql_query("INSERT INTO closuredates (closuredate, finalclosuredate) 
        VALUES('$date', '$date2')") or die (mysql_error());
		
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Dates Registered')
    window.location.href='dates.php';
    </SCRIPT>");
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
  <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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

  <h2>Closure Dates</h2>
  <h4>Closure Date: <u style="color:RED"><i>'<?php echo $date ; ?>'</i></u> | Final Closure Date: <u style="color:RED"><i>'<?php echo $date2 ; ?>'</i></u></h4>
        
  <form method="post" action="dates.php">
 
   <div class="form-group">
    <label for="name1">Closure Date:</label>
    <input id="txtdate" type="text" name="date" class="form-control" placeholder="Select Date" required>
  </div>
   <script language="javascript">
        $(document).ready(function () {
            $("#txtdate").datepicker({
				dateFormat: 'yy-mm-dd',
                minDate: 0
            });
        });
    </script>
	
	<div class="form-group">
    <label for="name1">Final Closure Date:</label>
    <input id="txtdate2" type="text" name="date2" class="form-control" placeholder="Select Date" required>
  </div>
   <script language="javascript">
        $(document).ready(function () {
            $("#txtdate2").datepicker({
				dateFormat: 'yy-mm-dd',
                minDate: 0
            });
        });
    </script>
	
  <button type="submit" name="submit" id="button" class="btn btn-info">Submit</button>
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


