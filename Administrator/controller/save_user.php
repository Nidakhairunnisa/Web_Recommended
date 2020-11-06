<?php
include "database.php";

if (isset ($_POST['nim'])){
	$nim = $_POST['nim'];
} else {
	$nim = "" ;
}

$nama = $_POST['nama_lengkap'];
$password = $_POST['password'];


$sqlupdate = "UPDATE data_user SET nama_lengkap = '$nama', password = '$password', 
file_user = '$namaDoang' WHERE id=$nim";


$sqlinsert = "INSERT INTO data_user (nim, nama_lengkap, password, file_user)
VALUES (null, '$nama', '$password', '$namaDoang')";



if (!isset($nomor_id) && $nomor_id == ""){
	$sql=$sqlinsert;
} else {
	$sql=$sqlupdate;
}


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	session_start();
	$alamatDituju = "home.php?a=listuser";
    include ('forwardfast.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>