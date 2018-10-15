<?php
session_start();
if(isset($_SESSION["studentid"])){
		unset($_SESSION['studentid']);
		unset($_SESSION['student_faculty']);
		
		

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('You have been Successfully Logged Out!')
    window.location.href='../index.html';
    </SCRIPT>");
}
?>