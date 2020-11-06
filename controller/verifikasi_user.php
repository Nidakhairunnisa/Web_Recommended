<?php
include "database.php";

$username_login = $_POST['nim'];
$password_login = $_POST['password'];
session_start();
$_SESSION['nim'] = $username_login;

$sql = "SELECT * FROM data_user WHERE nim = '$username_login' AND password = '$password_login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $verifikasi=true;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
    }
} else {
    $verifikasi=false;
}
$conn->close();

if ($verifikasi==true){
	$alamatDituju = "home.php?a=viewbuku";
    include ('forwardfast.php');
} else{
	$alamatDituju = "login.php?status=failed";
    include ('forwardfast.php');
}



?>