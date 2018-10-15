<?php
session_start();
$staf = $_SESSION["coordinator_id"];
$faculty = $_SESSION["coordinatorfaculty"];



 
$sql = mysql_query("SELECT * FROM student where student_id='$stid' ");
$Acount = mysql_num_rows($sql); 

if($Acount > 0){

while($row =mysql_fetch_array($sql)){

$emailc =$row["student_email"];
}
}

$to      = "$emailc";
$subject = 'EC Decision';
$message = "The claim you submitted has been reviewed. The claim was: ";
$headers = 'From: EC System' . "\r\n" .
    'Reply-To: ' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} 


?>