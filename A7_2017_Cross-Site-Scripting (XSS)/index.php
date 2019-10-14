<?php
	session_start();
	if (!empty($_SESSION)) {
		header('location:home.php');
	}else{
		header('location:login.php');
	}
?>