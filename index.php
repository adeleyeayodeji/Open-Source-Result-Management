<?php
session_start();
if (!isset($_SESSION["alogin"])) {
	header("location: find-result.php");
}else{
    header("location: dashboard.php");
// Redirecting to find-result.php    
}
error_reporting(0);
?>
