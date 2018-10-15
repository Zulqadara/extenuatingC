<?php
session_start();
$student = $_SESSION["studentid"];
$faculty = $_SESSION["student_faculty"];
 
 
$sql = mysql_query("SELECT * FROM eccoordinator where faculty='$faculty' ");
$Acount = mysql_num_rows($sql); 

if($Acount > 0){

while($row =mysql_fetch_array($sql)){

$emailc =$row["coordinator_email"];
}
}

$to      = "$emailc";
$subject = 'EC Submition';
$message = "Student ID: $student has just submitted a claim, please process it within 14 days !";
$headers = 'From: EC System' . "\r\n" .
    'Reply-To: ' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    //echo 'Email sent successfully!';
} //else {
    //die('Failure: Email was not sent!');
//}


?>