<?php
include "database.php";


//$nim = "";
//$nama = "";
$password ="abcd1234";
// mengamankan koma, dan, titikdua, dll simbol berbahaya
// bagi mysql
$nama= $conn->real_escape_string($satuan[1]);

//$sqlinsert = "INSERT INTO data_user (nim, nama_lengkap, password)
//VALUES ($nim, '$nama', '$password')";
$sqlinsert = "update data_user set nama_lengkap = '$nama' where nim='$nim' ";
$sql=$sqlinsert;

if ($conn->query($sql) === TRUE) {
	echo 'data tersimpan';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>