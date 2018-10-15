<?php
session_start();
if(isset($_SESSION["manager"])){
		unset($_SESSION['manager']);
		
		

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('You have been Successfully Logged Out!')
    window.location.href='../index.html';
    </SCRIPT>");
}
?>