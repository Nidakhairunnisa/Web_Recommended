<?php
include "database.php";

if (isset ($_POST['nim'])){
	$nim = $_POST['nim'];
} else {
	$nim = "" ;
}

$nama = $_POST['nama_lengkap'];
$hasil_kuesioner = $_POST['hasil_kuesioner'];

$sqlinsert = "INSERT INTO data_kuesioner (id_kuesioner, nim, nama_lengkap, hasil_kuesioner)
VALUES (null, $nim, '$nama', $hasil_kuesioner)";




if ($conn->query($sqlinsert) === TRUE) {
	echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>