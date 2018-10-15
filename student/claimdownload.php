<?php
session_start();
if (!isset($_SESSION["studentid"])){
header("location: ../studentlogin.php");

exit();
}
include "../scripts/connect_to_mysql.php"; 
if (isset($_GET['cid'])){
$targetID = $_GET['cid'];
}else{
	header("location: studentsviewclaims.php");
}


 
$targetID=$_GET['cid'];
$sql = "SELECT * FROM ecclaims WHERE claim_id=$targetID";
 $result = mysql_query($sql) or die(mysql_error());
 while($curr_file = mysql_fetch_array($result))
{
$name = $curr_file['evidence_name'];
$content = $curr_file['claim_evidence'];
header("Content-type: application/pdf");
header("Content-type: application/docx");
header('Content-Disposition: attachment; filename="'.$name.'"');
header("Content-Transfer-Encoding: binary");
header('Accept-Ranges: bytes');
echo $content;
} 

?>