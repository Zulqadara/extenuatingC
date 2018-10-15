<?php
//session_start();
 //$student = $_SESSION["studentid"];
 //$faculty = $_SESSION["student_faculty"];
 
 
 
$to = 'zulqadar_a@hotmail.com';
$subject = "EC Claim";
$message = "Student ID:  has just submitted a claim, please process it within 14 days";
$headers = "From:" ;
if(mail($to,$subject,$message,$headers))
	echo "Email sent";
else
	echo "Email sending failed";

?>