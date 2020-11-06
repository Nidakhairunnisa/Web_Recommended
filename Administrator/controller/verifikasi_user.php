<?php
include "database.php";

$username_login = $_POST['id_admin'];
$password_login = $_POST['password'];

session_start();
$_SESSION['id_admin'] = $username_login;

$sql = "SELECT * FROM data_admin WHERE id_admin = $username_login AND password = '$password_login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $verifikasi=true;
		$_SESSION['nama_admin'] = $row['nama_admin'];
    }
} else {
    $verifikasi=false;
}
$conn->close();

if ($verifikasi==true){
	$alamatDituju = "home.php?a=viewbukuall";
    include ('forwardfast.php');
} else{
	$alamatDituju = "login.php";
    include ('forwardfast.php');
}



?>