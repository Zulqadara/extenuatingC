<?php
session_start();
if (!isset($_SESSION["admin"])){
header("location: ../adminlogin.php");

exit();
}
 
include "../scripts/connect_to_mysql.php"; 

if (isset($_POST['name'])) {
	
   

    $name = mysql_real_escape_string($_POST['name']);
	$date = mysql_real_escape_string($_POST['date']);
	
	$iname = mysql_real_escape_string($_POST['iname']);
   

   $sql = mysql_query("SELECT item_code FROM items_of_assesment WHERE item_code='$name' LIMIT 1");
	$itemMatch = mysql_num_rows($sql);
    if ($itemMatch > 0) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sorry you tried duplicating that Item code, Please try again')
    window.location.href='assesment.php';
    </SCRIPT>");
		exit();
	}
	
	
	$sql = mysql_query("INSERT INTO items_of_assesment (item_code, item_name, item_end_date) 
        VALUES('$name', '$iname', '$date')") or die (mysql_error());
		
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Item Registered')
    window.location.href='assesment.php';
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
<a href="viewassesment.php" class="btn btn-primary col-sm-offset-10" role="button">View Items of assessment</a>
  <h2>Item of assessment</h2>
        
  <form method="post" action="assesment.php">
  <div class="form-group">
    <label for="name">Item Code:</label>
    <input type="text" name="name" class="form-control" id="name" required>
  </div>
   <div class="form-group">
    <label for="name">Item Name:</label>
    <input type="text" name="iname" class="form-control" id="name" required>
  </div>
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


