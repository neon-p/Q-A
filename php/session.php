<?php
	session_start();
	include("dbconnect.php");
		
	if(empty($_SESSION["user_id"]) AND empty($_SESSION["admin_email"])){
            echo '<script language="javascript">';
            echo 'alert("Need to login!")';
            echo '</script>';
            echo "<script>location.href='login.php';</script>";
	}
?>