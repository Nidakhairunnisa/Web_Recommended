<?php
include "database.php";

if(isset($_GET['judul_buku'])) {
	$dataArray = array();
	
	$judul_buku = $_GET["judul_buku"];
	
	$sql = "SELECT * FROM `data_buku` WHERE judul_buku LIKE '%$judul_buku%' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$dataArray [] = $row['judul_buku'];
			}
			
			echo json_encode ($dataArray);
			
		} else {
			echo "0";
		}
		   
		$conn->close();	
	}