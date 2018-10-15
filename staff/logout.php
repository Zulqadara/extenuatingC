<?php
session_start();
if(isset($_SESSION["coordinatorid"])){
		unset($_SESSION['coordinatorid']);
		unset($_SESSION['coordinatorfaculty']);
		
		

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('You have been Successfully Logged Out!')
    window.location.href='../index.html';
    </SCRIPT>");
}
?>