<?php 

	session_start();
	
	if(!isset($_SESSION['nim'])){
		$alamatDituju = "login.php";
		include ('forwardfast.php');
		
	}
		
?>