<?php
include "database.php";


$judul_buku = $conn->real_escape_string($judul_buku);

$sqlupdate = "UPDATE data_buku SET file_buku='$code_buku' WHERE judul_buku='$judul_buku'";
$sql=$sqlupdate;

if ($conn->query($sql) === TRUE) {
	echo '['. $judul_buku .'] tersimpan ! <br>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>