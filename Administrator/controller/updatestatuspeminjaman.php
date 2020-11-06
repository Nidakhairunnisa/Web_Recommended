<?php
include "database.php";

if(isset($_POST['tanggal_kembali'])){
	// jika ada perubahan tanggal, maka kita pakai nilai tsb
	
	$tanggalHariIni = $_POST['tanggal_kembali'];
} else {
	// yg tadi 
	date_default_timezone_set('Asia/Jakarta');
	$tanggalHariIni = date('Y-m-d H:i:s');
}

$id_pinjam = $_POST['id'];
$status = $_POST['statusNya'];
$judul_buku = $_POST['judul_buku'];
$nim = $_POST['nim'];



$sqlupdate = "UPDATE pinjam_buku SET status = '$status', tanggal_kembali='$tanggalHariIni' WHERE id_pinjam=$id_pinjam";

$sqlInsertToNotif = "INSERT INTO data_notif (id_notif, nim, judul_buku, tanggal_notif, status)
	VALUE(null, $nim, '$judul_buku', '$tanggalHariIni', '$status' ) ";


if ($conn->query($sqlupdate) === TRUE) {
    
	if ($conn->query($sqlInsertToNotif) === TRUE) {
			
	}
} else {
    echo "gagal";
}

$conn->close();
?>