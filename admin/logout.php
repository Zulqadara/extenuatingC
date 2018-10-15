<?php
session_start();
if(isset($_SESSION["admin"])){
		unset($_SESSION['admin']);
		
		

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('You have been Successfully Logged Out!')
    window.location.href='../index.html';
    </SCRIPT>");
}
?>