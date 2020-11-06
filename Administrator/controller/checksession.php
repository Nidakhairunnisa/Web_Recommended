<?php 

	session_start();
	
	if(!isset($_SESSION['id_admin'])){
		$alamatDituju = "login.php";
		include ('forwardfast.php');
		
	}
		
?>